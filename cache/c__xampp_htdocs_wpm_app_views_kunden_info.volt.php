
<div id='info'>
        <?= $kunde->name ?>
        <h3>Anschrift</h3>
        <?= $kunde->strasse ?>
        
        <?= $kunde->hausnummer ?>
        <br></br>

        <?= $kunde->plz ?>

        <?= $kunde->ort ?>
        <br></br>
        <?= MyTags::button(['btloeschen', 'onclick' => 'KundenLoeschen(' . $kunde->id . ')', 'value' => 'Löschen']) ?>
        <?= MyTags::button(['btbearbeiten', 'onclick' => 'KundenBearbeiten(' . $kunde->id . ')', 'value' => 'Bearbeiten']) ?>
</div>
<div>
    <h3>Ansprechpartner </h3>
    <div id='personen'>
    </div>
    <?= MyTags::button(['btneu', 'onclick' => 'PersonNeu()', 'value' => 'Neu']) ?>
<div>

<div id='partner'>

<div>
