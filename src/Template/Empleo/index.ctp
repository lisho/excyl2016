<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Empleo'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="empleo index large-9 medium-8 columns content">
    <h3><?= __('Empleo') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('dni') ?></th>
                <th><?= $this->Paginator->sort('e1') ?></th>
                <th><?= $this->Paginator->sort('e2') ?></th>
                <th><?= $this->Paginator->sort('e3') ?></th>
                <th><?= $this->Paginator->sort('e4') ?></th>
                <th><?= $this->Paginator->sort('e5') ?></th>
                <th><?= $this->Paginator->sort('e6') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empleo as $empleo): ?>
            <tr>
                <td><?= $this->Number->format($empleo->id) ?></td>
                <td><?= h($empleo->dni) ?></td>
                <td><?= h($empleo->e1) ?></td>
                <td><?= h($empleo->e2) ?></td>
                <td><?= h($empleo->e3) ?></td>
                <td><?= h($empleo->e4) ?></td>
                <td><?= h($empleo->e5) ?></td>
                <td><?= h($empleo->e6) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $empleo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $empleo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $empleo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $empleo->id)]) ?>
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
