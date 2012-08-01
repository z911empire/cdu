<html>
<head>
<title>CDU Builder</title>
</head>
<body>

<?php echo validation_errors(); ?>

<?php echo form_open('specify_cdu'); ?>

<h5>DB Host</h5>
<input type="text" name="dbhost" value="" size="50" />

<h5>DB Port</h5>
<input type="text" name="dbport" value="" size="50" />

<h5>DB User</h5>
<input type="text" name="dbuser" value="" size="50" autocomplete="off"/>

<h5>DB Password</h5>
<input type="password" name="dbpass" value="" size="50" autocomplete="off" />

<div><input type="submit" value="Attempt Connection" /></div>

</form>

</body>
</html>