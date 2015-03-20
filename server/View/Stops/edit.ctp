<div class="stops form">
<?php echo $this->Form->create('Stop'); ?>
	<fieldset>
		<legend><?php echo __('Edit Stop'); ?></legend>
	<?php
		echo $this->Form->input('id');
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
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Stop.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Stop.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Stops'), array('action' => 'index')); ?></li>
	</ul>
</div>
