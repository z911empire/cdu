<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cdumain extends CI_Controller {

	public function __construct() { 
		parent::__construct();
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
	}

	public function index() {
		# want to do this with AJAX off the bat:
		# http://jeremiahgatong.blogspot.com/2012/04/codeigniters-form-validation-w-jquery.html
		$this->load->view('header');
		$this->load->view('cduapp');
		$this->load->view('footer');
	}
	
	public function attemptDBConnection() {
		$this->form_validation->set_rules('dbhost','DB Host','required');
		$this->form_validation->set_rules('dbport','DB Port','required|numeric');
		$this->form_validation->set_rules('dbuser','DB Username','required');
		$this->form_validation->set_rules('dbpass','DB Password','required');	

		if ($this->form_validation->run() == FALSE) {
			# http://darrenonthe.net/2011/05/10/get-codeigniter-form-validation-errors-as-an-array/
			echo json_encode($this->form_validation->getErrorArray());
		} else {
			# what about the port!?
			# use the '@' to suppress error messages from the function 
			$userdbserver = @mysql_connect($this->input->post('dbhost'), 
				$this->input->post('dbuser'), $this->input->post('dbpass'));			
			if (!$userdbserver) {
				#error_log("Couldn't connect to db server: ".mysql_error(),0);
				echo json_encode(array('nonValidationError'=>'Could not establish connection with DB.'));
			} else {
				echo json_encode(array('nextControl'=>'populateSelectDB',
									   'nextSection'=>'specify',
									   'resubmit'=>'attemptDBConnection'));
			}
		}
	}
	
	public function populateSelectDB() {
		echo "GREAT SUCCESS!";
	}
}

?>