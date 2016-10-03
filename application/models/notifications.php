<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications extends CI_Model{

	function get_upcoming_events(){
		$this->db->select('campaignname, cf_669');
		$this->db->where('date(cf_669) >', date('Y-m-d'));
		$this->db->join('vtiger_campaignscf','vtiger_campaign.campaignid=vtiger_campaignscf.campaignid','INNER');
		$query = $this->db->get('vtiger_campaign');

		return $query->result();
	}

	function get_new_leads(){
		$query = $this->db->query("SELECT company, concat(firstname,' ',lastname) as name FROM vtiger_crmentity INNER JOIN vtiger_leaddetails on (vtiger_crmentity.crmid=vtiger_leaddetails.leadid) WHERE WEEKOFYEAR(createdtime)=WEEKOFYEAR(NOW()) and YEAR(createdtime)=YEAR(now())");

		return $query->result();
	}

	function notifs(){
		$created_today = $this->db->query("select phone,company,concat(firstname,' ',lastname) as name,email, concat(vtiger_users.first_name,' ',vtiger_users.last_name) as assigned_to from vtiger_crmentity INNER JOIN vtiger_leaddetails on vtiger_leaddetails.leadid=vtiger_crmentity.crmid INNER JOIN vtiger_leadscf on vtiger_leaddetails.leadid = vtiger_leadscf.leadid LEFT JOIN vtiger_users ON vtiger_crmentity.smcreatorid = vtiger_users.id INNER JOIN vtiger_leadsubdetails ON vtiger_leadsubdetails.leadsubscriptionid = vtiger_leaddetails.leadid INNER JOIN vtiger_leadaddress ON vtiger_leadaddress.leadaddressid = vtiger_leadsubdetails.leadsubscriptionid where setype='leads' AND date(createdtime)=date(now()) ORDER BY `setype`");
		$leads_never_month = $this->db->query("select phone,company,concat(firstname,' ',lastname) as name,email, concat(vtiger_users.first_name,' ',vtiger_users.last_name) as assigned_to from vtiger_crmentity INNER JOIN vtiger_leaddetails on vtiger_leaddetails.leadid=vtiger_crmentity.crmid INNER JOIN vtiger_leadscf on vtiger_leaddetails.leadid = vtiger_leadscf.leadid LEFT JOIN vtiger_users ON vtiger_crmentity.smcreatorid = vtiger_users.id INNER JOIN vtiger_leadsubdetails ON vtiger_leadsubdetails.leadsubscriptionid = vtiger_leaddetails.leadid INNER JOIN vtiger_leadaddress ON vtiger_leadaddress.leadaddressid = vtiger_leadsubdetails.leadsubscriptionid where setype='leads' AND date(createdtime) = date(modifiedtime) AND month(modifiedtime) = month(now())-1 AND day(modifiedtime) = day(now()) ORDER BY `setype`");
		$leads_outdated_month = $this->db->query("select phone,company,concat(firstname,' ',lastname) as name,email, concat(vtiger_users.first_name,' ',vtiger_users.last_name) as assigned_to from vtiger_crmentity INNER JOIN vtiger_leaddetails on vtiger_leaddetails.leadid=vtiger_crmentity.crmid INNER JOIN vtiger_leadscf on vtiger_leaddetails.leadid = vtiger_leadscf.leadid LEFT JOIN vtiger_users ON vtiger_crmentity.smcreatorid = vtiger_users.id INNER JOIN vtiger_leadsubdetails ON vtiger_leadsubdetails.leadsubscriptionid = vtiger_leaddetails.leadid INNER JOIN vtiger_leadaddress ON vtiger_leadaddress.leadaddressid = vtiger_leadsubdetails.leadsubscriptionid where setype='leads' AND YEAR(modifiedtime) = YEAR(now()) AND month(modifiedtime) = month(now())-1 AND day(modifiedtime) = day(now()) ORDER BY `setype`");
	
		return $data = array('leads_today' => $created_today,
							 'never_updated' => $leads_never_month,
							 'outdated_month' => $leads_outdated_month
			);
	}

	function get_new_feedbacks(){
		return $this->db->query("Select id, name, feedback, created_time from vtiger_feedback INNER JOIN vtiger_dashboard_users on (vtiger_feedback.written_by = vtiger_dashboard_users.userid) where seen = 0");
	}

	function get_feedbacks(){
		$query = $this->db->query("Select id, name, feedback, created_time, seen from vtiger_feedback INNER JOIN vtiger_dashboard_users on (vtiger_feedback.written_by = vtiger_dashboard_users.userid) ORDER BY id DESC");
		return $query->result();
	}

	function tracks_today(){
		return $this->db->query("SELECT vtiger_modtracker_basic.crmid, CONCAT( first_name, ' ', last_name ) AS user, prevalue, postvalue, fieldname, changedon, label, setype, createdtime, vtiger_modtracker_basic.status FROM vtiger_modtracker_basic INNER JOIN vtiger_modtracker_detail ON vtiger_modtracker_basic.id = vtiger_modtracker_detail.id INNER JOIN vtiger_crmentity ON vtiger_modtracker_basic.crmid = vtiger_crmentity.crmid INNER JOIN vtiger_users ON vtiger_users.id = vtiger_modtracker_basic.whodid WHERE vtiger_modtracker_basic.status !=2 AND date(changedon) = date(now())")->num_rows();
	}

	function comments_today(){
		return $this->db->query("Select m.setype as module,commentcontent as comment, m.label as related_to, CONCAT(first_name,' ',last_name) as user, c.createdtime as createdtime from vtiger_modcomments INNER JOIN vtiger_crmentity as m on vtiger_modcomments.related_to = m.crmid INNER JOIN vtiger_crmentity as c on vtiger_modcomments.modcommentsid = c.crmid INNER JOIN vtiger_users on vtiger_modcomments.userid=vtiger_users.id where date(c.createdtime)=date(now())")->num_rows();
	}


}