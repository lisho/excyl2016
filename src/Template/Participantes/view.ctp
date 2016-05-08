<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Participante'), ['action' => 'edit', $participante->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Participante'), ['action' => 'delete', $participante->id], ['confirm' => __('Are you sure you want to delete # {0}?', $participante->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Participantes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Participante'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="participantes view large-9 medium-8 columns content">
    <h3><?= h($participante->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Dni') ?></th>
            <td><?= h($participante->dni) ?></td>
        </tr>
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($participante->nombre) ?></td>
        </tr>
        <tr>
            <th><?= __('Apellidos') ?></th>
            <td><?= h($participante->apellidos) ?></td>
        </tr>
        <tr>
            <th><?= __('Numedis') ?></th>
            <td><?= h($participante->numedis) ?></td>
        </tr>
        <tr>
            <th><?= __('Numrgc') ?></th>
            <td><?= h($participante->numrgc) ?></td>
        </tr>
        <tr>
            <th><?= __('Tedis') ?></th>
            <td><?= h($participante->tedis) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($participante->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($participante->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($participante->modified) ?></td>
        </tr>
    </table>
</div>
