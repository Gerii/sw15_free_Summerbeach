<?php echo $this -> Html -> css('bootstrap/css/bootstrap.min.css', null, array('inline' => false));
echo $this -> Html -> css('DataTables-1.10.4/media/css/jquery.dataTables.css', null, array('inline' => false));
echo $this -> Html -> css('DataTables-1.10.4/media/css/dataTables.bootstrap.css', null, array('inline' => false));
echo $this -> Html -> css('yadcf-0.8.6/jquery.dataTables.yadcf.css', null, array('inline' => false));
echo $this -> Html -> css('DataTables-1.10.4/extensions/Responsive/css/dataTables.responsive.css', null, array('inline' => false));
//echo $this->Html->css('jquery-ui-1.11.2/jquery-ui.css', null, array('inline' => false));
echo $this -> Html -> css('leaflet/leaflet.css', null, array('inline' => false));
echo $this -> Html -> css('name.css', null, array('inline' => false));
echo $this -> Html -> css('jqueryuibootstrap/jquery-ui-1.10.3.custom.css', null, array('inline' => false));

echo $this -> html -> script('jquery-2.1.3.js');
echo $this -> html -> script('bootstrap/js/bootstrap.min.js');
echo $this -> html -> script('DataTables-1.10.4/media/js/jquery.dataTables.min.js');
echo $this -> html -> script('dataTables.bootstrap.js');
echo $this -> html -> script('yadcf-0.8.6/jquery.dataTables.yadcf.js');
echo $this -> html -> script('bootstrap/js/bootstrap.min.js');
echo $this -> html -> script('jquery.dataTables.editable.js');
echo $this -> html -> script('jquery.jeditable.js');
echo $this -> html -> script('jquery.validate.js');
echo $this -> html -> script('DataTables-1.10.4/extensions/Responsive/js/dataTables.responsive.min.js');
echo $this -> html -> script('jquery-ui-1.11.2/jquery-ui.js');
echo $this -> html -> script('leaflet/leaflet.js');
echo $this -> html -> script('socket.io.js');
echo $this -> html -> script('mapping.js');
echo $this -> html -> script('stoplist.js');
?>

<div class="container" role="main">

	<div id="site" style="display: none;">
		<h2 class="spacer"><?php echo __('Stops');

		//debug($stops);
		?></h2>
		<hr />
		<div id="stopstablediv">
			<table id="stopstable">
				<thead>
					<tr>
						<th><?php echo('id'); ?></th>
						<th><?php echo('name'); ?></th>
						<th><?php echo('lon'); ?></th>
						<th><?php echo('lat'); ?></th>
						<th><?php echo('type'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($stops as $stop): ?>
					<tr id="<?php echo h($stop['Stop']['id']); ?>">
						<td class='read_only'><?php echo h($stop['Stop']['id']); ?></td>
						<td><?php echo h($stop['Stop']['name']); ?></td>
						<td class='read_only'><?php echo h($stop['Stop']['lon']); ?></td>
						<td class='read_only'><?php echo h($stop['Stop']['lat']); ?></td>
						<td class='read_only'><?php
						if ($stop['Stop']['tram']) {
							echo h('Bim');
						} elseif ($stop['Stop']['bus']) {
							echo h('Bus');
						}
						?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<div id="stationmap"></div>
</div>
