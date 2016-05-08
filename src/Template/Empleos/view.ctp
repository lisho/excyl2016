<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Empleo'), ['action' => 'edit', $empleo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Empleo'), ['action' => 'delete', $empleo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $empleo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Empleos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Empleo'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="empleos view large-9 medium-8 columns content">
    <h3><?= h($empleo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Dni') ?></th>
            <td><?= h($empleo->dni) ?></td>
        </tr>
        <tr>
            <th><?= __('E1') ?></th>
            <td><?= h($empleo->e1) ?></td>
        </tr>
        <tr>
            <th><?= __('E2') ?></th>
            <td><?= h($empleo->e2) ?></td>
        </tr>
        <tr>
            <th><?= __('E3') ?></th>
            <td><?= h($empleo->e3) ?></td>
        </tr>
        <tr>
            <th><?= __('E4') ?></th>
            <td><?= h($empleo->e4) ?></td>
        </tr>
        <tr>
            <th><?= __('E5') ?></th>
            <td><?= h($empleo->e5) ?></td>
        </tr>
        <tr>
            <th><?= __('E6') ?></th>
            <td><?= h($empleo->e6) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($empleo->id) ?></td>
        </tr>
    </table>
</div>
