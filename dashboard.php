<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('charts');
	}

	function index(){
		redirect(base_url('index.php/dashboard/dashboard_leads'));
	}

	function dashboard_leads(){
		$data['result'] = $this->charts->get_charts_leads();
		$total = $this->total_numbers();
		$leadbystatus = $this->lead_status();
		$contactbytype = $this->contact_type();
		$opportunitystatus = $this->opportunity_status();

		$this->load->view('home',array_merge($data, $total, $leadbystatus, $contactbytype, $opportunitystatus));
	}

	function dashboard_accounts(){
		$data['result'] = $this->charts->get_charts_accounts();
		$total = $this->total_numbers();
		$leadbystatus = $this->lead_status();
		$contactbytype = $this->contact_type();
		$opportunitystatus = $this->opportunity_status();

		$this->load->view('home',array_merge($data,$total, $leadbystatus, $contactbytype, $opportunitystatus));
	}

	function dashboard_contacts(){
		$data['result'] = $this->charts->get_charts_contacts();
		$total = $this->total_numbers();
		$leadbystatus = $this->lead_status();
		$contactbytype = $this->contact_type();
		$opportunitystatus = $this->opportunity_status();

		$this->load->view('home',array_merge($data,$total, $leadbystatus, $contactbytype, $opportunitystatus));
	}

	function dashboard_opportunities(){
		$data['result'] = $this->charts->get_charts_opportunities();
		$total = $this->total_numbers();
		$leadbystatus = $this->lead_status();
		$contactbytype = $this->contact_type();
		$opportunitystatus = $this->opportunity_status();

		$this->load->view('home',array_merge($data,$total, $leadbystatus, $contactbytype, $opportunitystatus));
	}

	function dashboard_calendar(){
		$data['result'] = $this->charts->get_charts_calendar();
		$total = $this->total_numbers();
		$leadbystatus = $this->lead_status();
		$contactbytype = $this->contact_type();
		$opportunitystatus = $this->opportunity_status();

		$this->load->view('home',array_merge($data,$total, $leadbystatus, $contactbytype, $opportunitystatus));
	}

	function new_chart_leads(){
		$this->session->set_userdata('module','vtiger_leaddetails');
		$this->session->set_userdata('modulecf','vtiger_leadscf');
		$this->session->set_userdata('mypage','Leads');

		$data['fields']=$this->get_leads_fields();
		$data['form_action']= base_url('index.php/dashboard/preview_chart/leads');		

		$this->load->view('new_chart', $data);
	}

	function new_chart_accounts(){
		$this->session->set_userdata('module','vtiger_account');
		$this->session->set_userdata('modulecf','vtiger_accountscf');
		$this->session->set_userdata('mypage','Accounts');

		$data['fields']=$this->get_accounts_fields();
		$data['form_action']= base_url('index.php/dashboard/preview_chart/accounts');	

		$this->load->view('new_chart', $data);
	}

	function new_chart_contacts(){
		$this->session->set_userdata('module','vtiger_contactdetails');
		$this->session->set_userdata('modulecf','vtiger_contactscf');
		$this->session->set_userdata('mypage','Contacts');

		$data['fields']=$this->get_contacts_fields();
		$data['form_action']= base_url('index.php/dashboard/preview_chart/contacts');	
		
		$this->load->view('new_chart', $data);
	}

	function new_chart_opportunities(){
		$this->session->set_userdata('module','vtiger_potential');
		$this->session->set_userdata('modulecf','vtiger_potentialscf');
		$this->session->set_userdata('mypage','Opportunities');

		$data['fields']=$this->get_opportunities_fields();
		$data['form_action']= base_url('index.php/dashboard/preview_chart/opportunities');	

		$this->load->view('new_chart', $data);
	}

	function new_chart_calendar(){
		$this->session->set_userdata('module','vtiger_activity');
		$this->session->set_userdata('modulecf','vtiger_activitycf');
		$this->session->set_userdata('mypage','Activities');

		$data['fields']=$this->get_calendar_fields();
		$data['form_action']= base_url('index.php/dashboard/preview_chart/calendar');	
		
		$this->load->view('new_chart', $data);
	}

