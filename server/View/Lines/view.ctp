<div class="lines view">
<h2><?php echo __('Line'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($line['Line']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($line['Line']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($line['Line']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number'); ?></dt>
		<dd>
			<?php echo h($line['Line']['number']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Line'), array('action' => 'edit', $line['Line']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Line'), array('action' => 'delete', $line['Line']['id']), array(), __('Are you sure you want to delete # %s?', $line['Line']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Lines'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Line Stops'), array('controller' => 'line_stops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line Stop'), array('controller' => 'line_stops', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Line Stops'); ?></h3>
	<?php if (!empty($line['LineStop'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Line Id'); ?></th>
		<th><?php echo __('Stop Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($line['LineStop'] as $lineStop): ?>
		<tr>
			<td><?php echo $lineStop['id']; ?></td>
			<td><?php echo $lineStop['line_id']; ?></td>
			<td><?php echo $lineStop['stop_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'line_stops', 'action' => 'view', $lineStop['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'line_stops', 'action' => 'edit', $lineStop['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'line_stops', 'action' => 'delete', $lineStop['id']), array(), __('Are you sure you want to delete # %s?', $lineStop['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Line Stop'), array('controller' => 'line_stops', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
