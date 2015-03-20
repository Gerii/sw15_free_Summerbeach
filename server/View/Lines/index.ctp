<div class="lines index">
	<h2><?php echo __('Lines'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo ('id'); ?></th>
			<th><?php echo ('name'); ?></th>
			<th><?php echo ('type'); ?></th>
			<th><?php echo ('number'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($lines as $line): ?>
	<tr>
		<td><?php echo h($line['Line']['id']); ?></td>
		<td><?php echo h($line['Line']['name']); ?></td>
		<td><?php echo h($line['Line']['type']); ?></td>
		<td><?php echo h($line['Line']['number']); ?></td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Line'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Line Stops'), array('controller' => 'line_stops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line Stop'), array('controller' => 'line_stops', 'action' => 'add')); ?> </li>
	</ul>
</div>
