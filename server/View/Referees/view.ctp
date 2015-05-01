<div class="teamnames view">
<h2><?php echo __('Teamname'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($teamname['Teamname']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($teamname['Teamname']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($teamname['Teamname']['password']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Teamname'), array('action' => 'edit', $teamname['Teamname']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Teamname'), array('action' => 'delete', $teamname['Teamname']['id']), array(), __('Are you sure you want to delete # %s?', $teamname['Teamname']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Teamnames'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Teamname'), array('action' => 'add')); ?> </li>
	</ul>
</div>
