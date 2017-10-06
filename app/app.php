<?php

/*
 * This is the main file of the application, including routing and controllers.
 *
 * $app is a Slim application instance, see the framework documentation for more details:
 * http://docs.slimframework.com/
 *
 * The order of the routes matter, as it will define the priority of routes. For that reason we
 * need to keep the more "generic" routes, such as the pages route, at the end of the file.
 *
 * If you decide to change the URLs, make sure to change PrismicLinkResolver in LinkResolver.php
 * as well to make sures links in your site are correctly generated.
 */

use Prismic\Api;
use Prismic\LinkResolver;
use Prismic\Predicates;

require_once 'includes/http.php';

// Index page
$app->get('/{route:|blog|blog/}', function ($request, $response) use ($app, $prismic) {

  // Query the API for the homepage content and all the posts
  $api = $prismic->get_api();
  $bloghomeContent = $api->getSingle('blog_home');
  $posts = $api->query(
    Predicates::at("document.type", "post"),
    [ 'orderings' => '[my.post.date desc]']
  );
  
  // If there is no bloghome content, display 404 page
  if ( $bloghomeContent == null ) {
    not_found($app);
    return;
  }
  
  // Render the homepage
  render($app, 'bloghome', array('bloghome' => $bloghomeContent, 'posts' => $posts->getResults()));
  
});


// Previews
$app->get('/{route:preview|preview/}', function ($request, $response) use ($app, $prismic) {
  $token = $request->getParam('token');
  $url = $prismic->get_api()->previewSession($token, $prismic->linkResolver, '/');
  setcookie(Prismic\PREVIEW_COOKIE, $token, time() + 1800, '/', null, false, false);
  return $response->withStatus(302)->withHeader('Location', $url);
});


// Pages by UID
$app->get('/blog/{uid}', function ($request, $response, $args) use ($app, $prismic) {
  
  // Retrieve the uid from the url
  $uid = $args['uid'];
  
  // Query the API by the uid
  $api = $prismic->get_api();
  $post = $api->getByUID('post', $uid);
  
  // If there is no post content, display the 404 page
  if (!$post) {
    not_found($app);
    return;
  }
  
  // Render the post page
  render($app, 'post', array('post' => $post));
});


// Display the 404 page for any other url
$app->get('/{uid}', function ($request, $response, $args) use ($app, $prismic) {
  render($app, '404');
});