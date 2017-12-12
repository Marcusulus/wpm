
<h1>Kunden</h1>

<div>
    <div id='kunden'>
    <ul>
    <?php foreach ($kunden as $k) { ?>
        <?= MyTags::listitemlink(['likunde' . $k->id, 'onclick' => 'KundenInfo(' . $k->id . ')', 'value' => $k->name]) ?>
    <?php } ?>
</ul>
    
    </div>
    <?= MyTags::button(['btneu', 'onclick' => 'KundenNeu()', 'value' => 'Neu']) ?> 
</div>

<div id='content'>

</div>
