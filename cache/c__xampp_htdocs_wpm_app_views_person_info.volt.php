
<?= $person->vorname ?> 
    <?= $person->nachname ?>
    <h3>Kontakt</h3><br/>    
    <Label>Email: </label>
    <?= $person->email ?>
    <br/>
    <Label for='cbauftraggeber_id'>Telefon: </label>
    <?= $person->telefon ?>
    <br/>
    <Label>Mobil: </label>
    <?= $person->mobil ?>
    <br/>
    <?php if (empty(!$person->auftraggeber_id)) { ?>
        <Label for='bemerkung'>Bemrkung: </label>
        <?= $this->tag->textArea(['bemerkung', 'value' => $person->bemerkung, 'cols' => 50, 'rows' => 10, 'readonly' => '']) ?>
    <?php } ?>
    <?= MyTags::button(['btloeschen', 'onclick' => 'PersonLoeschen(' . $person->id . ')', 'value' => 'Löschen']) ?>
    <?= MyTags::button(['btzurueck', 'onclick' => 'PersonInfoAusblenden()', 'value' => 'Zurück']) ?>  
    <?= MyTags::button(['btbearbeiten', 'onclick' => 'PersonBearbeiten(' . $person->id . ')', 'value' => 'Bearbeiten']) ?>

