<?php
use Prismic\LinkResolver;
use Prismic\Dom\RichText;

$prismic = $WPGLOBAL['prismic'];
$post = $WPGLOBAL['post'];

$title = RichText::asText($post->data->title);
$isBloghome = false;

?>

<?php include 'header.php'; ?>

<div class="main">
  <div class="outer-container">
    
    <div class="back">
      <a href="./">back to list</a>
    </div>
    
    <h1 data-wio-id=<?= $post->id ?>>
      <?= $title ?>
    </h1>
  </div>
  
  <?php 
  
  // Get the slices present in the document
  $slices = $post->data->body;

  foreach ( $slices as $slice ) {
    // Render the right markup for a given slice type
    switch ($slice->slice_type) {
      
      // Text slice
      case "text":
        include 'slices/text.php';
        break;
      
      // Quote slice
      case "quote":
        include 'slices/quote.php';
        break;
      
      // Image slice
      case "image_with_caption":
        include 'slices/image.php';
        break;
      
      // Default slice case does nothing
      default:
        break;
    }
  }
  ?>
</div>

<?php include 'footer.php'; ?>
