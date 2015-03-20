<div class="spielplan128s index">
	<h2><?php echo __('Spielplan128s'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('spielnummer'); ?></th>
			<th><?php echo $this->Paginator->sort('kontrahent_1'); ?></th>
			<th><?php echo $this->Paginator->sort('kontrahent_2'); ?></th>
			<th><?php echo $this->Paginator->sort('ort'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($spielplan128s as $spielplan128): ?>
	<tr>
		<td><?php echo h($spielplan128['Spielplan128']['spielnummer']); ?>&nbsp;</td>
		<td><?php echo h($spielplan128['Spielplan128']['kontrahent_1']); ?>&nbsp;</td>
		<td><?php echo h($spielplan128['Spielplan128']['kontrahent_2']); ?>&nbsp;</td>
		<td><?php echo h($spielplan128['Spielplan128']['ort']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $spielplan128['Spielplan128']['spielnummer'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $spielplan128['Spielplan128']['spielnummer'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $spielplan128['Spielplan128']['spielnummer']), array('confirm' => __('Are you sure you want to delete # %s?', $spielplan128['Spielplan128']['spielnummer']))); ?>
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
		<li><?php echo $this->Html->link(__('New Spielplan128'), array('action' => 'add')); ?></li>
	</ul>
</div>
