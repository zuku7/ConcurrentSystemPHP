<div class="users form">
<?= $this->Flash->render('auth') ?>
<div class="active"><center><h2>Concurrent system</h2></center></div>

<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Login') ?></legend>
        <?= $this->Form->input('email',array('label' => 'Email:')) ?>
        <?= $this->Form->input('password',array('label' => 'Password:')); ?>
    </fieldset>
<?= $this->Form->button(__('Sign in')); ?>
<?= $this->Form->end() ?>
</div>