<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model{

	function get_users(){
		$this->db->select('userid, username, name, last_login, user_type, email');
		$this->db->where('active', 1);
		$result = $this->db->get('vtiger_dashboard_users')->result();

		return $result;
	}

	function login($username,$password){
		$user = array('username' => $username, 'password' => sha1($password), 'active' => 1);

		$this->db->select();
		$this->db->where($user);
		$this->db->limit(1);
		$query = $this->db->get('vtiger_dashboard_users');

		if($query->num_rows()==1){
            foreach ($query->result() as $row){
                $data = array(
                			'userid' => $row->userid,
                			'user_type' => $row->user_type,
                            'username'=> $row->username,
                            'name'=> $row->name,
                            'photo' => $row->photo,
                            'email' => $row->email,
                            'logged_in'=>TRUE
                        );
            };
            $this->last_login($data['userid']);
            $this->session->set_userdata($data);
            return TRUE;
        }
        else{
            return FALSE;
      	}    
	}

	function last_login($userid){
		$data = array('last_login' => date('Y-m-d H:m:s'));

		$this->db->where('userid',$userid);
		$this->db->update('vtiger_dashboard_users',$data);
	}

}