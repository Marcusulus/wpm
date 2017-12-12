
<h3>Projekte</h3>
<ul>
<?php foreach ($projekte as $p) { ?>
    <?= MyTags::listitemlink(['btinfo', 'onclick' => 'ProjektInfo(' . $p->id . ')', 'value' => $p->name]) ?>
<?php } ?>
</ul>
<br/>
<?= MyTags::button(['btneu', 'onclick' => 'ProjektNeu()', 'value' => 'Neu']) ?>

<div id='content'>
</div>
