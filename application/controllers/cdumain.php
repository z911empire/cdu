<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cdumain extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/cdumain
	 *	- or -  
	 * 		http://example.com/index.php/cdumain/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/cdumain/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('dbhost','DB Server Host','required');
		$this->form_validation->set_rules('dbport','DB Server Port','required');
		$this->form_validation->set_rules('dbuser','DB Username','required');
		$this->form_validation->set_rules('dbpass','DB Password','required');
		
		# want to do this with AJAX off the bat:
		# http://jeremiahgatong.blogspot.com/2012/04/codeigniters-form-validation-w-jquery.html
		
		$this->load->view('header');
		$this->load->view('cduapp');
		$this->load->view('footer');
	}
}