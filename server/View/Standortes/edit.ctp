<div class="standortes form">
<?php echo $this->Form->create('Standorte'); ?>
	<fieldset>
		<legend><?php echo __('Edit Standorte'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('short');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Standorte.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Standorte.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Standortes'), array('action' => 'index')); ?></li>
	</ul>
</div>
