<?php

$prismic = $WPGLOBAL['prismic'];
$post = $WPGLOBAL['post'];

$title = $post->getText('post.title');
$isBloghome = false;

?>

<?php include 'header.php'; ?>

<div class="main">
  <div class="outer-container">
    
    <div class="back">
      <a href="./">back to list</a>
    </div>
    
    <h1 data-wio-id=<?= $post->getId() ?>>
      <?= $post->getText('post.title') ? $post->getText('post.title') : "Untitled" ?>
    </h1>
  </div>
  
  <?php 
  
  $sliceZone = $post->getSliceZone('post.body') ? $post->getSliceZone('post.body')->getSlices() : (object) array();
  
  //- Render the right markup for a given slice type.      
  foreach ( $sliceZone as $slice ) {
    
    // Render the right markup for a given slice type
    switch ($slice->getSliceType()) {
      
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
