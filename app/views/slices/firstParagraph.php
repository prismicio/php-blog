<?php
use Prismic\Dom\RichText;

// Get all the slices of the post
$slices = $post->data->body;
$firstText = "";

// Loop through each slice to find the first text slice
foreach ($slices as $slice) {
  if ($slice->slice_type == "text") {
    $firstText = RichText::asText($slice->primary->text);
    break;
  }
}

// If a first paragraph was found display the paragraph with text limit
if ($firstText !== "") {
  $textLimit = 300;
  $limitedText = substr($firstText, 0, $textLimit);

  // If the first paragraph is longer than the limit, cut it down, respecting the end of the last word
  if (strlen($firstText)> $textLimit) {
    $lastSpaceIndex = strrpos($limitedText, ' ', -1);
    $limitedText = substr($limitedText, 0, $lastSpaceIndex);
    echo "<p>" . $limitedText . "...</p>";
  } else {
    echo "<p>" . $firstText . "</p>";
  }
}