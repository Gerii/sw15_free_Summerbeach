<div class="stops form">
<?php echo $this->Form->create('Stop'); ?>
	<fieldset>
		<legend><?php echo __('Add Stop'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('lon');
		echo $this->Form->input('lat');
		echo $this->Form->input('type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Stops'), array('action' => 'index')); ?></li>
	</ul>
</div>
