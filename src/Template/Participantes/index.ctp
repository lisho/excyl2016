<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Participante'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="participantes index large-9 medium-8 columns content">
    <h3><?= __('Participantes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('dni') ?></th>
                <th><?= $this->Paginator->sort('nombre') ?></th>
                <th><?= $this->Paginator->sort('apellidos') ?></th>
                <th><?= $this->Paginator->sort('numedis') ?></th>
                <th><?= $this->Paginator->sort('numrgc') ?></th>
                <th><?= $this->Paginator->sort('tedis') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($participantes as $participante): ?>
            <tr>
                <td><?= $this->Number->format($participante->id) ?></td>
                <td><?= h($participante->dni) ?></td>
                <td><?= h($participante->nombre) ?></td>
                <td><?= h($participante->apellidos) ?></td>
                <td><?= h($participante->numedis) ?></td>
                <td><?= h($participante->numrgc) ?></td>
                <td><?= h($participante->tedis) ?></td>
                <td><?= h($participante->created) ?></td>
                <td><?= h($participante->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $participante->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $participante->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $participante->id], ['confirm' => __('Are you sure you want to delete # {0}?', $participante->id)]) ?>
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
