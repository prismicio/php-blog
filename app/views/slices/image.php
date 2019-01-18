<?php 
use Prismic\Dom\RichText;

$imageWithCaption = $slice->primary;
        
$imageUrl = $imageWithCaption->image->url;
$caption = $imageWithCaption->caption;

echo "<div class='post-part single container'><p class='block-img'>";
echo "<img src='" . $imageUrl . "'/>";
if ( $caption ) {
  echo "<p><span class='image-label'>" . RichText::asText($caption) . "</span></p>";
}
echo "</p></div>";
