<?php echo $this -> Html -> css('bootstrap/css/bootstrap.min.css', null, array('inline' => false));
echo $this -> Html -> css('DataTables-1.10.4/media/css/jquery.dataTables.css', null, array('inline' => false));
echo $this -> Html -> css('DataTables-1.10.4/extensions/Responsive/css/dataTables.responsive.css', null, array('inline' => false));
echo $this -> Html -> css('yadcf-0.8.6/jquery.dataTables.yadcf.css', null, array('inline' => false));
echo $this -> Html -> css('leaflet/leaflet.css', null, array('inline' => false));
echo $this -> Html -> css('linesFind.css', null, array('inline' => false));
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
echo $this -> html -> script('spin.js');
echo $this -> html -> script('spinningwheeljquery.js');
echo $this -> html -> script('leaflet/leaflet.js');
echo $this -> html -> script('socket.io.js');
echo $this -> html -> script('mapping.js');
echo $this -> html -> script('linesFind.js');
echo $this -> html -> script('addStopToLine.js');
?>
<div class="container" role="main">
	<div>
		<h2 class="spacer"><?php echo __('Search for line'); ?></h2>
		<hr />
		<?php echo $this -> Form -> input('link', array('label' => false, "class" => " form-control stationInput input-medium", "placeholder" => __('Enter start station'), 'id' => 'name1')); ?>
		<br />
		<?php echo $this -> Form -> input('link', array('label' => false, "class" => " form-control stationInput input-medium", "placeholder" => __('Enter destination station'), 'id' => 'name2')); ?>
		<br />
		<?php echo $this->Form->button('Suchen', array('class' => 'btn btn-primary icon-search icon-white' ,'onclick' => "location.href='/map/lines/find/'+window.btoa(document.getElementById('name1').value)+'/'+window.btoa(document.getElementById('name2').value);")); ?>
		<br />
		<br />
	</div>

	<div id="site" style="display: none;">
		<h2><?php echo __('Lines'); ?></h2>
		<hr />
		<table id="linesTable">
			<thead>
				<tr>
					<th><?php echo('id'); ?></th>
					<th><?php echo('name'); ?></th>
					<th><?php echo('type'); ?></th>
					<th><?php echo('number'); ?></th>

				</tr>
			</thead>
			<tbody>
				<?php foreach ($lines as $line): ?>
				<tr id="<?php echo h($line['Line']['id']); ?>">
					<td class='read_only'><?php echo h($line['Line']['id']); ?></td>
					<td><?php echo $line['Line']['name']; ?></td>
					<td class='read_only'><?php echo h($line['Line']['type'] == 2 ? "Bus" : "Bim"); ?></td>
					<td><?php echo h($line['Line']['number']); ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<h2>Corresponding <?php echo __('Stops'); ?></h2>
		<hr />
		
		<div class="alert alert-danger" id="toofewstopserror" role="alert">
			<a class="close" data-dismiss="alert">×</a>
			<strong>Can't delete!</strong> You need at least two stops per line.
		</div>
		<p>
			<button id="addStopToLine">
				Add stop to line
			</button>
		</p>
		<table id="stopstable">
			<thead>
				<tr>
					<th><?php echo('id'); ?></th>
					<th><?php echo('name'); ?></th>
					<th><?php echo('lon'); ?></th>
					<th><?php echo('lat'); ?></th>
					<th><?php echo('type'); ?></th>
					<th></th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>

		<div id="dialog-form" title="Create new line">
			<table  style="width:800px;" id="addStopTolineTable">
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

				</tbody>
			</table>
		</div>

	</div>
	<div id='linesMap'></div>
</div>
