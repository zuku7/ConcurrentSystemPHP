<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
    	 <?php if ($role=='1'): ?>
        <li><?= $this->Html->link(__('New Task'), ['action' => 'add']) ?></li>
         <?php endif; ?>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Gantt chart'), ['action' => 'chart']) ?> </li>
        <?php if ($role=='1'): ?>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
        <?php endif; ?>
        
    </ul>
</div>
<div class="tasks index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
			<th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('start') ?></th>
            <th><?= $this->Paginator->sort('end') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th><?= $this->Paginator->sort('project_id') ?></th>            
            <th><?= $this->Paginator->sort('parent_task_id') ?></th>
			<th><?= $this->Paginator->sort('is_finished') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php 
	$tasks_names;
	$tasks_names[0] = '';
	foreach ($tasks as $task):
		$tasks_names[$task->id] = $task->name;
	endforeach;

	foreach ($tasks as $task): 	

	 ?>
        <tr>
            <td><?= $this->Number->format($task->id) ?></td>
			<td><?= h($task->name) ?></td>
            <td><?= h($task->start) ?></td>
            <td><?= h($task->end) ?></td>
            <td>
                <?= $task->has('user') ? $this->Html->link($task->user->login, ['controller' => 'Users', 'action' => 'view', $task->user->id]) : '' ?>
            </td>
            <td>
                <?= $task->has('project') ? $this->Html->link($task->project->name, ['controller' => 'Projects', 'action' => 'view', $task->project->id]) : '' ?>
            </td>
            <td>
				
				<?= 
				 
					$task->has('parent_task_id') ? $this->Html->link($tasks_names[$task->parent_task_id], ['controller' => 'Tasks', 'action' => 'view', $task->parent_task_id]) : '' 
				
				?>
				
			</td>
			<td><?= $task->is_finished ? 'Finished' : '' ?></td>
            <td class="actions">
            	 <?php if ($role=='1'): ?>
                
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $task->id]) ?>
                
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $task->id], ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]) ?>
                  <?php endif; ?>
                <?= $this->Html->link(__('View'), ['action' => 'view', $task->id]) ?>
                <?= $this->Html->link(__('Add file'), ['action' => 'upload', $task->id]) ?>
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
