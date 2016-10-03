<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invite extends CI_Controller{

	function __construct(){
		parent::__construct();

		$this->load->model('invites');
    	$this->load->model('notifications');
    	$this->load->model('campaigns');
	}

	function index(){

		$data = array(
			'notifs' => $this->notifications->notifs(),
			'tracks_today' => $this->notifications->tracks_today(),
			'comments_today' => $this->notifications->comments_today(),
			'new_feedbacks' => $this->notifications->get_new_feedbacks(),
			'industry' => $this->invites->get_industry(),
			'location' => $this->invites->get_location(),
			'fields' => $this->campaigns->get_fields(),
			);
		$this->load->view('invites', $data);
	}

	function get_prospects_leads(){
		$data['p_leads'] = $this->invites->get_invites_leads();
		$this->load->view('ajax/prospects-leads',$data);
	}
}

/* TODO Add export option*/