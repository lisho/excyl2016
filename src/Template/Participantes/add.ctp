<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Participantes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="participantes form large-9 medium-8 columns content">
    <?= $this->Form->create($participante) ?>
    <fieldset>
        <legend><?= __('Add Participante') ?></legend>
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
