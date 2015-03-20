<div class="standortes view">
<h2><?php echo __('Standorte'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($standorte['Standorte']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($standorte['Standorte']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Short'); ?></dt>
		<dd>
			<?php echo h($standorte['Standorte']['short']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Standorte'), array('action' => 'edit', $standorte['Standorte']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Standorte'), array('action' => 'delete', $standorte['Standorte']['id']), array(), __('Are you sure you want to delete # %s?', $standorte['Standorte']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Standortes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Standorte'), array('action' => 'add')); ?> </li>
	</ul>
</div>
