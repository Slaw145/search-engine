<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_model extends CI_Model {


	
	public function get()
	{

			$q = $this->db->get( 'data' ); 
			$q = $q->result();
		return $q;

	}
	public function liczdatywszys($liczwyniki=false, $liczdateid1=false , $liczdateid2=false)
	{	

		 $assemblingWhereClause = $this->db;

	    if ($liczwyniki != false) {
	       $assemblingWhereClause = $assemblingWhereClause->like('maszyna', $liczwyniki);
	    } 
	    
	    if ($liczdateid1 != false) {
	        $assemblingWhereClause = $assemblingWhereClause->where('data.daty >=', $liczdateid1);
	    }
	 
	    if ($liczdateid2 != false) {
	        $assemblingWhereClause = $assemblingWhereClause->where('data.daty <=', $liczdateid2);
	    }

	    return $assemblingWhereClause->get( 'data' )->result();

		
		
	}
	public function liczwyniki($liczwyniki)
	{
		$this->db->empty_table('momdata'); 
		
		$this->db->like('maszyna', $liczwyniki);
		$qc = $this->db->get( 'data' );	
		$qc = $qc->result();
		
		foreach ($qc as $row)
		{
			$this->db->insert( 'momdata' , $row );
		}
		
		$this->db->get( 'momdata' );	
		$this->db->order_by("daty", "ASC");
		$dane=$this->db->get( 'momdata' );	
		$dane = $dane->result();
		return $dane;
	}
	public function test()
	{
		return $this->wszystkiedane;
	}

}

/* End of file  */
/* Location: ./application/models/ */