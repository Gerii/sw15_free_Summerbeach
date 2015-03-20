<div class="stops index">
	<h2><?php echo __('Stops'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('lon'); ?></th>
			<th><?php echo $this->Paginator->sort('lat'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($stops as $stop): ?>
	<tr>
		<td><?php echo h($stop['Stop']['id']); ?>&nbsp;</td>
		<td><?php echo h($stop['Stop']['name']); ?>&nbsp;</td>
		<td><?php echo h($stop['Stop']['lon']); ?>&nbsp;</td>
		<td><?php echo h($stop['Stop']['lat']); ?>&nbsp;</td>
		<td><?php echo h($stop['Stop']['type']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $stop['Stop']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $stop['Stop']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $stop['Stop']['id']), array(), __('Are you sure you want to delete # %s?', $stop['Stop']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Stop'), array('action' => 'add')); ?></li>
	</ul>
</div>
