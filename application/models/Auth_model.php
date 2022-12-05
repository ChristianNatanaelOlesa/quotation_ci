<?php

class Auth_model extends CI_Model
{
	private $_table = "login";
	const SESSION_KEY = 'kd_user';
	const SESSION_NAMA = 'nama';
	const SESSION_MGR = 'manager';
	const SESSION_DPT = 'bagian';
	const SESSION_JBT = 'jabatan';
	const SESSION_LVL = 'level';
	// const SESSION_NAMA = 'nama';
	// const SESSION_KEY = 'username';
	// const SESSION_KEY = 'nama';
	// const SESSION_KEY = 'manager';

	public function rules()
	{
		return [
			[
				'field' => 'username',
				'label' => 'Username or Email',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|max_length[255]'
			]
		];
	}

	public function login($username, $password)
	{
		$this->db->where('username', $username);
		$query = $this->db->get($this->_table);
		$user = $query->row();

		if (!$user) {
			return FALSE;
		}

		if (!password_verify($password, $user->password)) {
			return FALSE;
		}
		// 
		$this->session->set_userdata([
			self::SESSION_KEY => $user->kd_user,
			self::SESSION_NAMA => $user->nama,
			self::SESSION_MGR => $user->Manager,
			self::SESSION_DPT => $user->bagian,
			self::SESSION_JBT => $user->jabatan,
			self::SESSION_LVL => $user->level,
		]);
		

		// var_dump($this->session);die;

		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}


		$user_id = $this->session->userdata(self::SESSION_KEY);
		$query = $this->db->get_where($this->_table, ['kd_user' => $user_id]);
		return $query->row();
	}

	public function logout()
	{
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}


	
}