<?php

class Utility_Model extends CI_Model
{
    var $table = 'general_setting';

	public function rupiah($angka){
	
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
     
    }

    public function getDataGenset(){
        
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->row();
    }	

    function append_notif($data)
	{
        $result = $this->db->insert('notify',$data);
        if($result){
            return true;
        }
        else{
            return false;
        }
	}
    function getNotif_count($param)
	{
            $this->db->from('notify');
            $this->db->where('kd_user',$param);
            $this->db->where('read_notif',0);
            $this->db->order_by('id','ASC');
            return $this->db->count_all_results();
	}
    function getNotif($param)
	{
            $this->db->select('notify.*,quotation_h.no_quotation');
            $this->db->from('notify');
            $this->db->join('quotation_h','notify.acak=quotation_h.acak', 'left');
            $this->db->where('notify.kd_user',$param);
            $this->db->where('notify.read_notif',0);
            $query = $this->db->get();
            return $query->result();
	}

    function getHead($param){
        $this->db->from('notify');
        $this->db->where('kd_user',$param);
        return $this->db->count_all_results();
    }
}