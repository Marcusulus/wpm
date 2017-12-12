
<table>
    <tr>
        <th>Bezeichnung</th>
        <th>Standard </th>
    </tr>
    <?php foreach ($status as $stat) { ?>
    <tr>
        <td><?= MyTags::listitemlink(['licstatus' . $stat->id, 'onclick' => 'ContentStatusVerwaltung(' . $stat->id . ')', 'value' => $stat->bezeichnung]) ?></td>
        <?php if ($stat->iststandard == 1) { ?>
            <td><?= $this->tag->checkField(['', 'disabled' => '', 'checked' => '']) ?></td>
        <?php } else { ?>
            <td><?= $this->tag->checkField(['', 'disabled' => '']) ?></td>
        <?php } ?>
    </tr>
    <?php } ?>       
</table>
<div id='contentstatus'>
</div>
