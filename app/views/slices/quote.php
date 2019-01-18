<?php use Prismic\Dom\RichText; ?>
<div class='post-part single container'>
  <span class='block-quotation'>
    <?= RichText::asText($slice->primary->quote) ?>
  </span>
</div>