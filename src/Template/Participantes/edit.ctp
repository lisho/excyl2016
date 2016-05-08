<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $participante->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $participante->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Participantes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="participantes form large-9 medium-8 columns content">
    <?= $this->Form->create($participante) ?>
    <fieldset>
        <legend><?= __('Edit Participante') ?></legend>
        <?php
            echo $this->Form->input('dni');
            echo $this->Form->input('nombre');
            echo $this->Form->input('apellidos');
            echo $this->Form->input('numedis');
            echo $this->Form->input('numrgc');
            echo $this->Form->input('tedis');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
