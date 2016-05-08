<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Candidato'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clasificados'), ['controller' => 'Clasificados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Clasificado'), ['controller' => 'Clasificados', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="candidatos index large-9 medium-8 columns content">
    <h3><?= __('Candidatos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('dni') ?></th>
                <th><?= $this->Paginator->sort('nombre') ?></th>
                <th><?= $this->Paginator->sort('apellidos') ?></th>
                <th><?= $this->Paginator->sort('direccion') ?></th>
                <th><?= $this->Paginator->sort('expediente') ?></th>
                <th><?= $this->Paginator->sort('ceas') ?></th>
                <th><?= $this->Paginator->sort('nacimiento') ?></th>
                <th><?= $this->Paginator->sort('tipo') ?></th>
                <th><?= $this->Paginator->sort('estudios') ?></th>
                <th><?= $this->Paginator->sort('telefono') ?></th>
                <th><?= $this->Paginator->sort('clasificado_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($candidatos as $candidato): ?>
            <tr>
                <td><?= $this->Number->format($candidato->id) ?></td>
                <td><?= h($candidato->dni) ?></td>
                <td><?= h($candidato->nombre) ?></td>
                <td><?= h($candidato->apellidos) ?></td>
                <td><?= h($candidato->direccion) ?></td>
                <td>
                    <?= //h($candidato->expediente) 
                        $this->Html->link(__($candidato->expediente), ['action' => 'view_por_expediente', $candidato->expediente]);
                    ?>
                    </td>
                <td><?= //h($candidato->ceas) 
                        $candidato->has('cea') ? $this->Html->link($candidato->cea->nombre, ['action' => 'view_por_cea', $candidato->cea->id]) : ''
                    ?></td>
                <td><?= h($candidato->nacimiento) ?></td>
                <td><?= h($candidato->tipo) ?></td>
                <td><?= h($candidato->estudios) ?></td>
                <td><?= h($candidato->telefono) ?></td>
                <td><?= $candidato->has('clasificado') ? $this->Html->link($candidato->clasificado->clasificacion, ['controller' => 'Clasificados', 'action' => 'view', $candidato->clasificado->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $candidato->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $candidato->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $candidato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidato->id)]) ?>
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
