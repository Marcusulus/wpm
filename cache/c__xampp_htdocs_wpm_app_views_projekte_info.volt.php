
<h3>Details</h3>
    <?= $projekt->name ?>
    <br/>
    Auftraggeber: <?= $kunde->name ?>
    <br/>
    <label for='dfstart'>Start: </label>
    <?= $this->tag->dateField(['dfstart', 'value' => $projekt->start, 'readonly' => '']) ?>
    <br/>
    <?php if ($projekt->deadline != null) { ?>
        <label for='dfdead'>Ende: </label>
        <?= $this->tag->dateField(['dfdead', 'value' => $projekt->deadline, 'readonly' => '']) ?>
    <?php } ?>
<br/>
Milestones
<br/>
<?php foreach ($milestones as $milestone) { ?>
    <?= $milestone->bezeichnung ?>
    <?php if (empty(!$milestone->start_geplant)) { ?>
        <label for='dfstartplan' >Start(geplant): </Label>
        <?= $this->tag->dateField(['dfstartplan' . $milestone->id, 'value' => $milestone->start_geplant, 'readonly' => '']) ?>
    <?php } ?>
    <?php if (empty(!$milestone->start)) { ?>
         <label for='dfstart' >Start: </Label>
        <?= $this->tag->dateField(['dfstart' . $milestone->id, 'value' => $milestone->start, 'readonly' => '']) ?>
    <?php } ?>
    <?php if (empty(!$milestone->ende_geplant)) { ?>
        <label for='dfdeadline' >Ende(geplant): </Label>
        <?= $this->tag->dateField(['dfdeadline' . $milestone->id, 'value' => $milestone->ende_geplant, 'readonly' => '']) ?>
    <?php } ?>
    <?php if (empty(!$milestone->ende)) { ?>
        <label for='dfdeadlineplan' >Ende: </Label>
        <?= $this->tag->dateField(['dfdeadlineplan' . $milestone->id, 'value' => $milestone->ende, 'readonly' => '']) ?>
    <?php } ?>

    <?php if (empty($milestone->start)) { ?>
        <?= MyTags::button(['btstart', 'onclick' => 'MilestoneStart(' . $milestone->id . ' )', 'value' => 'Beginnen']) ?>
    <?php } elseif (empty($milestone->ende)) { ?>
        <?= MyTags::button(['btstop', 'onclick' => 'MilestoneStop(' . $milestone->id . ' )', 'value' => 'Abschließen']) ?>
    <?php } ?>
    <br/>
<?php } ?>
<?= MyTags::button(['btbearbeiten', 'onclick' => 'ProjektBearbeiten(' . $projekt->id . ')', 'value' => 'Bearbeiten']) ?>
<?= MyTags::button(['btauswahl', 'onclick' => 'WebsiteStruktur(' . $projekt->id . ')', 'value' => 'Auswählen']) ?>

