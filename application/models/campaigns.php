<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaigns extends CI_Model{

	function get_campaigns(){


		$data = array(
			'upcoming' => $this->db->query("SELECT vtiger_campaign.campaignid, campaignname, concat(first_name,' ',last_name) as assigned_to, cf_669 as startdate, closingdate, campaigntype, campaignstatus, cf_671 as industry, sponsor, budgetcost, actualcost, expectedroi, actualroi FROM vtiger_campaign INNER JOIN vtiger_campaignscf on (vtiger_campaign.campaignid=vtiger_campaignscf.campaignid) INNER JOIN vtiger_crmentity on (vtiger_campaign.campaignid=vtiger_crmentity.crmid) INNER JOIN vtiger_users on (vtiger_users.id=vtiger_crmentity.smownerid) where date(cf_669)>date(now()) ORDER BY cf_669 DESC"),
			'held' => $this->db->query("SELECT vtiger_campaign.campaignid, campaignname, concat(first_name,' ',last_name) as assigned_to, cf_669 as startdate, closingdate, campaigntype, campaignstatus, cf_671 as industry, sponsor, budgetcost, actualcost, expectedroi, actualroi FROM vtiger_campaign INNER JOIN vtiger_campaignscf on (vtiger_campaign.campaignid=vtiger_campaignscf.campaignid) INNER JOIN vtiger_crmentity on (vtiger_campaign.campaignid=vtiger_crmentity.crmid) INNER JOIN vtiger_users on (vtiger_users.id=vtiger_crmentity.smownerid) where campaignstatus='completed' order by closingdate DESC"),
			'overdue' => $this->db->query("SELECT vtiger_campaign.campaignid, campaignname, concat(first_name,' ',last_name) as assigned_to, cf_669 as startdate, closingdate, campaigntype, campaignstatus, cf_671 as industry, sponsor, budgetcost, actualcost, expectedroi, actualroi FROM vtiger_campaign INNER JOIN vtiger_campaignscf on (vtiger_campaign.campaignid=vtiger_campaignscf.campaignid) INNER JOIN vtiger_crmentity on (vtiger_campaign.campaignid=vtiger_crmentity.crmid) INNER JOIN vtiger_users on (vtiger_users.id=vtiger_crmentity.smownerid) where date(cf_669)<date(now()) and campaignstatus != 'Completed' ORDER BY cf_669 DESC")
			);

		return $data;
	}

	function get_campaign_details($campaignid){
		return $this->db->query("select budgetcost,actualcost,expectedresponsecount,actualresponsecount,expectedsalescount,actualsalescount,expectedroi,actualroi,targetaudience,date(modifiedtime) as last_update,vtiger_campaign.campaignid, targetaudience, campaignname, campaigntype, campaignstatus, sponsor, cf_669 as startdate, closingdate, cf_671 as industry, CONCAT(first_name,' ',last_name) as user from vtiger_campaign INNER JOIN vtiger_campaignscf on vtiger_campaign.campaignid=vtiger_campaignscf.campaignid INNER JOIN vtiger_crmentity on vtiger_crmentity.crmid=vtiger_campaign.campaignid inner join vtiger_users on vtiger_crmentity.smownerid = vtiger_users.id where vtiger_campaign.campaignid=" . $campaignid)->result();
	}

	function get_related($campaignid){
		$data = array(
			'leads' => $this->db->query("SELECT * FROM `vtiger_campaignleadrel` INNER JOIN vtiger_leaddetails on vtiger_leaddetails.leadid=vtiger_campaignleadrel.leadid INNER JOIN vtiger_crmentity on vtiger_crmentity.crmid=vtiger_leaddetails.leadid where campaignid=" . $campaignid . " and deleted=0")->num_rows(),
			'accounts' => $this->db->query("SELECT * FROM `vtiger_campaignaccountrel` INNER JOIN vtiger_account on vtiger_campaignaccountrel.accountid=vtiger_account.accountid INNER JOIN vtiger_crmentity on vtiger_crmentity.crmid=vtiger_campaignaccountrel.accountid where campaignid=" . $campaignid . " and deleted=0")->num_rows(),
			'contacts' => $this->db->query("SELECT * FROM `vtiger_campaigncontrel` INNER JOIN vtiger_contactdetails on vtiger_campaigncontrel.contactid=vtiger_contactdetails.contactid INNER JOIN vtiger_crmentity on vtiger_crmentity.crmid=vtiger_campaigncontrel.contactid where campaignid=" . $campaignid . " and deleted=0")->num_rows(),
			'potentials' => $this->db->query("Select * from vtiger_potential INNER JOIN vtiger_crmentity on vtiger_crmentity.crmid=vtiger_potential.potentialid where campaignid=" . $campaignid . " and deleted=0")->num_rows()
		);

		return $data;
	}

	function get_fields(){
		$data = array(
			'leads'=> $this->db->query("SELECT columnname,fieldlabel FROM `vtiger_field` where tablename in ('vtiger_leaddetails','vtiger_leadscf') AND typeofdata like '%V%'")->result(),
			'accounts'=> $this->db->query("SELECT columnname,fieldlabel FROM `vtiger_field` where tablename in ('vtiger_account','vtiger_accountscf') AND typeofdata like '%V%'")->result(),
			'contacts'=> $this->db->query("SELECT columnname,fieldlabel FROM `vtiger_field` where tablename in ('vtiger_contactdetails','vtiger_contactscf') AND typeofdata like '%V%'")->result()
			);

		return $data;
	}

}