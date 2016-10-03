<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Model{

	function get_comments(){
		return $this->db->query("Select m.setype as module,commentcontent as comment, m.label as related_to, CONCAT(first_name,' ',last_name) as user, c.createdtime as createdtime from vtiger_modcomments INNER JOIN vtiger_crmentity as m on vtiger_modcomments.related_to = m.crmid INNER JOIN vtiger_crmentity as c on vtiger_modcomments.modcommentsid = c.crmid INNER JOIN vtiger_users on vtiger_modcomments.userid=vtiger_users.id order by createdtime DESC limit 0,1000")->result();
	}

	function get_comments_filtered($campaign,$module,$fieldname,$keyword,$startdate,$enddate){
		$where_campaign = "";

		if($module != 'All'){
			$where_module = " m.setype = '" . $module . "' ";
		}else{
			$where_module = " m.setype !='' ";
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
		
		$where_changedon = " AND date(c.createdtime) >= '" . $startdate . "' and date(c.createdtime) <= '" . $enddate . "' ";

		$where_statement =  " where " . $where_campaign . $where_module . $where_fieldname . $where_changedon;

		if($where_statement != ""){
			$where_statement =  " where " . $where_campaign . $where_module . $where_fieldname . $where_changedon;
		}else{
			$where_statement =  $where_campaign . $where_module . $where_fieldname . $where_changedon;
		}
		

		$query = $this->db->query("Select m.setype as module,commentcontent as comment, m.label as related_to, CONCAT(first_name,' ',last_name) as user, c.createdtime as createdtime from vtiger_modcomments INNER JOIN vtiger_crmentity as m on vtiger_modcomments.related_to = m.crmid INNER JOIN vtiger_crmentity as c on vtiger_modcomments.modcommentsid = c.crmid INNER JOIN vtiger_users on vtiger_modcomments.userid=vtiger_users.id " . $where_statement . " order by createdtime DESC")->result();
		return $query;
	}
}