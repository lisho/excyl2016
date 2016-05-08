<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cea'), ['action' => 'edit', $cea->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cea'), ['action' => 'delete', $cea->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cea->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ceas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cea'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ceas view large-9 medium-8 columns content">
    <h3><?= h($cea->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($cea->nombre) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($cea->id) ?></td>
        </tr>
    </table>
</div>
