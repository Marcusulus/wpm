
<?= $this->tag->form(['', 'id' => 'WebpageForm']) ?>
    <Label for='titel'>Titel:</label>
    <?= $this->tag->textField(['titel', 'value' => $webpage->titel]) ?>
    <br/>
    <Label for='status_id'>Status</label>
    <?= $this->tag->select(['status_id', $webpagestatus, 'using' => ['id', 'bezeichnung'], 'value' => $webpage->status_id, 'onchange' => 'WebpagestatusUpdate()']) ?>
    <br/>
    <Label for='parent_id'>Übergeordnete Seite: </label>
    <?php if (empty($webpage->parent_id)) { ?>
        <?= $this->tag->select(['parent_id', $webpages, 'using' => ['id', 'titel'], 'value' => $webpage->id]) ?>
    <?php } else { ?>
        <?= $this->tag->select(['parent_id', $webpages, 'using' => ['id', 'titel'], 'value' => $webpage->parent_id]) ?>
    <?php } ?>
<?= $this->tag->endForm() ?>
<?= MyTags::button(['btloeschen', 'value' => 'Löschen', 'onclick' => 'WebpageLoeschen()']) ?>
<?= MyTags::button(['btspeichern', 'value' => 'Ändern', 'onclick' => 'WebpageSpeichern()']) ?>
<?= $this->tag->form(['', 'id' => 'WebpageNeuForm']) ?>
    <?= $this->tag->textField(['titel', 'value' => '']) ?>
<?= $this->tag->endForm() ?>
<?= MyTags::button(['', 'value' => 'Neue Unterseite', 'onclick' => 'WebpageNeu()']) ?>
<h3>Textdateien</h3>
<div id='textdateien'>
</div>
<?= $this->tag->form(['', 'id' => 'TextdateiForm', 'name' => 'TextdateiForm', 'method' => 'post', 'onchange' => 'TextdateiHochladen()', 'enctype' => 'multipart/form-data']) ?>
    <?= $this->tag->fileField(['daten[]', 'accept' => 'text/*,.pdf,.doc,.docx', 'multiple' => '']) ?>       
<?= $this->tag->endForm() ?>
<h3>Bilder</h3>
<div id="bilder">
</div>
<?= $this->tag->form(['', 'id' => 'BildForm', 'method' => 'post']) ?>
    <?= $this->tag->fileField(['daten[]', 'accept' => 'image/*', 'onchange' => 'BildHochladen()', 'multiple' => '']) ?>
<?= $this->tag->endForm() ?>
<h3>Texte</h3>
<div id="texte">
</div>
<?= $this->tag->form(['', 'id' => 'TextForm', 'method' => 'post']) ?>
    <?= $this->tag->textField(['titel', 'placeholder' => 'Titel']) ?>
    <Label for='textlaenge'>Max. Zeichen</label>
    <?= $this->tag->numericField(['textlaenge', 'placeholder' => 'maximale Zeichenanzahl']) ?>
<?= $this->tag->endForm() ?>
<?= MyTags::button(['neu', 'onclick' => 'TextNeu(\'new\')', 'value' => 'Neu']) ?>
<div id='details'>
</div>
