<?= $this->Form->create($notification) ?>
    <?= $this->Form->control('user_id', ['options' => $users, 'label' => 'Send To']) ?>
    <?= $this->Form->control('title') ?>
    <?= $this->Form->control('message', ['type' => 'textarea']) ?>
    <?= $this->Form->button('Send Notification') ?>
<?= $this->Form->end() ?>
