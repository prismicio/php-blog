<?php
use Prismic\LinkResolver;
use Prismic\Dom\RichText;
use Prismic\Dom\Date;

$prismic = $WPGLOBAL['prismic'];
$bloghome = $WPGLOBAL['bloghome'];
$posts = $WPGLOBAL['posts'];

$title = RichText::asText($bloghome->data->headline);
$isBloghome = true;

$imageUrl = !$bloghome->data->image ? $bloghome->data->image->url : '';
$linkResolver = $prismic->linkResolver;

?>

<?php include 'header.php'; ?>

<div class="home">
  <div class='blog-avatar' style='background-image: url("<?= $imageUrl ?>");'></div>
  <h1 class='blog-title'><?= $title ?></h1>
  <p class='blog-description'><?= RichText::asText($bloghome->data->description) ?></p>
</div>

<div class="blog-main">
  <?php foreach ($posts as $post) { ?>
  
  <div class="blog-post" data-wio-id=<?= $post->id ?>>
      <h2>
        <a href="<?= $linkResolver->resolve($post) ?>">
          <?= $post->data->title ? RichText::asHtml($post->data->title, $linkResolver) : '<h1>Untitled</h1>' ?>
        </a>
      </h2>
      
      <p class="blog-post-meta">
        <time class="created-at">
          <?= $post->data->date ? Date::asDate($post->data->date)->format('M d, Y') : '' ?>
        </time>
      </p>
      
      <?php include 'slices/firstParagraph.php'; ?>
      
    </div>
  <?php } ?>
</div>

<?php include 'footer.php'; ?>
