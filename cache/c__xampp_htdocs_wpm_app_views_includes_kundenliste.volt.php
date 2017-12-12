<ul>
    <?php foreach ($kunden as $k) { ?>
        <?= MyTags::listitemlink(['likunde' . $k->id, 'onclick' => 'KundenInfo(' . $k->id . ')', 'value' => $k->name]) ?>
    <?php } ?>
</ul>
