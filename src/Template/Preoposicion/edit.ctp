<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $preoposicion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $preoposicion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Preoposicion'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="preoposicion form large-9 medium-8 columns content">
    <?= $this->Form->create($preoposicion) ?>
    <fieldset>
        <legend><?= __('Edit Preoposicion') ?></legend>
        <?php
            echo $this->Form->input('dni');
            echo $this->Form->input('plaza');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
