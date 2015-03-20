<div class="lineStops form">
<?php echo $this->Form->create('LineStop'); ?>
	<fieldset>
		<legend><?php echo __('Add Line Stop'); ?></legend>
	<?php
		echo $this->Form->input('line_id');
		echo $this->Form->input('stop_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Line Stops'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Lines'), array('controller' => 'lines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line'), array('controller' => 'lines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stops'), array('controller' => 'stops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stop'), array('controller' => 'stops', 'action' => 'add')); ?> </li>
	</ul>
</div>
