<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 * @var \Cake\Collection\CollectionInterface|string[] $groups
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Files'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="files form content">
            <?= $this->Form->create($file) ?>
            <fieldset>
                <legend><?= __('Add File') ?></legend>
                <?php
                    echo $this->Form->control('group_id', ['options' => $groups]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('type');
                    echo $this->Form->control('path');
                    echo $this->Form->control('metadata');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
