<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('notifications');
		$this->load->model('overview');
	}

	function get_tweets() {
	 	
		$url = 'https://twitter.com/yourCIMT';

	    $json_string = file_get_contents('http://urls.api.twitter.com/1/urls/count.json?url=' . $url);
	    $json = json_decode($json_string, true);
	 
	    return intval( $json['count'] );
	}
 
	function get_likes() {

		$info = json_decode(file_get_contents('https://graph.facebook.com/CIMTechnologiesInc.ph'));
		return $info->likes;
	}

	function get_subscriber(){

		$data = file_get_contents('http://gdata.youtube.com/feeds/api/users/UC-nsb2Vi_isG1UsWAt1qZEg?alt=json');
		$data = json_decode($data, true);
		$stats_data = $data['entry']['yt$statistics'];

		return $stats_data['subscriberCount'];
	}

	function index()
	{
		$dashboards = $this->overview->get_numbers();

		$data = array(
			'tracks_today' => $this->notifications->tracks_today(),
			'comments_today' => $this->notifications->comments_today(),
			'tweets' => '1M'//$this->get_tweets(),
			,'likes' => '2M' //$this->get_likes()
			,'subs' => '13K'//$this->get_subscriber(),
			,'upcoming_events' => $this->notifications->get_upcoming_events(),
			'leads_this_week' => $this->notifications->get_new_leads(),
			'campaign_leads' => $dashboards['campaign_leads']->num_rows(),
			'campaign_accounts' => $dashboards['campaign_accounts']->num_rows(),
			'campaign_contacts' => $dashboards['campaign_contacts']->num_rows(),
			'campaign_opportunities' => $dashboards['campaign_opportunities']->num_rows(),
			
			//numbers for the widget
			'notifs' => $this->notifications->notifs(),
			'new_feedbacks' => $this->notifications->get_new_feedbacks(),

			//donut chart
			'active_leads' => $dashboards['active_leads']->num_rows(),
			'inactive' => $dashboards['inactive']->num_rows(),
			'never_updated' => $dashboards['never_updated']->num_rows(),

			//campaign leads
			'unassigned' => $dashboards['unassigned']->num_rows(),
			'assigned' => $dashboards['assigned']->num_rows(),
			'c_active' => $dashboards['c_active']->num_rows(),
			'c_inactive' => $dashboards['c_inactive']->num_rows(),
			'c_never_updated' => $dashboards['c_never_updated']->num_rows(),
			'by_industry' => $dashboards['by_industry'],
			'by_rating' => $dashboards['by_rating'],

			//campaign accounts
			'new_this_year' => $dashboards['new_this_year']->num_rows(),
			'warm_accounts' => $dashboards['warm_accounts']->num_rows(),
			'cold_accounts' => $dashboards['cold_accounts']->num_rows(),
			'assigned_accounts' => $dashboards['assigned_accounts']->num_rows(),
			'unassigned_accounts' => $dashboards['unassigned_accounts']->num_rows(),

			//campaign contacts
			'contact_this_year' => $dashboards['contact_this_year']->num_rows(),

			//campaign opportunities
			'opportunities_by_stage' => $dashboards['opportunities_by_stage']->result(),

			'top_active' => $dashboards['top_active'],
			);
		$this->load->view('home',$data);
	}

	function get_feedbacks(){
		$data['feedbacks'] = $this->notifications->get_feedbacks();

		$update = array('seen'=>1);
		$this->db->update('vtiger_feedback',$update);

		$this->load->view('ajax/feedback',$data);
	}

	function load_ajax_chart(){

		$data = $this->overview->get_overall_chart($this->input->post('duration'));

		$this->load->view('ajax/ajax-chart', $data);
	}

	function load_unassigned_leads(){
		$leads = $this->overview->get_numbers();

		$data['leads'] = $leads['unassigned']->result();

		$this->load->view('ajax/leads',$data);
	}

	function load_assigned_leads(){
		$leads = $this->overview->get_numbers();

		$data['leads'] = $leads['assigned']->result();

		$this->load->view('ajax/leads',$data);
	}

	function load_hot_leads(){
		$leads = $this->overview->get_numbers();

		$data['leads'] = $leads['c_active']->result();

		$this->load->view('ajax/leads',$data);
	}

	function load_cold_leads(){
		$leads = $this->overview->get_numbers();

		$data['leads'] = $leads['c_inactive']->result();

		$this->load->view('ajax/leads',$data);
	}

	function load_never_updated_leads(){
		$leads = $this->overview->get_numbers();

		$data['leads'] = $leads['c_never_updated']->result();

		$this->load->view('ajax/leads',$data);
	}

	function load_this_year_accounts(){
		$leads = $this->overview->get_numbers();

		$data['accounts'] = $leads['new_this_year']->result();

		$this->load->view('ajax/accounts',$data);
	}

	function load_warm_accounts(){
		$leads = $this->overview->get_numbers();

		$data['accounts'] = $leads['warm_accounts']->result();

		$this->load->view('ajax/accounts',$data);
	}

	function load_cold_accounts(){
		$leads = $this->overview->get_numbers();

		$data['accounts'] = $leads['cold_accounts']->result();

		$this->load->view('ajax/accounts',$data);
	}

	function load_unassigned_accounts(){
		$leads = $this->overview->get_numbers();

		$data['accounts'] = $leads['unassigned_accounts']->result();

		$this->load->view('ajax/accounts',$data);
	}

	function load_assigned_accounts(){
		$leads = $this->overview->get_numbers();

		$data['accounts'] = $leads['assigned_accounts']->result();

		$this->load->view('ajax/accounts',$data);
	}

	function load_leads_today(){
		$leads = $this->notifications->notifs();

		$data['leads'] = $leads['leads_today']->result();

		$this->load->view('ajax/leads',$data);
	}

	function load_inactive_month(){
		$leads = $this->notifications->notifs();

		$data['leads'] = $leads['outdated_month']->result();

		$this->load->view('ajax/leads',$data);
	}

	function load_never_month(){
		$leads = $this->notifications->notifs();

		$data['leads'] = $leads['never_updated']->result();

		$this->load->view('ajax/leads',$data);
	}

}