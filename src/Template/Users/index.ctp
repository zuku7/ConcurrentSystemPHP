
<?php
	$_SESSION['username'] = $name;
?>

<link type="text/css" rel="stylesheet" media="all" href="/chat/css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="/chat/css/screen.css" />
 
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="/chat/css/screen_ie.css" />
<![endif]-->
<script src="/chat/js/jquery.js"></script>
<script src="/chat/js/chat.js"></script>
<style>
body {
	background-color: #eeeeee;
	padding:0;
	margin:0 auto;
	font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
	font-size:11px;
}
</style>
 
<div id="main_container">

<div class="actions columns large-2 medium-3">
	<h3>Hi, <?=  $name ?></h3>
    
    <ul class="side-nav">
    	<?php if ($role=='1'): ?>
        <li><?= $this->Html->link(__('New user'), ['action' => 'add']) ?></li>
       
        <li><?= $this->Html->link(__('List users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New task'), ['controller' => 'Tasks', 'action' => 'add']) ?> </li>
         <li><?= $this->Html->link(__('New project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
         <?php endif; ?>
        <li><?= $this->Html->link(__('List tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('Chat'), ['controller' => 'Users', 'action' => 'chat']) ?> </li>
       
        <li><?= $this->Html->link(__('Log out'), ['controller' => 'Users', 'action' => 'logout']) ?> </li>
    </ul>
</div>


<a href="javascript:void(0)" onclick="javascript:chatWith('nowy')">Chat With Jane Doe</a><br/>
 
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->
<div class="users index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
             <th><?= $this->Paginator->sort('login') ?></th>
             <th><?= $this->Paginator->sort('email') ?></th>
            <th><?= $this->Paginator->sort('group_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $this->Number->format($user->id) ?></td>
            <td><?= $user->login ?></td>
            <td><?= $user->email ?></td>
            <td>
                <?= $user->has('group') ? $this->Html->link($user->group->name, ['controller' => 'Groups', 'action' => 'view', $user->group->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('Zobacz'), ['action' => 'view', $user->id]) ?>
                <?= $this->Html->link(__('Edytuj'), ['action' => 'edit', $user->id]) ?>
                <?= $this->Form->postLink(__('Usuń'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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

</div>
