<?php 
use Prismic\Dom\RichText;

$imageWithCaption = $slice->primary;
        
$imageUrl = $imageWithCaption->image->url;
$caption = $imageWithCaption->caption;

switch ( $slice->slice_label ) {

  // Full width image
  case "image-full-width":
    echo "<div class='blog-header single' style='background-image: url(" . $imageUrl . ");'><div class='wrapper'>";
    if ( $caption ) {
      echo "<h1>" . RichText::asText($caption) . "</h1>";
    }
    echo "</div></div>";
    break;  

  // Emphasized image
  case "emphasized":
    echo "<div class='post-part single container'><p class='block-img emphasized'>";
    echo "<img src='" . $imageUrl . "'/>";
    if ( $caption ) {
      echo "<p><span class='image-label'>" . RichText::asText($caption) . "</span></p>";
    }
    echo "</p></div>";
    break;  

  // Default image
  default:
    echo "<div class='post-part single container'><p class='block-img'>";
    echo "<img src='" . $imageUrl . "'/>";
    if ( $caption ) {
      echo "<p><span class='image-label'>" . RichText::asText($caption) . "</span></p>";
    }
    echo "</p></div>";
    break; 
}