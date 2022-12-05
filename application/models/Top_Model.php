<?php

class Top_Model extends CI_Model
{
    var $table = 'top_h';
    var $tableD = 'top_d';

	public function getTop(){
        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('aktif', 1);
        $query = $this->db->get();
        return $query->result();
    }	
	public function getTopDetail($param){
        
        $this->db->select('*');
        $this->db->from($this->tableD);
        $this->db->where('top_cd', $param);
        $query = $this->db->get();
        return $query->result();
    }	

    public function getDetailSch($param){
        $this->db->select($this->tableD.'.*');
        $this->db->from($this->tableD);
        $this->db->join($this->table,$this->tableD.'.top_cd='.$this->table.'.top_cd');
        $this->db->where($this->tableD.'.top_cd',$param);
        $query = $this->db->get();
        return $query->result();
    }

    
    // public function generate_sch($param1,$param2){

    //     $list = $this->getTopDetail($param2);

    //     foreach($list as $row){
    //         $data = array(
    //             'acak' => $param1,
    //             'top_code' => $row->top_cd,
    //             'tgl_tagihan' => date(),
    //             'prs' => $row->prs_top,
    //             'jarak' => $row->jarak,
    //             'jarak' => date(),

    //         );
            
    //         // $this->db->insert('mytable', $data);

    //     }

    //     return $data;
    // }

}