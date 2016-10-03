<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
	TODO Filter campaign-related comments
*/

class Comments extends CI_Controller{

	function __construct(){
		parent::__construct();

		$this->load->model('comment');
		$this->load->model('notifications');
	}

	function index(){
		$data = array(		
			'notifs' => $this->notifications->notifs(),
			'tracks_today' => $this->notifications->tracks_today(),
			'new_feedbacks' => $this->notifications->get_new_feedbacks(),
			'comments' => $this->comment->get_comments(),
			'comments_today' => $this->notifications->comments_today(),
			);

		$this->load->view('comments',$data);
	}

	function get_comments(){
		$data = array(		
			'comments' => $this->comment->get_comments()
			);

		$this->load->view('ajax/comments',$data);
	}

	function comments_filtered(){
		$campaign = $this->input->post('campaign');
		$module = $this->input->post('module');
		$fieldname = $this->input->post('fieldname');
		$keyword = $this->input->post('keyword');
		$startdate = date('Y-m-d',strtotime($this->input->post('startdate')));
		$enddate = date('Y-m-d',strtotime($this->input->post('enddate')));

		$data = array(
			'comments' => $this->comment->get_comments_filtered($campaign,$module,$fieldname,$keyword,$startdate,$enddate)
		);
		$this->load->view('ajax/comments',$data);
	}
}