<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Candidato'), ['action' => 'edit', $candidato->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Candidato'), ['action' => 'delete', $candidato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidato->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Candidatos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Candidato'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clasificados'), ['controller' => 'Clasificados', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Clasificado'), ['controller' => 'Clasificados', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="candidatos view large-9 medium-8 columns content">
    <h3><?= h($candidato->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Dni') ?></th>
            <td><?= h($candidato->dni) ?></td>
        </tr>
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($candidato->nombre) ?></td>
        </tr>
        <tr>
            <th><?= __('Apellidos') ?></th>
            <td><?= h($candidato->apellidos) ?></td>
        </tr>
        <tr>
            <th><?= __('Direccion') ?></th>
            <td><?= h($candidato->direccion) ?></td>
        </tr>
        <tr>
            <th><?= __('Expediente') ?></th>
            <td><?= h($candidato->expediente) ?></td>
        </tr>
        <tr>
            <th><?= __('Ceas') ?></th>
            <td><?= h($candidato->ceas) ?></td>
        </tr>
        <tr>
            <th><?= __('Tipo') ?></th>
            <td><?= h($candidato->tipo) ?></td>
        </tr>
        <tr>
            <th><?= __('Estudios') ?></th>
            <td><?= h($candidato->estudios) ?></td>
        </tr>
        <tr>
            <th><?= __('Telefono') ?></th>
            <td><?= h($candidato->telefono) ?></td>
        </tr>
        <tr>
            <th><?= __('Clasificado') ?></th>
            <td><?= $candidato->has('clasificado') ? $this->Html->link($candidato->clasificado->id, ['controller' => 'Clasificados', 'action' => 'view', $candidato->clasificado->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($candidato->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Nacimiento') ?></th>
            <td><?= h($candidato->nacimiento) ?></td>
        </tr>
    </table>
</div>
