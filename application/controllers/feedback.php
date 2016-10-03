<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller{

	function save_feedback(){

		$data = array(
			'feedback' => $this->input->post('user_feedback'),
			'written_by' => $this->session->userdata('userid'),
			'created_time' => date('Y-m-d H:i:s')
			);

		$this->db->insert('vtiger_feedback',$data);
	}

}