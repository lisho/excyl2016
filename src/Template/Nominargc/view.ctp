<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Nominargc'), ['action' => 'edit', $nominargc->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Nominargc'), ['action' => 'delete', $nominargc->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nominargc->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Nominargc'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Nominargc'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="nominargc view large-9 medium-8 columns content">
    <h3><?= h($nominargc->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Dni') ?></th>
            <td><?= h($nominargc->dni) ?></td>
        </tr>
        <tr>
            <th><?= __('Nomina') ?></th>
            <td><?= h($nominargc->nomina) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($nominargc->id) ?></td>
        </tr>
    </table>
</div>
