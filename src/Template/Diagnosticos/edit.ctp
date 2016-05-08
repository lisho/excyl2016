<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $diagnostico->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $diagnostico->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Diagnosticos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Candidatos'), ['controller' => 'Candidatos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Candidato'), ['controller' => 'Candidatos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="diagnosticos form large-9 medium-8 columns content">
    <?= $this->Form->create($diagnostico) ?>
    <fieldset>
        <legend><?= __('Edit Diagnostico') ?></legend>
        <?php
            echo $this->Form->input('motivacion');
            echo $this->Form->input('habitos');
            echo $this->Form->input('habilidades');
            echo $this->Form->input('especialidad');
            echo $this->Form->input('dificultades');
            echo $this->Form->input('observaciones');
            echo $this->Form->input('candidatos_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
