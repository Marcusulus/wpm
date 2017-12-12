
<?= $this->tag->form(['', 'id' => 'ProjektForm', 'method' => 'Post']) ?> 
    <Label for='name'>Projektname</Label>
    <?= $this->tag->textField(['name', 'value' => $projekt->name]) ?>
    <Label for='auftraggeber_id'>Auftraggeber</label>
    <?= $this->tag->select(['auftraggeber_id', $kunden, 'using' => ['id', 'name'], 'value' => $projekt->auftraggeber_id]) ?>
    <Label for='start'>Start: </label>
    <?php if (empty($projekt->start)) { ?>
        <?= $this->tag->dateField(['start', 'placeholder' => 'Projektname', 'value' => date('Y-m-d')]) ?>
    <?php } else { ?>
        <?= $this->tag->dateField(['start', 'placeholder' => 'Projektname', 'value' => $projekt->start]) ?>
    <?php } ?>
    <Label for='deadline'>Ende: </label>
    <?= $this->tag->dateField(['deadline', 'placeholder' => 'Projektname']) ?>
    <br/>
    Milestones
    <br/>
    <?php foreach ($milestones as $milestone) { ?>
        <?php if ($milestone->iststandard == 1) { ?>
            <?= $this->tag->checkField(['select' . $milestone->id, 'name' => 'milestone' . $milestone->id . '[milestone_id]', 'checked' => '', 'value' => $milestone->id]) ?>
        <?php } else { ?>
            <?= $this->tag->checkField(['select' . $milestone->id, 'name' => 'milestone' . $milestone->id . '[milestone_id]', 'value' => $milestone->id]) ?>
        <?php } ?>
        <?= $milestone->bezeichnung ?>
        <?= $this->tag->dateField(['start' . $milestone->id, 'name' => 'milestone' . $milestone->id . '[start_geplant]', 'value' => $milestone->start_geplant]) ?>
        <?= $this->tag->dateField(['deadline' . $milestone->id, 'name' => 'milestone' . $milestone->id . '[ende_geplant]', 'value' => $milestone->ende_geplant]) ?> 
        <br/>
    <?php } ?>
<?= $this->tag->endForm() ?>
<?= MyTags::button(['btabbrechen', 'onclick' => 'ProjektNeuAusblenden()', 'value' => 'Abbrechen']) ?> 
<?= MyTags::button(['btspeichern', 'onclick' => 'Projektspeichern(false)', 'value' => 'Speichern']) ?>
<?= MyTags::button(['btauswahl', 'onclick' => 'Projektspeichern(true)', 'value' => 'Auswählen']) ?>
