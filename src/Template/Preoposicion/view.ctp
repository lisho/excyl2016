<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Preoposicion'), ['action' => 'edit', $preoposicion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Preoposicion'), ['action' => 'delete', $preoposicion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preoposicion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Preoposicion'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Preoposicion'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="preoposicion view large-9 medium-8 columns content">
    <h3><?= h($preoposicion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Dni') ?></th>
            <td><?= h($preoposicion->dni) ?></td>
        </tr>
        <tr>
            <th><?= __('Plaza') ?></th>
            <td><?= h($preoposicion->plaza) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($preoposicion->id) ?></td>
        </tr>
    </table>
</div>
