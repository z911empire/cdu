<?php
class MY_Form_validation extends CI_Form_validation {
    function __construct($config = array()) {
        parent::__construct($config);
    }
 	function getErrorArray() {
        return $this->_error_array;
    }
}