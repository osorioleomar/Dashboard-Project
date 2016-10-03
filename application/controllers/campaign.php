<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign extends CI_Controller{

	function __construct(){
		parent::__construct();

		$this->load->model('campaigns');
		$this->load->model('notifications');
		$this->load->model('invites');
	}

	function index(){
		$data = array(
			'notifs' => $this->notifications->notifs(),
			'tracks_today' => $this->notifications->tracks_today(),
			'comments_today' => $this->notifications->comments_today(),
			'new_feedbacks' => $this->notifications->get_new_feedbacks(),
			'campaigns' => $this->campaigns->get_campaigns(),
			);
		$this->load->view('campaign',$data);
	}

	function campaign_detail($campaignid){
		$data = array(
			'campaignid' => $campaignid,
			'notifs' => $this->notifications->notifs(),
			'tracks_today' => $this->notifications->tracks_today(),
			'comments_today' => $this->notifications->comments_today(),
			'new_feedbacks' => $this->notifications->get_new_feedbacks(),
			'industry' => $this->invites->get_industry(),
			'location' => $this->invites->get_location(),
			'campaigns' => $this->campaigns->get_campaign_details($campaignid),
			'numbers' => $this->campaigns->get_related($campaignid),
			'fields' => $this->campaigns->get_fields(),
		);

		$this->session->set_userdata('campaignid',$campaignid);
		$this->load->view('campaign_detail',$data);
	}
/*
leads: company, name, designation, phone, email, address, market segment, subsegment
account: accountname, phone, email, bill_street, bill_city, cf_754 industry, cf_756 subsegment
contact: concat(firstname,' ',lastname) as name, email, phone, mobile, title, cf_762 as market segment, cf_764 as subsegment, mailingstreet, mailingcity
*/
	function filter_result(){

		$module = $this->input->post('module');
		$industry = $this->input->post('industry');
		$location = $this->input->post('location');
		$fieldnames = $this->input->post('fieldname');
		$conditions = $this->input->post('condition');
		$values = $this->input->post('value');
		$andors = $this->input->post('andor');

		switch($module){
			case "leads":
				$data['leads'] = $this->invites->get_filtered_leads($industry, $location, $fieldnames, $conditions, $values, $andors);
				$this->load->view("ajax/invites-leads",$data);break;
			case "contacts":
				$data['contacts'] = $this->invites->get_filtered_contacts($industry, $location, $fieldnames, $conditions, $values, $andors);
				$this->load->view("ajax/invites-contacts",$data);break;
			case "accounts":
				$data['accounts'] = $this->invites->get_filtered_accounts($industry, $location, $fieldnames, $conditions, $values, $andors);
				$this->load->view("ajax/invites-accounts",$data);break;
		}
		//echo $this->db->last_query();
	}

	function get_leads(){
		$data = array(
			'leads' => $this->invites->get_leads()
			);

		$this->load->view('ajax/invites-leads',$data);
	}

	function save_prospects(){
		$campaignid = $this->input->post('campaignid');
		$crmid = $this->input->post('crmid');
		$module = $this->input->post('modulename');

		foreach ($crmid as $save) {
			$data[] = array(
					'campaignid' => $campaignid,
					'module' => $module,
					'crmid' => $save
					);
		};

		$this->db->insert_batch('vtiger_invites',$data);
	}
}