<?php
class m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_last()
    {
        
        $query = $this->db->query("SELECT [description]  from t_status");        
        $getarray=[];
        

        foreach ($query->result_array() as $rows) 
        {
            $getarray[]=$rows['description'];
        }         
        return $getarray;              
    }

}


?>