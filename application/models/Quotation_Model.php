<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Quotation_Model extends CI_Model {
 
    var $table = 'quotation_h';
    var $tableD = 'quotation_d';
    var $column_order = array('no_quotation','no_prospect','nm_customer',null); //set column field database for datatable orderable
    var $column_search = array('no_quotation','no_prospect','nm_customer'); //set column field database for datatable searchable 
    var $order = array('chstatus' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
        $this->db->where('kd_sales',$_SESSION['kd_user']); 
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    private function _get_datatables_query_byID($param)
    {
         
        $this->db->from($this->tableD);
        $this->db->where('acak',$param);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
    }
    private function _get_datatables_query_byApproval()
    {
         
        $this->db->from($this->table);
        $this->db->where('chstatus',1);
        $this->db->where('nama_approval',$_SESSION["nama"]);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function get_datatables_byID($param)
    {
        $this->_get_datatables_query_byID($param);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function get_datatables_byApproval()
    {
        $this->_get_datatables_query_byApproval();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_filtered_byID($param)
    {
        $this->_get_datatables_query_byID($param);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_filtered_byApproval($param)
    {
        $this->_get_datatables_query_byApproval($param);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function count_all_byID($param)
    {
        $this->db->from($this->table);
        $this->db->where('acak',$param);
        return $this->db->count_all_results();
    }
    public function count_all_byApproval($param)
    {
        $this->db->from($this->table);
        $this->db->where('nama_approval',$_SESSION["manager"]);
        return $this->db->count_all_results();
    }


    function saverecords($data)
	{
        $result = $this->db->insert($this->tableD,$data);
        if($result){
            return true;
        }
        else{
            return false;
        }
	}
    function saverecords_H($data)
	{
        $result = $this->db->insert($this->table,$data);
        if($result){
            return true;
        }
        else{
            return false;
        }
	}
    function updaterecords($data)
	{
            $this->db->where('acak', $data['acak']);
            $this->db->where('no_pracost', $data['no_pracost']);
            $result = $this->db->update($this->tableD, $data);

        if($result){
            return true;
        }
        else{
            return false;
        }
	}
    function updaterecords_H($data)
	{
            $this->db->where('acak', $data['acak']);
            $result = $this->db->update($this->table, $data);

        if($result){
            return true;
        }
        else{
            return false;
        }
	}


    public function get_Revisi($param){
        $this->db->select('revisi_ke');
        $this->db->from($this->table);
        $this->db->where('acak', $param);
        $query = $this->db->get();
        return $query->row();
    }


    public function getInfoQuotation($param){
        
        $this->db->select('*,top_h.deskripsi');
        $this->db->from($this->table);
        $this->db->join($this->tableD, $this->tableD.'.acak = '.$this->table.'.acak');
        $this->db->join('top_h', $this->table.'.top_code = top_h.top_cd', 'left');
        $this->db->where($this->tableD.'.acak', $param);
        $query = $this->db->get();
        return $query->row();
    }

    public function getDetailQuotation($param){
        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->tableD, $this->tableD.'.acak = '.$this->table.'.acak');
        $this->db->where($this->tableD.'.acak', $param);
        $query = $this->db->get();
        return $query->result();
    }

    
    function getSummaryQuoMonthly(){

        $this->db->select('SUM(hargajual) as totalQ');
        $this->db->from($this->table);
        $this->db->where('kd_sales',$_SESSION['kd_user']); 
        $this->db->where('MONTH(tgl_quotation) = ',date('m')); 
        $this->db->where('YEAR(tgl_quotation) = ',date('Y')); 
        $this->db->group_by('kd_sales');
        $query = $this->db->get();
        return $query->row();
    }
    function getReasonbyID($param){

        $this->db->select('komunikasi');
        $this->db->from($this->table);
        $this->db->where('acak ',$param); 
        $query = $this->db->get();
        return $query->row();
    }

    function updateStatus($data){
        $this->db->where('acak', $data['acak']);
        $result = $this->db->update($this->table, $data);

        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    
    
}