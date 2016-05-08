<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $nominargc->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $nominargc->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Nominargc'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="nominargc form large-9 medium-8 columns content">
    <?= $this->Form->create($nominargc) ?>
    <fieldset>
        <legend><?= __('Edit Nominargc') ?></legend>
        <?php
            echo $this->Form->input('dni');
            echo $this->Form->input('nomina');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
