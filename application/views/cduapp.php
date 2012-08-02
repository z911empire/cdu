<div class="container-fluid">
	<div class="row-fluid">
		<div class="span2">
		  &nbsp;
		</div>
		<div class="span10">
			<section id="attempt">
				<div class="page-header">
					<h1>Connect to Database <small>Supports MySQL databases</small></h1>
				</div>
				
				<form name="attemptDBConnection" class="form-horizontal" accept-charset="utf-8" action="<?php echo base_url("index.php/cdumain/attemptDBConnection"); ?>">
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="dbhost">DB Host:</label>
							<div class="controls">
								<input name="dbhost" type="text" autocomplete="off">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="dbport">DB Port:</label>
							<div class="controls">
								<input name="dbport" type="text" autocomplete="off">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="dbuser">DB Username:</label>
							<div class="controls">
								<input name="dbuser" type="text" autocomplete="off">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="dbpass">DB Password:</label>
							<div class="controls">
								<input name="dbpass" type="text" autocomplete="off">
							</div>
						</div>					
						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Attempt Connection</button>
							<!--<button class="btn">Cancel</button>-->
						</div>					
					</fieldset>
				</form>
			</section>
			<section id="specify" class="">
				<div class="page-header">
					<h1>Specify CDU <small>Choose important slices of a database table</small></h1>
				</div>
				<form name="specifyCDU" accept-charset="utf-8" action="<?php echo base_url("index.php/cdumain/specifyCDU"); ?>">
					<fieldset>
						<div class="control-group span3">
							<label class="control-label" for="cduname">Name this CDU:</label>
							<input type="text" name="cduname" autocomplete="off">
						</div>
						<div class="control-group span3">
							<label class="control-label" for="dbselect">Choose Database:</label>
							  <select name="dbselect" size="10"></select>
						</div>
						<div class="control-group span3">
							<label class="control-label" for="tableselect">Choose Table:</label>
							  <select name="tableselect" size="10"></select>
						</div>
						<div class="control-group span3">
							<label class="control-label" for="columnselect">Choose Column(s):</label>
							  <select multiple name="columnselect" size="10"></select>
						</div>
						<div class="form-actions" style="clear:both;">
							<button type="submit" class="btn btn-primary">Save CDU</button>
							<!--<button class="btn">Cancel</button>-->
						</div>						
					</fieldset>
				</form>
			</section>
		</div> <!-- span10 -->
	</div>
	<form name="populateSelectDB" action="<?php echo base_url("index.php/cdumain/populateSelectDB"); ?>"></form>
	<form name="populateSelectTable" action="<?php echo base_url("index.php/cdumain/populateSelectTable"); ?>"></form>
	<form name="populateSelectColumn" action="<?php echo base_url("index.php/cdumain/populateSelectColumn"); ?>"></form>	
</div>
