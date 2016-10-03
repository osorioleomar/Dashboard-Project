<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('users');
		$this->load->model('notifications');
	}

	function index(){

		$data = array(
			'notifs' => $this->notifications->notifs(),
			'tracks_today' => $this->notifications->tracks_today(),
			'new_feedbacks' => $this->notifications->get_new_feedbacks(),
			'users' => $this->users->get_users(),
			//numbers for the widget
			'leads_today' => $this->db->query("select * from vtiger_crmentity where setype='leads' AND date(createdtime)=date(now())")->num_rows(),
			'never_updated_month' => $this->db->query("select * from vtiger_crmentity where setype='leads' AND date(createdtime) = date(modifiedtime) AND month(modifiedtime) = month(now())-1 AND day(modifiedtime) = day(now())")->num_rows(),
			'outdated_month' => $this->db->query("select * from vtiger_crmentity where setype='leads' AND YEAR(modifiedtime) = YEAR(now()) AND month(modifiedtime) = month(now())-1 AND day(modifiedtime) = day(now())")->num_rows()
			);

		$this->load->view('new_user',$data);
	}

	function add(){
		$data = array(
			'username' => $this->input->post('username1'),
			'password' => sha1('p@ssw0rd'),
			'name' => $this->input->post('name1'),
			'user_type' => $this->input->post('usertype1'),
			'email' => $this->input->post('email1'),
			'active' => 1,	
			);

		$this->db->insert('vtiger_dashboard_users',$data);
	}

	function update_user(){

		$data = array(
			'name' => $this->input->post('name1'),
			'email' => $this->input->post('email1'),
			'password' => sha1($this->input->post('password1'))
			);

		$this->db->where('userid',$this->session->userdata('userid'));
		$this->db->update('vtiger_dashboard_users',$data);
	}

}