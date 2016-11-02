<?php 
$imagesWithCaption = $slice->getValue()->getArray();
        
// Loop through all the images in the group
foreach ( $imagesWithCaption as $imageWithCaption ) {
  $imageUrl = $imageWithCaption->getImage('illustration') ? $imageWithCaption->getImage('illustration')->getUrl() : '';
  $caption = $imageWithCaption->get('caption') ? $imageWithCaption->get('caption')->asText() : null;

  // Render the correct style for the different image labels 
  switch ( $slice->getLabel() ) {

    // Full width image
    case "image-full-width":
      echo "<div class='blog-header single' style='background-image: url(" . $imageUrl . ");'><div class='wrapper'>";
      if ( $caption ) {
        echo "<h1>" . $caption . "</h1>";
      }
      echo "</div></div>";
      break;  

    // Emphasized image
    case "emphasized":
      echo "<div class='post-part single container'><p class='block-img emphasized'>";
      echo "<img src='" . $imageUrl . "'/>";
      if ( $caption ) {
        echo "<p><span class='image-label'>" . $caption . "</span></p>";
      }
      echo "</p></div>";
      break;  

    // Default image
    default:
      echo "<div class='post-part single container'><p class='block-img'>";
      echo "<img src='" . $imageUrl . "'/>";
      if ( $caption ) {
        echo "<p><span class='image-label'>" . $caption . "</span></p>";
      }
      echo "</p></div>";
      break; 
  }
}