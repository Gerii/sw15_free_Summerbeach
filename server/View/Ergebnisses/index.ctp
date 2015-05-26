<div class="ergebnisses index">
	<h2><?php echo __('Ergebnisses'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('spielnummer'); ?></th>
			<th><?php echo $this->Paginator->sort('gewinner'); ?></th>
			<th><?php echo $this->Paginator->sort('update'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($ergebnisses as $ergebniss): ?>
	<tr>
		<td><?php echo h($ergebniss['Ergebniss']['id']); ?>&nbsp;</td>
		<td><?php echo h($ergebniss['Ergebniss']['spielnummer']); ?>&nbsp;</td>
		<td><?php echo h($ergebniss['Ergebniss']['gewinner']); ?>&nbsp;</td>
		<td><?php echo h($ergebniss['Ergebniss']['update']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ergebniss['Ergebniss']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ergebniss['Ergebniss']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ergebniss['Ergebniss']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $ergebniss['Ergebniss']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Ergebniss'), array('action' => 'add')); ?></li>
	</ul>
</div>