//////----Save Charts to Dashboard----//////

	function save_chart($charttype){
		if($charttype=='bar'){
			$chartdetails = $this->session->userdata('bar');
		}elseif ($charttype=='line') {
			$chartdetails = $this->session->userdata('line');
		}elseif ($charttype=='donut') {
			$chartdetails = $this->session->userdata('donut');
		}elseif ($charttype=='polararea') {
			$chartdetails = $this->session->userdata('polar');
		}

		$data = array('chart_module' => $chartdetails['module'],
						'chart_type' => $charttype,
						'chart_owner' => '2',
						'chart_series' => $chartdetails['series'],
						'chart_title' => $chartdetails['title'],
						'chart_category' => $chartdetails['categories']
					 );

		$this->charts->save_chart($data);

	}

//////----Delete Chart---////

	function delete_chart($chartid){
		$this->charts->delete_chart($chartid);

		?>
			<script type="text/javascript"> history.go(-1); </script>
		<?php
	}

/////----Get the numbers for home dashboard----//////
	function total_numbers(){
		$accounts = $this->db->query('SELECT * FROM vtiger_account');

		$leads = $this->db->query('SELECT * FROM vtiger_leaddetails');

		$contacts = $this->db->query('SELECT * FROM vtiger_contactdetails');

		$opportunities = $this->db->query('SELECT * FROM vtiger_potential');

		$totals = array('accounts' => $accounts->num_rows(),
								'leads' => $leads->num_rows(),
								'contacts' => $contacts->num_rows(),
								'opportunities' => $opportunities->num_rows()
								 );

		return $totals;
	}

/////----Details for the numbers in Dashboard----//////
	function lead_status(){
		$leadsbystatus = $this->db->query('SELECT (Select count(rating) FROM vtiger_leaddetails where rating = "Cold" group by rating) as Cold, (Select count(rating) FROM vtiger_leaddetails where rating = "Junk" group by rating) as Junk, (Select count(*) FROM vtiger_leaddetails where rating != "Cold" and rating!= "Junk") as Active FROM vtiger_leaddetails limit 0,1');
		
		return $leadsbystatus->row_array();
	}

	function contact_type(){
		$contacttype = $this->db->query('SELECT (select count(*) from vtiger_contactdetails where accountid=0) as Individual, (select count(*) from vtiger_contactdetails where accountid!=0) as Company from vtiger_contactdetails LIMIT 0,1 ');

		return $contacttype->row_array();
	}

	function opportunity_status(){
		$opportunitystatus = $this->db->query('Select (select count(*) from vtiger_potential where sales_stage like "closed%") as closed, (select count(*) from vtiger_potential where sales_stage not like "closed%") as open from vtiger_potential LIMIT 0,1 ');
	
		return $opportunitystatus->row_array();		
	}

////////////----./details----///////////////////////

