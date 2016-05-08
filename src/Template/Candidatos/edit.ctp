<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $candidato->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $candidato->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Candidatos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Clasificados'), ['controller' => 'Clasificados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Clasificado'), ['controller' => 'Clasificados', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="candidatos form large-9 medium-8 columns content">
    <?= $this->Form->create($candidato) ?>
    <fieldset>
        <legend><?= __('Edit Candidato') ?></legend>
        <?php
            echo $this->Form->input('dni');
            echo $this->Form->input('nombre');
            echo $this->Form->input('apellidos');
            echo $this->Form->input('direccion');
            echo $this->Form->input('expediente');
            echo $this->Form->input('ceas');
            echo $this->Form->input('nacimiento');
            echo $this->Form->input('tipo');
            echo $this->Form->input('estudios');
            echo $this->Form->input('telefono');
            echo $this->Form->input('clasificado_id', ['options' => $clasificados]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
