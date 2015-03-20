<div class="spielers view">
<h2><?php echo __('Spieler'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Team Id'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['team_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Spielernummer'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['spielernummer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vorname'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['vorname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nachname'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['nachname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Geburtsdatum'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['geburtsdatum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telefon'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['telefon']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Strasse'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['strasse']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Plz'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['plz']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ort'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['ort']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Schulsprecher'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['schulsprecher']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Checkin'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['checkin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Spark7'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['spark7']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Geschlecht'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['geschlecht']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shirt'); ?></dt>
		<dd>
			<?php echo h($spieler['Spieler']['shirt']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Spieler'), array('action' => 'edit', $spieler['Spieler']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Spieler'), array('action' => 'delete', $spieler['Spieler']['id']), array(), __('Are you sure you want to delete # %s?', $spieler['Spieler']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Spielers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Spieler'), array('action' => 'add')); ?> </li>
	</ul>
</div>
