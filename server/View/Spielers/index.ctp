<div class="spielers index">
	<h2><?php echo __('Spielers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('team_id'); ?></th>
			<th><?php echo $this->Paginator->sort('spielernummer'); ?></th>
			<th><?php echo $this->Paginator->sort('vorname'); ?></th>
			<th><?php echo $this->Paginator->sort('nachname'); ?></th>
			<th><?php echo $this->Paginator->sort('geburtsdatum'); ?></th>
			<th><?php echo $this->Paginator->sort('telefon'); ?></th>
			<th><?php echo $this->Paginator->sort('strasse'); ?></th>
			<th><?php echo $this->Paginator->sort('plz'); ?></th>
			<th><?php echo $this->Paginator->sort('ort'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('schulsprecher'); ?></th>
			<th><?php echo $this->Paginator->sort('checkin'); ?></th>
			<th><?php echo $this->Paginator->sort('spark7'); ?></th>
			<th><?php echo $this->Paginator->sort('geschlecht'); ?></th>
			<th><?php echo $this->Paginator->sort('shirt'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($spielers as $spieler): ?>
	<tr>
		<td><?php echo h($spieler['Spieler']['id']); ?>&nbsp;</td>
		<td><?php echo h($spieler['Spieler']['team_id']); ?>&nbsp;</td>
		<td><?php echo h($spieler['Spieler']['spielernummer']); ?>&nbsp;</td>
		<td><?php echo h($spieler['Spieler']['vorname']); ?>&nbsp;</td>
		<td><?php echo h($spieler['Spieler']['nachname']); ?>&nbsp;</td>
		<td><?php echo h($spieler['Spieler']['geburtsdatum']); ?>&nbsp;</td>
		<td><?php echo h($spieler['Spieler']['telefon']); ?>&nbsp;</td>
		<td><?php echo h($spieler['Spieler']['strasse']); ?>&nbsp;</td>
		<td><?php echo h($spieler['Spieler']['plz']); ?>&nbsp;</td>
		<td><?php echo h($spieler['Spieler']['ort']); ?>&nbsp;</td>
		<td><?php echo h($spieler['Spieler']['email']); ?>&nbsp;</td>
		<td><?php echo h($spieler['Spieler']['schulsprecher']); ?>&nbsp;</td>
		<td><?php echo h($spieler['Spieler']['checkin']); ?>&nbsp;</td>
		<td><?php echo h($spieler['Spieler']['spark7']); ?>&nbsp;</td>
		<td><?php echo h($spieler['Spieler']['geschlecht']); ?>&nbsp;</td>
		<td><?php echo h($spieler['Spieler']['shirt']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $spieler['Spieler']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $spieler['Spieler']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $spieler['Spieler']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $spieler['Spieler']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Spieler'), array('action' => 'add')); ?></li>
	</ul>
</div>
