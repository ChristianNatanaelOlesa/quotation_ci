<?php

class Role_model extends CI_Model
{
	private $_table = "t_user_access";
	private $_table_2 = "t_menu";

	const SESSION_KEY = 'user_id';
	
	public function getRoleMenu($id){
		$query = $this->db->get_where($this->_table, ['user_id' => $id]);
		// $query2 = $this->db->get_where($this->_table_2, ['active' => 1]);
		//  $data_access = $query->result();
		//  $data_menu = $query2->result();
		//  $user_access = array();
		//  foreach($data_menu as $rowmenu){
		// 	 foreach($data_access as $rowaccess){
		// 		$user_access[$rowmenu->id_menu] = $rowaccess->reads ;
		// 	 }
		// }
		// return $user_access;
		return $query->result();
		
	}
	public function getMenuActive(){
		$query = $this->db->get_where($this->_table_2, ['active' => 1]);		 
		return $query->result();
		
	}
}