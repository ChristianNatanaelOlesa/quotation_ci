<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Pracost_Model extends CI_Model {
 
    var $table = 'pracost';
    var $column_order = array('nopracost','noprospect','kd_sales','tgl_prospect','tgl_pracost', 'harga_pracost','harga_awal','harga_dasar',null); //set column field database for datatable orderable
    var $column_search = array('noprospect','nopracost','nm_customer','nm_proyek','tgl_prospect','tgl_pracost'); //set column field database for datatable searchable 
    var $order = array('tgl_pracost' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $this->db->where('status < ', 12); 
        $this->db->where('kd_sales',$_SESSION['kd_user']); 
        $this->db->where('YEAR(tgl_pracost)',date("Y")); 


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
    private function _get_datatables_query_byID($noprospect)
    {
        $this->db->from($this->table);
        $this->db->where('noprospect',$noprospect); 

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
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function get_datatables_byID($noprospect)
    {
        $this->_get_datatables_query_byID($noprospect);
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
    function count_filtered_byID($noprospect)
    {
        $this->_get_datatables_query_byID($noprospect);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function count_all_byID($noprospect)
    {
        $this->db->from($this->table);
        $this->db->where('noprospect',$noprospect); 
        return $this->db->count_all_results();
    }

    public function getInfoProspectus($param){
        
        $this->db->select('noprospect,nm_customer,nm_proyek');
        $this->db->from($this->table);
        $this->db->where('noprospect', $param);
        $this->db->group_by('noprospect,nm_customer,nm_proyek'); 
        $query = $this->db->get();
        return $query->row();
    }
    public function getHargaDasar($param){
        
        $this->db->select('harga_dasar');
        $this->db->from($this->table);
        $this->db->where('nopracost', $param);
        $this->db->where('status', 11);
        $query = $this->db->get();
        return $query->row();
    }

    function UpdateProspect($param)
	{
        $this->db->set('status',12);
        $this->db->where('noprospect', $param);
        $result = $this->db->update($this->table);

        if($result){
            return true;
        }
        else{
            return false;
        }
	}

    function getSummarydata(){
        $this->db->from($this->table);
        $this->db->where('status',11); 
        $this->db->where('kd_sales',$_SESSION['kd_user']); 
        return $this->db->count_all_results();
    }    
 
}