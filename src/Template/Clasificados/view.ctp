<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Clasificado'), ['action' => 'edit', $clasificado->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Clasificado'), ['action' => 'delete', $clasificado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clasificado->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Clasificados'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Clasificado'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Candidatos'), ['controller' => 'Candidatos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Candidato'), ['controller' => 'Candidatos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clasificados view large-9 medium-8 columns content">
    <h3><?= h($clasificado->clasificacion."es (".$num_candidatos.")") ?></h3>
    
    <div class="related">
        <h4><?= __('Candidatos') ?></h4>
        <?php if (!empty($clasificado->candidatos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Dni') ?></th>
                <th><?= __('Nombre') ?></th>
                <th><?= __('Apellidos') ?></th>
                <th><?= __('Direccion') ?></th>
                <th><?= __('Expediente') ?></th>
                <th><?= __('Ceas') ?></th>
                <th><?= __('Nacimiento') ?></th>
                <th><?= __('Tipo') ?></th>
                <th><?= __('Estudios') ?></th>
                <th><?= __('Telefono') ?></th>
                <th><?= __('Clasificado Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($clasificado->candidatos as $candidatos): ?>
                 
            
            <tr>
                <td><?= h($candidatos->id) ?></td>
                <td><?= h($candidatos->dni) ?></td>
                <td><?= h($candidatos->nombre) ?></td>
                <td><?= h($candidatos->apellidos) ?></td>
                <td><?= h($candidatos->direccion) ?></td>
                <td><?= //h($candidatos->expediente) 
                        $this->Html->link(__($candidatos->expediente), ['controller' => 'Candidatos','action' => 'view_por_expediente', $candidatos->expediente]);
                        ?></td>

                <td><?= $this->Html->link(__($candidatos->cea->nombre), ['controller' => 'Candidatos', 'action' => 'view_por_cea', $candidatos->cea_id]) ?></td>

                <td><?= h($candidatos->nacimiento) ?></td>
                <td><?= h($candidatos->tipo) ?></td>
                <td><?= h($candidatos->estudios) ?></td>
                <td><?= h($candidatos->telefono) ?></td>
                <td><?= h($candidatos->clasificado_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Candidatos', 'action' => 'view', $candidatos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Candidatos', 'action' => 'edit', $candidatos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Candidatos', 'action' => 'delete', $candidatos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidatos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
