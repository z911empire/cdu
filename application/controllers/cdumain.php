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
		#$this->form_validation->set_rules('dbport','DB Port','required|numeric');
		$this->form_validation->set_rules('dbuser','DB Username','required');
		$this->form_validation->set_rules('dbpass','DB Password','required');	

		if ($this->form_validation->run() == FALSE) {
			# http://darrenonthe.net/2011/05/10/get-codeigniter-form-validation-errors-as-an-array/
			echo json_encode($this->form_validation->getErrorArray());
		} else {
			$dbhost = ($this->input->post('dbport')) ? $this->input->post('dbhost').":".$this->input->post('dbport')	: $this->input->post('dbhost');
			$dbuser = $this->input->post('dbuser');
			$dbpass = $this->input->post('dbpass');
			
			# use the '@' to suppress error messages from the function 
			$userdbserver = @mysql_connect($dbhost, $dbuser, $dbpass);			
			
			if (!$userdbserver) {
				# error_log("Couldn't connect to db server: ".mysql_error(),0);
				echo json_encode(array('nonValidationError'=>'Could not establish connection with DB.'));
			} else {
				echo json_encode(array('nextControl'=>'populateSelectDB',
									   'nextSection'=>'specify',
									   'resubmit'=>'attemptDBConnection'));
				if (!mysql_close($userdbserver)) { error_log("Could not close DB connection!",0); }
			}
		}
	}
	
	private function _connectUserDB() {
		$dbhost = ($this->input->post('dbport')) ? $this->input->post('dbhost').":".$this->input->post('dbport')	: $this->input->post('dbhost');
		$dbuser = $this->input->post('dbuser');
		$dbpass = $this->input->post('dbpass');
		
		$dbConfig['hostname'] = $dbhost;
		$dbConfig['username'] = $dbuser;
		$dbConfig['password'] = $dbpass;
		$dbConfig['database'] = "information_schema";
		$dbConfig['dbdriver'] = "mysql";
		$dbConfig['dbprefix'] = "";
		$dbConfig['pconnect'] = FALSE;
		$dbConfig['db_debug'] = TRUE;
		$dbConfig['cache_on'] = FALSE;
		$dbConfig['cachedir'] = "";
		$dbConfig['char_set'] = "utf8";
		$dbConfig['dbcollat'] = "utf8_general_ci";
		
		$uDB = $this->load->database($dbConfig, TRUE);
		
		if (!$uDB) { error_log("Could not connect to valid database.",0); }	
		else { return $uDB; }
	}
	
	public function populateSelectDB() {
		$uDB = $this->_connectUserDB();
		
		$query = $uDB->query('SELECT DISTINCT TABLE_SCHEMA FROM TABLES;');

		$response=array();
		foreach ($query->result_array() as $row) {
		   	array_push($response, $row['TABLE_SCHEMA']);
		}
		echo json_encode($response);
		#if (!$uDB->close()) { error_log("Could not close DB connection dbselect!",0); }
	}
	
	public function populateSelectTable() {
		$uDB = $this->_connectUserDB();
		
		$query = $uDB->query("SELECT TABLE_NAME FROM TABLES WHERE TABLE_SCHEMA='".$this->input->post('dbselect')."' ORDER BY TABLE_NAME;");

		$response=array();
		foreach ($query->result_array() as $row) {
		   	array_push($response, $row['TABLE_NAME']);
		}
		echo json_encode($response);
		#if (!$uDB->close()) { error_log("Could not close DB connection tableselect!",0); }
	}
	
	public function populateSelectColumn() {
		$uDB = $this->_connectUserDB();
		
		$query = $uDB->query("SELECT COLUMN_NAME, CASE COLUMN_KEY WHEN 'PRI' THEN 1 WHEN 'UNI' THEN 2 ELSE 3 END AS colkey FROM COLUMNS WHERE TABLE_SCHEMA='".$this->input->post('dbselect')."' AND TABLE_NAME='".$this->input->post('tableselect')."' ORDER BY colkey, COLUMN_NAME;");
		$response=array();
		foreach ($query->result_array() as $row) {
		   	array_push($response, array("name"=>$row['COLUMN_NAME'],"key"=>$row['colkey']));
		}
		echo json_encode($response);
		#if (!$uDB->close()) { error_log("Could not close DB connection columnselect!",0); }
	}
}

?>