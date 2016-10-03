<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Model{


	/*
	 get all tracks
	*/
	function get_tracks(){
		$query = $this->db->query(" SELECT vtiger_modtracker_basic.crmid, CONCAT( first_name,  ' ', last_name ) AS user, prevalue, postvalue, fieldname, changedon, label, setype, createdtime, vtiger_modtracker_basic.status FROM vtiger_modtracker_basic INNER JOIN vtiger_modtracker_detail ON vtiger_modtracker_basic.id = vtiger_modtracker_detail.id INNER JOIN vtiger_crmentity ON vtiger_modtracker_basic.crmid = vtiger_crmentity.crmid INNER JOIN vtiger_users ON vtiger_users.id = vtiger_modtracker_basic.whodid WHERE setype in ('Leads','Accounts','Contacts','ModComments','Potentials', 'Campaigns') AND fieldname!='modifiedby' AND vtiger_modtracker_basic.status =0 || vtiger_modtracker_basic.status =1 ORDER BY changedon DESC LIMIT 0,1000");
		return $query;
	}

	/*
	 get tracks by module
	*/
	function get_tracks_filtered($campaign,$module,$fieldname,$keyword,$startdate,$enddate){
		$where_campaign = "";

		if($module != 'All'){
			$where_module = " AND setype = '" . $module . "' ";
		}else{
			$where_module = "";
		};

		if($keyword != ''){
			if($fieldname=='whodid'){
				$where_fieldname = " AND CONCAT(first_name, ' ', last_name) LIKE '%" . $keyword . "%' ";
			}else{
				$where_fieldname = " AND " . $fieldname . " LIKE '%" . $keyword . "%' ";
			}
		}else{
			$where_fieldname = "";
		}
		
		$where_changedon = " AND date(changedon) >= '" . $startdate . "' and date(changedon) <= '" . $enddate . "' ";

		$where_statement =  $where_campaign . $where_module . $where_fieldname . $where_changedon;

		$query = $this->db->query(" SELECT vtiger_modtracker_basic.crmid, CONCAT( first_name,  ' ', last_name ) AS user, prevalue, postvalue, fieldname, changedon, label, setype, createdtime, vtiger_modtracker_basic.status FROM vtiger_modtracker_basic INNER JOIN vtiger_modtracker_detail ON vtiger_modtracker_basic.id = vtiger_modtracker_detail.id INNER JOIN vtiger_crmentity ON vtiger_modtracker_basic.crmid = vtiger_crmentity.crmid INNER JOIN vtiger_users ON vtiger_users.id = vtiger_modtracker_basic.whodid WHERE fieldname!='modifiedby' AND vtiger_modtracker_basic.status !=2 " . $where_statement . " ORDER BY changedon DESC");
		return $query;
	}

	function tracks_today(){
		return $this->db->query("SELECT vtiger_modtracker_basic.crmid, CONCAT( first_name, ' ', last_name ) AS user, prevalue, postvalue, fieldname, changedon, label, setype, createdtime, vtiger_modtracker_basic.status FROM vtiger_modtracker_basic INNER JOIN vtiger_modtracker_detail ON vtiger_modtracker_basic.id = vtiger_modtracker_detail.id INNER JOIN vtiger_crmentity ON vtiger_modtracker_basic.crmid = vtiger_crmentity.crmid INNER JOIN vtiger_users ON vtiger_users.id = vtiger_modtracker_basic.whodid WHERE vtiger_modtracker_basic.status !=2 AND date(changedon) = date(now())")->num_rows();
	}

	/*
		TODO get all comments
	*/
	function get_comments(){

	}

	/*
		TODO get all tracks by module
	*/
	function get_tracks_by_module(){

	}

	/*
		TODO get all comments by module
	*/
	function get_comments_by_module(){

	}

	function get_users(){
		return $this->db->query("Select id,concat(first_name, ' ', last_name) as name from vtiger_users")->result();
	}

	function get_fields(){
		return $this->db->query("Select DISTINCT fieldname, fieldlabel from vtiger_field")->result();
	}

}

/*
SELECT fieldname,prevalue,postvalue , concat(first_name,' ',last_name) as name, changedon, setype, label FROM vtiger_modtracker_detail INNER JOIN vtiger_modtracker_basic ON vtiger_modtracker_basic.id = vtiger_modtracker_detail.id INNER JOIN vtiger_users on vtiger_modtracker_basic.whodid = vtiger_users.id INNER JOIN vtiger_crmentity on vtiger_modtracker_basic.crmid = vtiger_crmentity.crmid ORDER BY `vtiger_modtracker_basic`.`changedon` DESC
*/

/*
SELECT CONCAT( first_name,  ' ', last_name ) AS user, prevalue, postvalue, fieldname, changedon, label
FROM vtiger_modtracker_basic
INNER JOIN vtiger_modtracker_detail ON vtiger_modtracker_basic.id = vtiger_modtracker_detail.id
INNER JOIN vtiger_crmentity ON vtiger_modtracker_basic.crmid = vtiger_crmentity.crmid
INNER JOIN vtiger_users ON vtiger_users.id = vtiger_modtracker_basic.whodid
WHERE changedon != createdtime
GROUP BY vtiger_modtracker_detail.id
ORDER BY changedon DESC 
LIMIT 0 , 30
*/