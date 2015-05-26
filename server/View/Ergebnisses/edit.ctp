<div class="ergebnisses form">
<?php echo $this->Form->create('Ergebniss'); ?>
	<fieldset>
		<legend><?php echo __('Edit Ergebniss'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('spielnummer');
		echo $this->Form->input('gewinner');
		echo $this->Form->input('update');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Ergebniss.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Ergebniss.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ergebnisses'), array('action' => 'index')); ?></li>
	</ul>
</div>
