<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2">
      &nbsp;
    </div>
		<div class="span10">
			<section id="typography">
			<div class="page-header">
				<h1>Connect to Database <small>Supports MySQL databases</small></h1>
			</div>
		
			<?php echo validation_errors(); ?>
		
			<form class="form-horizontal" accept-charset="utf-8" method="post" action="">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="dbhost">DB Host:</label>
						<div class="controls">
							<input name="dbhost" type="text">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="dbhost">DB Port:</label>
						<div class="controls">
							<input name="dbhost" type="text">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="dbhost">DB Username:</label>
						<div class="controls">
							<input name="dbhost" type="text">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="dbhost">DB Password:</label>
						<div class="controls">
							<input name="dbhost" type="text">
						</div>
					</div>					
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Attempt Connection</button>
						<button class="btn">Cancel</button>
					</div>					
				</fieldset>
			</form>
			</section>
		</div>
    </div>
  </div>
</div>