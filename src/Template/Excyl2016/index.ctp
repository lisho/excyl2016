<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Excyl2016'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="excyl2016 index large-9 medium-8 columns content">
    <h3><?= __('Excyl2016') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('dni') ?></th>
                <th><?= $this->Paginator->sort('nombre') ?></th>
                <th><?= $this->Paginator->sort('telefono') ?></th>
                <th><?= $this->Paginator->sort('plaza') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($excyl2016 as $excyl2016): ?>
            <tr>
                <td><?= $this->Number->format($excyl2016->id) ?></td>
                <td><?= h($excyl2016->dni) ?></td>
                <td><?= h($excyl2016->nombre) ?></td>
                <td><?= h($excyl2016->telefono) ?></td>
                <td><?= h($excyl2016->plaza) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $excyl2016->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $excyl2016->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $excyl2016->id], ['confirm' => __('Are you sure you want to delete # {0}?', $excyl2016->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
