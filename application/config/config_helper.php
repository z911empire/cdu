<?php
	function readConfigs($config_filename) {
		$configs = array();
		$fh = fopen($config_filename, 'r', 1);
		if (!$fh) { error_log("Error opening config file $config_filename.",0); return; } 
		while (!feof($fh)) {
			$keyval=explode('=',trim(fgets($fh)));
			$configs[$keyval[0]]=$keyval[1];
		}
		fclose($fh);
		return $configs;
	}
/*	function getConfig($key) {
		if (isset($configs[$key])) {
			return $configs[$key];
		} else {
			error_log("No configs with key $key available.",0);
			return "";
		}
	}*/
?>