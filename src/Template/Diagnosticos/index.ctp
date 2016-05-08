<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Diagnostico'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Candidatos'), ['controller' => 'Candidatos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Candidato'), ['controller' => 'Candidatos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="diagnosticos index large-9 medium-8 columns content">
    <h3><?= __('Diagnosticos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('motivacion') ?></th>
                <th><?= $this->Paginator->sort('habitos') ?></th>
                <th><?= $this->Paginator->sort('habilidades') ?></th>
                <th><?= $this->Paginator->sort('especialidad') ?></th>
                <th><?= $this->Paginator->sort('dificultades') ?></th>
                <th><?= $this->Paginator->sort('observaciones') ?></th>
                <th><?= $this->Paginator->sort('candidatos_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($diagnosticos as $diagnostico): ?>
            <tr>
                <td><?= $this->Number->format($diagnostico->id) ?></td>
                <td><?= h($diagnostico->motivacion) ?></td>
                <td><?= h($diagnostico->habitos) ?></td>
                <td><?= h($diagnostico->habilidades) ?></td>
                <td><?= h($diagnostico->especialidad) ?></td>
                <td><?= h($diagnostico->dificultades) ?></td>
                <td><?= h($diagnostico->observaciones) ?></td>
                <td><?= $this->Number->format($diagnostico->candidatos_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $diagnostico->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $diagnostico->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $diagnostico->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diagnostico->id)]) ?>
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