///////////////----functions for getting the information for charts----///////////////

	function chart_series(){
		
		$module = $this->session->userdata('module');
		$modulecf = $this->session->userdata('modulecf');

		if($module=='vtiger_leaddetails'){
			$primarykey = 'leadid';
		}elseif ($module=='vtiger_account') {
			$primarykey = 'accountid';
		}elseif ($module=='vtiger_contactdetails') {
			$primarykey = 'contactid';
		}elseif ($module=='vtiger_potential') {
			$primarykey = 'potentialid';
		}elseif ($module=='vtiger_activity') {
			$primarykey = 'activityid';
		}

		if($this->input->post('fieldname')){
			$fieldnames = $this->input->post('fieldname');
			$fieldconditions = $this->input->post('condition');
			$fieldvalues = $this->input->post('fieldvalue');
			$andor = $this->input->post('andor');
		}

			if(empty($_POST['data2'])){
				$this->db->select($_POST['data1'] . ', count(*) as count_number');
				$this->db->join($modulecf,$module . '.' . $primarykey . '=' . $modulecf . '.' . $primarykey, 'inner');
		
				if($this->input->post('fieldname')){
						$i=0;
						foreach($fieldnames as $clause){ //get all conditions
							if($i==0){

								if($fieldconditions[$i]=='like'){ //for conditions with wildcard

									$this->db->like($clause, $fieldvalues[$i]);

								}elseif($fieldconditions[$i]=='not like'){

									$this->db->not_like($clause, $fieldvalues[$i]);

								}else{ //for condition without wildcard

									$this->db->where($clause . ' ' . $fieldconditions[$i], $fieldvalues[$i]);
								}

							}else{

								if($fieldconditions[$i]=='like'){ //for conditions with wildcard

									$this->db->or_like($clause, $fieldvalues[$i]);

								}elseif($fieldconditions[$i]=='not like'){

									$this->db->or_not_like($clause, $fieldvalues[$i]);

								}else{

									$this->db->or_where($clause . ' ' . $fieldconditions[$i], $fieldvalues[$i]);
								}

							}
									$i++;
						}
				}

				$this->db->group_by($_POST['data1']);

				$query = $this->db->get($module);

				$result = $query->result();

			}else{

				$chartlabels = $this->get_chart_label();

				foreach($chartlabels as $chartlabel){
					$this->db->select($_POST['data2'] . ', count(*) as count_number');
					$this->db->join($modulecf,$module . '.' . $primarykey . '=' . $modulecf . '.' . $primarykey, 'inner');
					$this->db->where($_POST['data1'],$chartlabel->$_POST['data1']);

				if($this->input->post('fieldname')){
						$i=0;
						foreach($fieldnames as $clause){ //get all conditions
							if($i==0){

								if($fieldconditions[$i]=='like'){ //for conditions with wildcard

									$this->db->like($clause, $fieldvalues[$i]);

								}elseif($fieldconditions[$i]=='not like'){

								$this->db->not_like($clause, $fieldvalues[$i]);

								}else{ //for condition without wildcard

								$this->db->where($clause . ' ' . $fieldconditions[$i], $fieldvalues[$i]);
								}

							}else{
								if($andor[$i-1]=='or'){

									if($fieldconditions[$i]=='like'){ //for conditions with wildcard

										$this->db->or_like($clause, $fieldvalues[$i]);

									}elseif($fieldconditions[$i]=='not like'){

										$this->db->or_not_like($clause, $fieldvalues[$i]);

									}else{ //for condition without wildcard

										$this->db->or_where($clause . ' ' . $fieldconditions[$i], $fieldvalues[$i]);
									}

								}else{

									if($fieldconditions[$i]=='like'){ //for conditions with wildcard

										$this->db->like($clause, $fieldvalues[$i]);

									}elseif($fieldconditions[$i]=='not like'){

										$this->db->not_like($clause, $fieldvalues[$i]);

									}else{ //for condition without wildcard

										$this->db->where($clause . ' ' . $fieldconditions[$i], $fieldvalues[$i]);
									}

								}
							}
									$i++;
						}
				}		

					$this->db->group_by($_POST['data2']);

					$query = $this->db->get($module);

					$resultseries[] = $query->result();
				}
				$result = $resultseries;
			}
			return $result;

		}
	

	//get chart label for chart with series//
	function get_chart_label(){

		$module = $this->session->userdata('module');
		$modulecf = $this->session->userdata('modulecf');

		if($module=='vtiger_leaddetails'){
			$primarykey = 'leadid';
		}elseif ($module=='vtiger_account') {
			$primarykey = 'accountid';
		}elseif ($module=='vtiger_contactdetails') {
			$primarykey = 'contactid';
		}elseif ($module=='vtiger_potential') {
			$primarykey = 'potentialid';
		}elseif ($module=='vtiger_activity') {
			$primarykey = 'activityid';
		}

		$this->db->select($_POST['data1'] . ', count(*)');
		$this->db->join($modulecf,$module . '.' . $primarykey . '=' . $modulecf . '.' . $primarykey, 'inner');
		$this->db->group_by($_POST['data1']);

		$query=$this->db->get($module);

		return $query->result();
	}

	function preview_chart($pagemodule){
		if(!empty($_POST['data2'])){
		$data['labels'] = $this->get_chart_label();
		}
		$data['series'] = $this->chart_series();


		if($pagemodule=='leads'){
			$data['fields']=$this->get_leads_fields();
		}elseif ($pagemodule=='accounts') {
			$data['fields']=$this->get_accounts_fields();
		}elseif ($pagemodule=='contacts') {
			$data['fields']=$this->get_contacts_fields();
		}elseif ($pagemodule=='opportunities') {
			$data['fields']=$this->get_opportunities_fields();
		}elseif ($pagemodule=='calendar') {
			$data['fields']=$this->get_calendar_fields();
		}

		$data['form_action']= base_url('index.php/dashboard/preview_chart/' . $pagemodule);	

		$this->load->view('new_chart', $data);

		$_POST['data1']= NULL;
		$_POST['data2']= NULL;
	}


