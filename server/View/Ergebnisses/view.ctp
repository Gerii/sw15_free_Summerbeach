<div class="ergebnisses view">
<h2><?php echo __('Ergebniss'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ergebniss['Ergebniss']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Spielnummer'); ?></dt>
		<dd>
			<?php echo h($ergebniss['Ergebniss']['spielnummer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gewinner'); ?></dt>
		<dd>
			<?php echo h($ergebniss['Ergebniss']['gewinner']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Update'); ?></dt>
		<dd>
			<?php echo h($ergebniss['Ergebniss']['update']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ergebniss'), array('action' => 'edit', $ergebniss['Ergebniss']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ergebniss'), array('action' => 'delete', $ergebniss['Ergebniss']['id']), array(), __('Are you sure you want to delete # %s?', $ergebniss['Ergebniss']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ergebnisses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ergebniss'), array('action' => 'add')); ?> </li>
	</ul>
</div>
