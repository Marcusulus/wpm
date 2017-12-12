
<ul>
    <?php foreach ($personen as $person) { ?>
    <?= MyTags::listitemlink(['liperson' . $person->id, 'onclick' => 'PersonInfo(' . $person->id . ')', 'value' => $person->vorname . ' ' . $person->nachname]) ?>
    <?php } ?>        
</ul>
