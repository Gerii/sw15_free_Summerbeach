<div class="stops view">
<h2><?php echo __('Stop'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($stop['Stop']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($stop['Stop']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lon'); ?></dt>
		<dd>
			<?php echo h($stop['Stop']['lon']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lat'); ?></dt>
		<dd>
			<?php echo h($stop['Stop']['lat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($stop['Stop']['type']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Stop'), array('action' => 'edit', $stop['Stop']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Stop'), array('action' => 'delete', $stop['Stop']['id']), array(), __('Are you sure you want to delete # %s?', $stop['Stop']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Stops'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stop'), array('action' => 'add')); ?> </li>
	</ul>
</div>
