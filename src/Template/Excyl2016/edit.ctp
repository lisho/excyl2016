<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $excyl2016->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $excyl2016->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Excyl2016'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="excyl2016 form large-9 medium-8 columns content">
    <?= $this->Form->create($excyl2016) ?>
    <fieldset>
        <legend><?= __('Edit Excyl2016') ?></legend>
        <?php
            echo $this->Form->input('dni');
            echo $this->Form->input('nombre');
            echo $this->Form->input('telefono');
            echo $this->Form->input('plaza');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
