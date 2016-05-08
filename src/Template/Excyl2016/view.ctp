<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Excyl2016'), ['action' => 'edit', $excyl2016->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Excyl2016'), ['action' => 'delete', $excyl2016->id], ['confirm' => __('Are you sure you want to delete # {0}?', $excyl2016->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Excyl2016'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Excyl2016'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="excyl2016 view large-9 medium-8 columns content">
    <h3><?= h($excyl2016->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Dni') ?></th>
            <td><?= h($excyl2016->dni) ?></td>
        </tr>
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($excyl2016->nombre) ?></td>
        </tr>
        <tr>
            <th><?= __('Telefono') ?></th>
            <td><?= h($excyl2016->telefono) ?></td>
        </tr>
        <tr>
            <th><?= __('Plaza') ?></th>
            <td><?= h($excyl2016->plaza) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($excyl2016->id) ?></td>
        </tr>
    </table>
</div>
