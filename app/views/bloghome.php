<?php

$prismic = $WPGLOBAL['prismic'];
$bloghome = $WPGLOBAL['bloghome'];
$posts = $WPGLOBAL['posts'];

$title = $bloghome->getText("bloghome.headline");
$isBloghome = true;

$imageUrl = $bloghome->getImage('bloghome.image') ? $bloghome->getImage('bloghome.image')->getUrl() : '';

?>

<?php include 'header.php'; ?>

<div class="home">
  <div class='blog-avatar' style='background-image: url("<?= $imageUrl ?>");'></div>
  <h1 class='blog-title'><?= $title ?></h1>
  <p class='blog-description'><?= $bloghome->getText('bloghome.description') ?></p>
</div>

<div class="blog-main">
  <?php foreach ($posts as $post) { ?>
  
  <div class="blog-post" data-wio-id=<?= $post->getId() ?>>
      <h2>
        <a href="<?= $prismic->linkResolver->resolve($post) ?>"><?= $post->getText('post.title') ?></a>
      </h2>
      
      <p class="blog-post-meta">
        <span class="created-at"><?= $post->getDate("post.date") ? $post->getDate("post.date")->formatted('M d Y') : "" ?></span>
      </p>
      
      <?php include 'slices/firstParagraph.php'; ?>
      
    </div>
  <?php } ?>
</div>

<?php include 'footer.php'; ?>
