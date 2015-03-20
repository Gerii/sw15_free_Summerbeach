<div class="lines form">
<?php echo $this->Form->create('Line'); ?>
	<fieldset>
		<legend><?php echo __('Add Line'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('type');
		echo $this->Form->input('number');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Lines'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Line Stops'), array('controller' => 'line_stops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line Stop'), array('controller' => 'line_stops', 'action' => 'add')); ?> </li>
	</ul>
</div>
