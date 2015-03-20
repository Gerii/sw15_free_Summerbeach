<div class="spielers form">
<?php echo $this->Form->create('Spieler'); ?>
	<fieldset>
		<legend><?php echo __('Add Spieler'); ?></legend>
	<?php
		echo $this->Form->input('team_id');
		echo $this->Form->input('spielernummer');
		echo $this->Form->input('vorname');
		echo $this->Form->input('nachname');
		echo $this->Form->input('geburtsdatum');
		echo $this->Form->input('telefon');
		echo $this->Form->input('strasse');
		echo $this->Form->input('plz');
		echo $this->Form->input('ort');
		echo $this->Form->input('email');
		echo $this->Form->input('schulsprecher');
		echo $this->Form->input('checkin');
		echo $this->Form->input('spark7');
		echo $this->Form->input('geschlecht');
		echo $this->Form->input('shirt');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Spielers'), array('action' => 'index')); ?></li>
	</ul>
</div>
