<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Esoft_model extends CI_Model {
 
    // var $table = 'ARF01';
    var $db2 = '';
    // var $column_order = array('no_quotation','no_prospect','nm_customer',null); //set column field database for datatable orderable
    // var $column_search = array('no_quotation','no_prospect','nm_customer'); //set column field database for datatable searchable 
    // var $order = array('NAMA' => 'asc'); // default order 
 
    
    // public function __construct()
    // {
    //     parent::__construct();
       
    //     // Editor::inst( $db, 'db2.ARF01' );
        
    // }

    public function getCust()
	{
        $db2 = $this->load->database('db2', TRUE);  
        $db2->select('CUST,NAMA,PERSO,AL,NPWP,KLINK,VLT');
        $db2->from('ARF01');
        $data = $db2->get();
		// $q = $db2->get_where('ARF01',"NAMA like '%$query%'"); 
		// $result = $q->result_array();
        return $data;
		// var_dump($result);die;
	}

    Public function count_all(){
        return 1;
    }

    function count_filtered()
    {
    //     $this->_get_datatables_query();
    //     $query = $this->db->get();
    //     return $query->num_rows();
    return 1;
    }
 
    
    
}