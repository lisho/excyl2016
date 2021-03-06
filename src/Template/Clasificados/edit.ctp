<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $clasificado->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $clasificado->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Clasificados'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Candidatos'), ['controller' => 'Candidatos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Candidato'), ['controller' => 'Candidatos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clasificados form large-9 medium-8 columns content">
    <?= $this->Form->create($clasificado) ?>
    <fieldset>
        <legend><?= __('Edit Clasificado') ?></legend>
        <?php
            echo $this->Form->input('clasificacion');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
