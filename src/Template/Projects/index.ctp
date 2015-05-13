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
<div class="projects index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('start') ?></th>
            <th><?= $this->Paginator->sort('end') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($projects as $project): ?>
        <tr>
            <td><?= $this->Number->format($project->id) ?></td>
            <td><?= h($project->start) ?></td>
            <td><?= h($project->end) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $project->id]) ?>
                 <?php if ($role=='1'): ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $project->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?>
                 <?php endif; ?>
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
