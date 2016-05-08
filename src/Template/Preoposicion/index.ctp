<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Preoposicion'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="preoposicion index large-9 medium-8 columns content">
    <h3><?= __('Preoposicion') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('dni') ?></th>
                <th><?= $this->Paginator->sort('plaza') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($preoposicion as $preoposicion): ?>
            <tr>
                <td><?= $this->Number->format($preoposicion->id) ?></td>
                <td><?= h($preoposicion->dni) ?></td>
                <td><?= h($preoposicion->plaza) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $preoposicion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $preoposicion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $preoposicion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preoposicion->id)]) ?>
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
