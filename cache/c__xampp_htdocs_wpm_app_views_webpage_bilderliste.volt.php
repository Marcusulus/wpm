
<?php foreach ($bilder as $bild) { ?>
    <?= $this->tag->imageInput(['id' => 'img' . $bild->id, 'src' => $bild->pfad, 'height' => 75, 'width' => 75, 'onclick' => 'Bilddetails(' . $bild->id . ')']) ?>
<?php } ?>

