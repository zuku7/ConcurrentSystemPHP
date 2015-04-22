<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Podaj email i hasło:') ?></legend>
        <?= $this->Form->input('email',array('label' => 'Email:')) ?>
        <?= $this->Form->input('password',array('label' => 'Haslo:')); ?>
    </fieldset>
<?= $this->Form->button(__('Zaloguj')); ?>
<?= $this->Form->end() ?>
</div>