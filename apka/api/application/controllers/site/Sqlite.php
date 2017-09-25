<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sqlite extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$post = file_get_contents( 'php://input' );
		$_POST = json_decode( $post , true );

		$this->load->model( 'site/Sqlite_model' );	

	}

	public function get()
	{
		$output = $this->Sqlite_model->get();
		echo json_encode( $output );
		
	}
	public function szukajsqlite()
	{
		$maszyna = $this->input->post('maszyna');
		$dataod = $this->input->post('dataod');
		$datado = $this->input->post('datado');
		$procod = $this->input->post('procod');
		$procdo = $this->input->post('procdo');
		$procestype = $this->input->post('procestype');
		$procesStatus = $this->input->post('procesStatus');
		$errorId = $this->input->post('errorId');
		
		$output = $this->Sqlite_model->szukajsqlite($maszyna, $dataod, $datado, $procod, $procdo, $procestype, $procesStatus, $errorId);
		echo json_encode( $output );
		
	}


}

/* End of file Products.php */
/* Location: ./application/controllers/Products.php */