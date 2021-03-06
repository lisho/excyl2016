<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $empleo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $empleo->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Empleos'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="empleos form large-9 medium-8 columns content">
    <?= $this->Form->create($empleo) ?>
    <fieldset>
        <legend><?= __('Edit Empleo') ?></legend>
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
