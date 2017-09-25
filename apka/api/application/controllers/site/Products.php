<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();

		$post = file_get_contents( 'php://input' );
		$_POST = json_decode( $post , true );
		
		$this->load->model( 'site/Products_model' );	
	}

	public function get()
	{
		$output = $this->Products_model->get();
		echo json_encode( $output );
		
	}
	public function liczdatywszys()
	{
		$liczwyniki = $this->input->post('wyniki');
		$liczdateid1 = $this->input->post('daty1');
		$liczdateid2 = $this->input->post( 'daty2' );
		
		$output = $this->Products_model->liczdatywszys($liczwyniki, $liczdateid1 , $liczdateid2 );
		
		echo json_encode( $output );
	}
	public function test()
	{
		$output = $this->Products_model->test();
		echo json_encode( $output );
	}
	

}

/* End of file Products.php */
/* Location: ./application/controllers/Products.php */