
<?php foreach ($texte as $text) { ?>
    <?= MyTags::listitemlink(['litxt' . $text->id, 'onclick' => 'Textdetails(' . $text->id . ')', 'value' => $text->titel]) ?>       
<?php } ?>
