<?php $this->_macros['knoten'] = function($__p = null) { if (isset($__p[0])) { $page = $__p[0]; } else { if (isset($__p["page"])) { $page = $__p["page"]; } else {  throw new \Phalcon\Mvc\View\Exception("Macro 'knoten' was called without parameter: page");  } }  ?>
    <?= MyTags::listitemlink(['liinfo' . $page->id, 'onclick' => 'WebpageInfo(' . $page->id . ')', 'value' => $page->titel]) ?>
    <?php if (!empty($page->children)) { ?>
    <ul>
        <?php foreach ($page->children as $child) { ?>
            <?= $this->callMacro('knoten', [$child]) ?>
        <?php } ?>
    </ul>
    <?php } ?>
<?php }; $this->_macros['knoten'] = \Closure::bind($this->_macros['knoten'], $this); ?>


<?= $this->callMacro('knoten', [$page]) ?>
