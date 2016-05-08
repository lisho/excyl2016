<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Ceas'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="ceas form large-9 medium-8 columns content">
    <?= $this->Form->create($cea) ?>
    <fieldset>
        <legend><?= __('Add Cea') ?></legend>
        <?php
            echo $this->Form->input('nombre');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
