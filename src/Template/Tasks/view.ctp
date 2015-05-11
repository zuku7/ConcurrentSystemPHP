<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
    	<?php if ($role=='1'): ?>
        <li><?= $this->Html->link(__('Edit Task'), ['action' => 'edit', $task->id]) ?> </li>
        
        
        <li><?= $this->Form->postLink(__('Delete Task'), ['action' => 'delete', $task->id], ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]) ?> </li>
        
        <li><?= $this->Html->link(__('New Task'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
      
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
         <?php endif; ?>
         <li><?= $this->Html->link(__('List Tasks'), ['action' => 'index']) ?> </li>
           <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
    </ul>
</div>
<div class="tasks view large-10 medium-9 columns">
    <h2><?= h($task->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $task->has('user') ? $this->Html->link($task->user->id, ['controller' => 'Users', 'action' => 'view', $task->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Project') ?></h6>
            <p><?= $task->has('project') ? $this->Html->link($task->project->name, ['controller' => 'Projects', 'action' => 'view', $task->project->id]) : '' ?></p>
			<h6 class="subheader"><?= __('Is Finished') ?></h6>
            <p><?= $task->is_finished ? 'Yes' : 'No' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($task->id) ?></p>
            <h6 class="subheader"><?= __('Parent Task Id') ?></h6>
            <p><?= $this->Number->format($task->parent_task_id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Start') ?></h6>
            <p><?= h($task->start) ?></p>
            <h6 class="subheader"><?= __('End') ?></h6>
            <p><?= h($task->end) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <?= $this->Text->autoParagraph(h($task->name)); ?>

        </div>
    </div>
    
        <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Files') ?></h6>
        
            
          	<?php foreach ($files as $file): ?>

            <?= $this->Text->autoParagraph($file);  ?>
             
            <?php endforeach; ?>
			
          

        </div>
    </div>
    
</div>
