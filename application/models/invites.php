<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invites extends CI_Model{

	function get_industry(){
		$this->db->select('cf_758');
		$this->db->order_by('cf_758','ASC');
		$this->db->group_by('cf_758');
		$result = $this->db->get('vtiger_cf_758');

		return $result->result();
	}

	function get_location(){
		$result = array(
			'leads' => $this->db->query("SELECT REPLACE(UPPER(city),'CITY','') as city FROM `vtiger_leadaddress` group by REPLACE(UPPER(city),'CITY','')"),
			'accounts' => $this->db->query("SELECT REPLACE(UPPER(bill_city),'CITY','') as city FROM `vtiger_accountbillads` group by REPLACE(UPPER(bill_city),'CITY','')"),
			'contacts' => $this->db->query("SELECT REPLACE(UPPER(mailingcity),'CITY','') as city FROM `vtiger_contactaddress` group by REPLACE(UPPER(mailingcity),'CITY','')")
				);

		return $result;
	}

	function get_leads(){

			$leads = $this->db->query("Select vtiger_leaddetails.leadid,company, CONCAT(firstname,' ',lastname) as name, designation, email, phone, CONCAT(lane,', ',city) as address, cf_758 as industry, cf_760 as segment from vtiger_leaddetails inner join vtiger_leadscf on vtiger_leaddetails.leadid=vtiger_leadscf.leadid INNER JOIN vtiger_leadaddress ON vtiger_leadaddress.leadaddressid = vtiger_leaddetails.leadid INNER JOIN vtiger_crmentity on vtiger_leaddetails.leadid = vtiger_crmentity.crmid where deleted=0");

		return $leads;
	}

	/*
	-@param all fiter parameters
	-returns query result as object
	-desc: filter leads for ajax call
	*/
	function get_filtered_leads($industry, $location, $fieldnames, $conditions, $values, $andors){
		if($industry != ''){
			$where_industry = " and cf_758 = '" . $industry . "'";
		}else{
			$where_industry = "";
		};

		if(!empty($location) && $location[0] != ''){
			foreach($location as $lane){
				$address[] = '"' . $lane . '"';
			};

			$where_location = " and REPLACE(UPPER(city),'CITY','') in (" . implode(',', $address) . ")";
		}else{
			$where_location = "";
		};

		if(!empty($fieldnames)){
			$i = 0;
			foreach($fieldnames as $fieldname){

				if($i==0){
					if($conditions[$i] == 'like' || $conditions[$i] == 'not like'){
						$where_advance[] = " and " . $fieldname . " " . $conditions[$i] . " '%" . $values[$i] . "%' ";
					}else{
						$where_advance[] = " and " . $fieldname . " " . $conditions[$i] . " '" . $values[$i] . "' ";
					}
				}else{
					if($conditions[$i] == 'like' || $conditions[$i] == 'not like'){
						$where_advance[] = " " . $andors[$i-1] . " " . $fieldname . " " . $conditions[$i] . " '%" . $values[$i] . "%' ";
					}else{
						$where_advance[] = " " . $andors[$i-1] . " " . $fieldname . " " . $conditions[$i] . " '" . $values[$i] . "' ";
					}					
				}
				$i++;
			}
		}else{
			$where_advance = array();
		};

		$where = $where_industry . $where_location . implode($where_advance);

		$query = $this->db->query("Select vtiger_leaddetails.leadid,company, CONCAT(firstname,' ',lastname) as name, designation, email, phone, CONCAT(lane,', ',city) as address, cf_758 as industry, cf_760 as segment from vtiger_leaddetails inner join vtiger_leadscf on vtiger_leaddetails.leadid=vtiger_leadscf.leadid INNER JOIN vtiger_leadaddress ON vtiger_leadaddress.leadaddressid = vtiger_leaddetails.leadid INNER JOIN vtiger_crmentity on vtiger_leaddetails.leadid = vtiger_crmentity.crmid where deleted=0" . $where);
		
		return $query;
	}

	/*
	-@param all fiter parameters
	-returns query result as object
	-desc: filter accounts for ajax call
	*/
	function get_filtered_accounts($industry, $location, $fieldnames, $conditions, $values, $andors){
		if($industry != ''){
			$where_industry = " and cf_754 = '" . $industry . "'";
		}else{
			$where_industry = "";
		};

		if(!empty($location) && $location[0] != ''){
			foreach($location as $lane){
				$address[] = '"' . $lane . '"';
			};

			$where_location = " and REPLACE(UPPER(bill_city),'CITY','') in (" . implode(',', $address) . ")";
		}else{
			$where_location = "";
		};

		if(!empty($fieldnames)){
			$i = 0;
			foreach($fieldnames as $fieldname){

				if($i==0){
					if($conditions[$i] == 'like' || $conditions[$i] == 'not like'){
						$where_advance[] = " and " . $fieldname . " " . $conditions[$i] . " '%" . $values[$i] . "%' ";
					}else{
						$where_advance[] = " and " . $fieldname . " " . $conditions[$i] . " '" . $values[$i] . "' ";
					}
				}else{
					if($conditions[$i] == 'like' || $conditions[$i] == 'not like'){
						$where_advance[] = " " . $andors[$i-1] . " " . $fieldname . " " . $conditions[$i] . " '%" . $values[$i] . "%' ";
					}else{
						$where_advance[] = " " . $andors[$i-1] . " " . $fieldname . " " . $conditions[$i] . " '" . $values[$i] . "' ";
					}					
				}
				$i++;
			}
		}else{
			$where_advance = array();
		};

		$where = $where_industry . $where_location . implode($where_advance);

		$query = $this->db->query("Select vtiger_account.accountid,accountname, phone, email1, bill_street, bill_city, cf_754, cf_756 from vtiger_account INNER JOIN vtiger_accountbillads on vtiger_account.accountid=vtiger_accountbillads.accountaddressid INNER JOIN vtiger_accountscf on vtiger_accountscf.accountid=vtiger_account.accountid INNER JOIN vtiger_crmentity on vtiger_account.accountid=vtiger_crmentity.crmid WHERE deleted=0" . $where);
		
		return $query;
	}

	/*
	-@param all fiter parameters
	-returns query result as object
	-desc: query contacts for ajax call
	*/
	function get_filtered_contacts($industry, $location, $fieldnames, $conditions, $values, $andors){
		if($industry != ''){
			$where_industry = " and cf_762 = '" . $industry . "'";
		}else{
			$where_industry = "";
		};

		if(!empty($location) && $location[0] != ''){
			foreach($location as $lane){
				$address[] = '"' . $lane . '"';
			};

			$where_location = " and REPLACE(UPPER(mailingcity),'CITY','') in (" . implode(',', $address) . ")";
		}else{
			$where_location = "";
		};

		if(!empty($fieldnames)){
			$i = 0;
			foreach($fieldnames as $fieldname){

				if($i==0){
					if($conditions[$i] == 'like' || $conditions[$i] == 'not like'){
						$where_advance[] = " and " . $fieldname . " " . $conditions[$i] . " '%" . $values[$i] . "%' ";
					}else{
						$where_advance[] = " and " . $fieldname . " " . $conditions[$i] . " '" . $values[$i] . "' ";
					}
				}else{
					if($conditions[$i] == 'like' || $conditions[$i] == 'not like'){
						$where_advance[] = " " . $andors[$i-1] . " " . $fieldname . " " . $conditions[$i] . " '%" . $values[$i] . "%' ";
					}else{
						$where_advance[] = " " . $andors[$i-1] . " " . $fieldname . " " . $conditions[$i] . " '" . $values[$i] . "' ";
					}					
				}
				$i++;
			}
		}else{
			$where_advance = array();
		};

		$where = $where_industry . $where_location . implode($where_advance);

		$query = $this->db->query("Select vtiger_contactdetails.contactid,accountname as company, concat(firstname,' ',lastname) as name, email, vtiger_contactdetails.phone, mobile, title, cf_762, cf_764, mailingstreet, mailingcity from vtiger_contactdetails INNER JOIN vtiger_contactaddress on vtiger_contactdetails.contactid = vtiger_contactaddress.contactaddressid INNER JOIN vtiger_contactscf on vtiger_contactdetails.contactid=vtiger_contactscf.contactid INNER JOIN vtiger_crmentity on vtiger_contactdetails.contactid=vtiger_crmentity.crmid INNER JOIN vtiger_account on vtiger_account.accountid = vtiger_contactdetails.accountid where deleted=0" . $where);
		
		return $query;
	}

	/*
	-get all prospects gathered from leads
	-no filter
	*/
	function get_invites_leads(){
		$query = $this->db->query("SELECT campaignname, company, concat(firstname,' ',lastname) as name, designation, email FROM `vtiger_invites` as invites LEFT JOIN vtiger_campaign as campaign on invites.campaignid=campaign.campaignid INNER JOIN vtiger_leaddetails as leads on invites.crmid = leads.leadid INNER JOIN vtiger_leadscf as leadscf on leads.leadid=leadscf.leadid where module='leads'");
		return $query->result();
	}
}