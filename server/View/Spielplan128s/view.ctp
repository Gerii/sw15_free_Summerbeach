<div class="spielplan128s view">
<h2><?php echo __('Spielplan128'); ?></h2>
	<dl>
		<dt><?php echo __('Spielnummer'); ?></dt>
		<dd>
			<?php echo h($spielplan128['Spielplan128']['spielnummer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kontrahent 1'); ?></dt>
		<dd>
			<?php echo h($spielplan128['Spielplan128']['kontrahent_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kontrahent 2'); ?></dt>
		<dd>
			<?php echo h($spielplan128['Spielplan128']['kontrahent_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ort'); ?></dt>
		<dd>
			<?php echo h($spielplan128['Spielplan128']['ort']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Spielplan128'), array('action' => 'edit', $spielplan128['Spielplan128']['spielnummer'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Spielplan128'), array('action' => 'delete', $spielplan128['Spielplan128']['spielnummer']), array(), __('Are you sure you want to delete # %s?', $spielplan128['Spielplan128']['spielnummer'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Spielplan128s'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Spielplan128'), array('action' => 'add')); ?> </li>
	</ul>
</div>
