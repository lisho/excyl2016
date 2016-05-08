<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Preoposicion'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="preoposicion form large-9 medium-8 columns content">
    <?= $this->Form->create($preoposicion) ?>
    <fieldset>
        <legend><?= __('Add Preoposicion') ?></legend>
        <?php
            echo $this->Form->input('dni');
            echo $this->Form->input('plaza');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
