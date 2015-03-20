<div class="spielplan128s form">
<?php echo $this->Form->create('Spielplan128'); ?>
	<fieldset>
		<legend><?php echo __('Add Spielplan128'); ?></legend>
	<?php
		echo $this->Form->input('kontrahent_1');
		echo $this->Form->input('kontrahent_2');
		echo $this->Form->input('ort');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Spielplan128s'), array('action' => 'index')); ?></li>
	</ul>
</div>
