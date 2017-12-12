
<table>
<tr>
  <th>Name</th>
  <th>Standard</th>  
</tr>
<?php foreach ($milestones as $milestone) { ?>
    <tr>
        <td><?= MyTags::listitemlink(['', 'onclick' => 'MilestoneInfo(' . $milestone->id . ')', 'value' => $milestone->bezeichnung]) ?></td>
        <?php if ($milestone->iststandard == 1) { ?>
            <td><?= $this->tag->checkField(['cfsatndard' . $milestone->id, 'disabled' => '', 'checked' => '']) ?></td>
        <?php } else { ?>
            <td><?= $this->tag->checkField(['cfsatndard' . $milestone->id, 'disabled' => '']) ?></td>
        <?php } ?>
    </tr>
<?php } ?>
</table>


<div id='milestone'>
</div>
