<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tagged $tagged
 * @var string[]|\Cake\Collection\CollectionInterface $tags
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tagged->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tagged->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Tagged'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tagged form content">
            <?= $this->Form->create($tagged) ?>
            <fieldset>
                <legend><?= __('Edit Tagged') ?></legend>
                <?php
                    echo $this->Form->control('table_alias');
                    echo $this->Form->control('foreign_key');
                    echo $this->Form->control('tag_id', ['options' => $tags]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
