<div class="teams view">
<h2><?php echo __('Team'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($team['Team']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Teamname'); ?></dt>
		<dd>
			<?php echo h($team['Team']['teamname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Schule'); ?></dt>
		<dd>
			<?php echo h($team['Team']['schule']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Startnummer'); ?></dt>
		<dd>
			<?php echo h($team['Team']['startnummer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Current Ort'); ?></dt>
		<dd>
			<?php echo h($team['Team']['current_ort']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Team'), array('action' => 'edit', $team['Team']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Team'), array('action' => 'delete', $team['Team']['id']), array(), __('Are you sure you want to delete # %s?', $team['Team']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('action' => 'add')); ?> </li>
	</ul>
</div>
