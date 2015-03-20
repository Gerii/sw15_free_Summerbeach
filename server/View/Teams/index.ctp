<div class="teams index">
	<h2><?php echo __('Teams'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('teamname'); ?></th>
			<th><?php echo $this->Paginator->sort('schule'); ?></th>
			<th><?php echo $this->Paginator->sort('startnummer'); ?></th>
			<th><?php echo $this->Paginator->sort('current_ort'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($teams as $team): ?>
	<tr>
		<td><?php echo h($team['Team']['id']); ?>&nbsp;</td>
		<td><?php echo h($team['Team']['teamname']); ?>&nbsp;</td>
		<td><?php echo h($team['Team']['schule']); ?>&nbsp;</td>
		<td><?php echo h($team['Team']['startnummer']); ?>&nbsp;</td>
		<td><?php echo h($team['Team']['current_ort']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $team['Team']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $team['Team']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $team['Team']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $team['Team']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Team'), array('action' => 'add')); ?></li>
	</ul>
</div>
