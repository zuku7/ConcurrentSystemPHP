            <div class="row">
            	<div class="actions columns large-2 medium-3">
	<h3>Hi, <?=  $name ?></h3>
    
    <ul class="side-nav">
    	<?php if ($role=='1'): ?>
        <li><?= $this->Html->link(__('New user'), ['action' => 'add']) ?></li>
       
        <li><?= $this->Html->link(__('List users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>

        <li><?= $this->Html->link(__('New task'), ['controller' => 'Tasks', 'action' => 'add']) ?> </li>
         <li><?= $this->Html->link(__('New project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
         <?php endif; ?>
        <li><?= $this->Html->link(__('List tasks'), ['controller' => 'Tasks', 'action' => 'myprofile']) ?> </li>
        <li><?= $this->Html->link(__('List projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
       <li><?= $this->Html->link(__('Settings'), ['controller' => 'Users','action' => 'edit', $id]) ?></li>
        <li><?= $this->Html->link(__('Log out'), ['controller' => 'Users', 'action' => 'logout']) ?> </li>
    </ul>
</div>
<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('login');
            echo $this->Form->input('password');
            echo $this->Form->input('email');
			if ($role=='1'):
            echo $this->Form->input('group_id', ['options' => $groups]);
				endif;
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
