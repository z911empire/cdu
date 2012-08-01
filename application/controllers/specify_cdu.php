<?php

class Specify_cdu extends CI_Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('dbhost','DB Server Host','required');
		$this->form_validation->set_rules('dbport','DB Server Port','required');
		$this->form_validation->set_rules('dbuser','DB Username','required');
		$this->form_validation->set_rules('dbpass','DB Password','required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('select_external_cdu');
		}
		else
		{
			$this->load->view('formsuccess');
		}
	}
}
?>