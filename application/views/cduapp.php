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
            <section id="specify" class="hidden">
            	<form name="populateSelectDB" action="<?php echo base_url("index.php/cdumain/populateSelectDB"); ?>"></form>
                <div class="page-header">
                    <h1>Specify CDU <small>Choose important slices of a database table</small></h1>
                </div>            
            </section>
		</div>
    </div>
  </div>
</div>