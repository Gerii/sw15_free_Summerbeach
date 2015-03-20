<div class="standortes form">
<?php echo $this->Form->create('Standorte'); ?>
	<fieldset>
		<legend><?php echo __('Add Standorte'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('short');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Standortes'), array('action' => 'index')); ?></li>
	</ul>
</div>