///////----functions for getting the fields per module----///////
	function get_leads_fields(){
		$query['input'] = $this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'V%' and tablename in('vtiger_leaddetails','vtiger_leadscf','vtiger_leadaddress') ORDER BY tablename DESC ")->result();
		$query['picklist'] = $this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'V%' and uitype=15 and tablename in('vtiger_leaddetails','vtiger_leadscf','vtiger_leadaddress') ORDER BY tablename DESC ")->result();
		$query['date'] = $this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'D%' and tablename in('vtiger_leaddetails','vtiger_leadscf','vtiger_leadaddress') ORDER BY tablename DESC ")->result();
		$query['amount'] = $this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'N%' and tablename in('vtiger_leaddetails','vtiger_leadscf','vtiger_leadaddress') ORDER BY tablename DESC ")->result();
	
		return $query;
	}

	function get_accounts_fields(){
		$query['input'] = $this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'V%' and tablename in('vtiger_account','vtiger_accountscf') ORDER BY fieldlabel ")->result();
		$query['picklist'] = $this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'V%' and uitype=15 and tablename in('vtiger_account','vtiger_accountscf') ORDER BY fieldlabel ")->result();
		$query['date'] = $this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'D%' and tablename in('vtiger_account','vtiger_accountscf') ORDER BY fieldlabel ")->result();
		$query['amount'] = $this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'N%' and tablename in('vtiger_account','vtiger_accountscf') ORDER BY fieldlabel ")->result();

		return $query;
	}

	function get_contacts_fields(){
		$query['input']=$this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'V%' and tablename in('vtiger_contactdetails','vtiger_contactscf','vtiger_contactsubdetails') ORDER BY tablename")->result();
		$query['picklist']=$this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'V%' and uitype=15 and tablename in('vtiger_contactdetails','vtiger_contactscf','vtiger_contactsubdetails') ORDER BY tablename")->result();
		$query['date']=$this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'D%' and tablename in('vtiger_contactdetails','vtiger_contactscf','vtiger_contactsubdetails') ORDER BY tablename")->result();
		$query['amount']=$this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'N%' and tablename in('vtiger_contactdetails','vtiger_contactscf','vtiger_contactsubdetails') ORDER BY tablename")->result();

		return $query;
	}

	function get_opportunities_fields(){
		$query['input']=$this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'V%' and tablename in('vtiger_potential','vtiger_potentialscf') ORDER BY tablename")->result();
		$query['picklist']=$this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'V%' and uitype=15 and tablename in('vtiger_potential','vtiger_potentialscf') ORDER BY tablename")->result();
		$query['date']=$this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'D%' and tablename in('vtiger_potential','vtiger_potentialscf') ORDER BY tablename")->result();
		$query['amount']=$this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'N%' and tablename in('vtiger_potential','vtiger_potentialscf') ORDER BY tablename")->result();

		return $query;
	}

	function get_calendar_fields(){
		$query['input']=$this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'V%' and tablename in('vtiger_activity','vtiger_activitycf') ORDER BY tablename")->result();
		$query['picklist']=$this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'V%' and uitype=15 and tablename in('vtiger_activity','vtiger_activitycf') ORDER BY tablename")->result();
		$query['date']=$this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'D%' and tablename in('vtiger_activity','vtiger_activitycf') ORDER BY tablename")->result();
		$query['amount']=$this->db->query("SELECT columnname,fieldlabel FROM vtiger_field where typeofdata like 'N%' and tablename in('vtiger_activity','vtiger_activitycf') ORDER BY tablename")->result();

		return $query;
	}

///////////-----./fields per module-----/////////////////////
	
}
