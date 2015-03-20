<?php echo $this -> Html -> css('bootstrap/css/bootstrap.min.css', null, array('inline' => false));
echo $this -> Html -> css('DataTables-1.10.4/media/css/jquery.dataTables.css', null, array('inline' => false));
echo $this -> Html -> css('DataTables-1.10.4/extensions/Responsive/css/dataTables.responsive.css', null, array('inline' => false));
echo $this -> Html -> css('yadcf-0.8.6/jquery.dataTables.yadcf.css', null, array('inline' => false));
echo $this -> Html -> css('DataTables-1.10.4/extensions/Responsive/css/dataTables.responsive.css', null, array('inline' => false));
echo $this -> Html -> css('jqueryuibootstrap/jquery-ui-1.10.3.custom.css', null, array('inline' => false));
echo $this -> Html -> css('leaflet/leaflet.css', null, array('inline' => false));
echo $this -> Html -> css('newline.css', null, array('inline' => false));

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
echo $this -> html -> script('newline.js');
echo $this -> html -> script('addnewlineDialog.js');
?>

<div class="container" role="main">
	<div  id="site" style="display: none;">
		<h2 class="spacer"><?php echo __('Stops');

		//debug($stops);
		?></h2>
		<hr />
		<div id="stopstablediv">
			<table id="stopstable" >
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

		<h2><?php echo __('Stops of new line'); ?></h2>
		<hr />
		<div class="alert alert-danger" id="cantaddmessage" role="alert">
			<a class="close" data-dismiss="alert">×</a>
			<strong>Can't add stop!</strong> You can only add <span id="type"></span> lines here.
		</div>
		<div class="alert alert-danger" id="cantcreatemessage" role="alert">
			<a class="close" data-dismiss="alert">×</a>
			<strong>Can't create line!</strong> You need to add at least two stops.
		</div>
		<div class="alert alert-danger" id="cantaddalreadyaddedmessage" role="alert">
			<a class="close" data-dismiss="alert">×</a>
			<strong>Can't add stop!</strong> Stop has already been added to the list.
		</div>
		<div class="alert alert-success" id="linesavedmessage" role="alert">
			<a class="close" data-dismiss="alert">×</a>
			<strong>Saved line!</strong> Your line has been successfully saved.
		</div>
		<div id="newlinetableDropArea">
			<table id="newlinetable">
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
				<tbody>

				</tbody>
			</table>
		</div>
		<div id="save">
			<button class="btn btn-primary" id="saveButton">
				Save
			</button>
		</div>
		<hr />

	</div>

	<div id="dialog-form" title="Create new line">
		<p class="validateTips">
			All form fields are required.
		</p>

		<form>
			<fieldset>
				<label for="name">Name</label>
				<input type="text" name="name" id="name" value="" class="text ui-widget-content ui-corner-all">
				<br />
				<label for="nmbr">Number</label>
				<input type="text" name="nmbr" id="number" value="" class="text ui-widget-content ui-corner-all">

				<!-- Allow form submission with keyboard without duplicating the dialog button -->
				<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			</fieldset>
		</form>
	</div>
	<div id="newlinemap"></div>
</div>
