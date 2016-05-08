<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Empleo'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="empleo form large-9 medium-8 columns content">
    <?= $this->Form->create($empleo) ?>
    <fieldset>
        <legend><?= __('Add Empleo') ?></legend>
        <?php
            echo $this->Form->input('dni');
            echo $this->Form->input('e1');
            echo $this->Form->input('e2');
            echo $this->Form->input('e3');
            echo $this->Form->input('e4');
            echo $this->Form->input('e5');
            echo $this->Form->input('e6');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
