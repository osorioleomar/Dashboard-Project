<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
	TODO Filter Campaign-related contents
*/


class Updates extends CI_Controller{

	function __construct(){
		parent::__construct();

		$this->load->model('update');
		$this->load->model('notifications');
	}

	function index(){		
		$data = array(	
			'notifs' => $this->notifications->notifs(),
			'tracks_today' => $this->update->tracks_today(),
			'comments_today' => $this->notifications->comments_today(),
			'new_feedbacks' => $this->notifications->get_new_feedbacks(),
		);

		$this->load->view('updates',$data);
	}

	function tracks(){
		$data = array(
			'updates' => $this->update->get_tracks(),
			'users' => $this->update->get_users(),
			'fields' => $this->update->get_fields(),		
			'notifs' => $this->notifications->notifs(),
			'new_feedbacks' => $this->notifications->get_new_feedbacks(),
		);

		$this->load->view('ajax/tracks',$data);
	}

	function tracks_filtered(){

		$campaign = $this->input->post('campaign');
		$module = $this->input->post('module');
		$fieldname = $this->input->post('fieldname');
		$keyword = $this->input->post('keyword');
		$startdate = date('Y-m-d',strtotime($this->input->post('startdate')));
		$enddate = date('Y-m-d',strtotime($this->input->post('enddate')));

		$data = array(
			'users' => $this->update->get_users(),
			'fields' => $this->update->get_fields(),
			'updates' => $this->update->get_tracks_filtered($campaign,$module,$fieldname,$keyword,$startdate,$enddate)
		);
		$this->load->view('ajax/tracks',$data);
	}
}