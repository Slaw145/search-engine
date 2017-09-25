<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sqlite_model extends CI_Model {

	public function get()
	{



			$q = $this->db->get( 'Process' ); 
			$q = $q->result();

		return $q;

	}
	public function szukajsqlite($maszyna=false, $dataod=false, $datado=false, $procod=false, $procdo=false, $procestype=false, $procesStatus=null, $errorId=null)
	{

	   $query=$this->db->select('Process.id, Process.date ,Process.note , Process.machine, Process.processStatus, Process.processType, Process.errorId, Process.processId, data.pliki, data.maszyna, data.daty')->from('Process')->join('data','Process.machine = data.maszyna AND CONCAT("LOG000", Process.processId, ".dat") = data.pliki OR CONCAT("LOG0000", Process.processId, ".dat") = data.pliki AND Process.date = data.daty','INNER');
	   
	    if ($maszyna != false) {
	       $query = $query->like('Process.machine', $maszyna);
	    } 
	    
	    if ($procdo != false) {
	        $query = $query->where('Process.processId <=', $procdo);
	    }
	 
	    if ($procod != false) {
	        $query = $query->where('Process.processId >=', $procod);
	    }
	 
	    if ($dataod != false) {
	        $query = $query->where('Process.date >=', $dataod);
	    }

	    if ($datado != false) {
	        $query = $query->where('Process.date <=', $datado);
	    }
	 
	    if ($procestype != false) {
	        $query = $query->where('Process.processType =', $procestype);
	    }
	 
	    if ($procesStatus != null) {
	        $query = $query->where('Process.processStatus =', $procesStatus);
	    }

	    if ($errorId != null) {
	        $query = $query->where('Process.errorId =', $errorId);
	    }
		
		$querys=$query->get()->result();

	   return $querys;

	}
	
}

/* End of file  */
/* Location: ./application/models/ */