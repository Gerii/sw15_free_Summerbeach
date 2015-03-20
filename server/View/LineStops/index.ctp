<div class="lineStops index">
	<h2><?php echo __('Line Stops'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('line_id'); ?></th>
			<th><?php echo $this->Paginator->sort('stop_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($lineStops as $lineStop): ?>
	<tr>
		<td><?php echo h($lineStop['LineStop']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($lineStop['Line']['name'], array('controller' => 'lines', 'action' => 'view', $lineStop['Line']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($lineStop['Stop']['name'], array('controller' => 'stops', 'action' => 'view', $lineStop['Stop']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $lineStop['LineStop']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $lineStop['LineStop']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $lineStop['LineStop']['id']), array(), __('Are you sure you want to delete # %s?', $lineStop['LineStop']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Line Stop'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Lines'), array('controller' => 'lines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line'), array('controller' => 'lines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stops'), array('controller' => 'stops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stop'), array('controller' => 'stops', 'action' => 'add')); ?> </li>
	</ul>
</div>
