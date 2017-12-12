
<?php foreach ($dateien as $datei) { ?>
    <?= MyTags::listitemlink(['litxtfile' . $datei->id, 'onclick' => 'Textdateidetails(' . $datei->id . ')', 'value' => $datei->titel]) ?>       
<?php } ?>
