<?php use Prismic\Dom\RichText; ?>

<div class='post-part single container'>
  <div>
    <?= RichText::asHtml($slice->primary->text) ?>
  </div>
</div>