<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Diagnostico'), ['action' => 'edit', $diagnostico->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Diagnostico'), ['action' => 'delete', $diagnostico->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diagnostico->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Diagnosticos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Diagnostico'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Candidatos'), ['controller' => 'Candidatos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Candidato'), ['controller' => 'Candidatos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="diagnosticos view large-9 medium-8 columns content">
    <h3><?= h($diagnostico->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Motivacion') ?></th>
            <td><?= h($diagnostico->motivacion) ?></td>
        </tr>
        <tr>
            <th><?= __('Habitos') ?></th>
            <td><?= h($diagnostico->habitos) ?></td>
        </tr>
        <tr>
            <th><?= __('Habilidades') ?></th>
            <td><?= h($diagnostico->habilidades) ?></td>
        </tr>
        <tr>
            <th><?= __('Especialidad') ?></th>
            <td><?= h($diagnostico->especialidad) ?></td>
        </tr>
        <tr>
            <th><?= __('Dificultades') ?></th>
            <td><?= h($diagnostico->dificultades) ?></td>
        </tr>
        <tr>
            <th><?= __('Observaciones') ?></th>
            <td><?= h($diagnostico->observaciones) ?></td>
        </tr>
        <tr>
            <th><?= __('Candidato') ?></th>
            <td><?= $diagnostico->has('candidato') ? $this->Html->link($diagnostico->candidato->id, ['controller' => 'Candidatos', 'action' => 'view', $diagnostico->candidato->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($diagnostico->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Candidatos Id') ?></th>
            <td><?= $this->Number->format($diagnostico->candidatos_id) ?></td>
        </tr>
    </table>
</div>
