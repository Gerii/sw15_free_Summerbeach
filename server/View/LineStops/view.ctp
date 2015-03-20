<div class="lineStops view">
<h2><?php echo __('Line Stop'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($lineStop['LineStop']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Line'); ?></dt>
		<dd>
			<?php echo $this->Html->link($lineStop['Line']['name'], array('controller' => 'lines', 'action' => 'view', $lineStop['Line']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stop'); ?></dt>
		<dd>
			<?php echo $this->Html->link($lineStop['Stop']['name'], array('controller' => 'stops', 'action' => 'view', $lineStop['Stop']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Line Stop'), array('action' => 'edit', $lineStop['LineStop']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Line Stop'), array('action' => 'delete', $lineStop['LineStop']['id']), array(), __('Are you sure you want to delete # %s?', $lineStop['LineStop']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Line Stops'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line Stop'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lines'), array('controller' => 'lines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line'), array('controller' => 'lines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stops'), array('controller' => 'stops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stop'), array('controller' => 'stops', 'action' => 'add')); ?> </li>
	</ul>
</div>
