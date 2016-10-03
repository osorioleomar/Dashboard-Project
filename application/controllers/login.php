<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('users');
	}

	function index(){
    	$data['success'] = 1;

		$this->load->view('login',$data);
	}

	public function logout(){
        $this->session->sess_destroy();
        redirect('/' ,'refresh');
        exit;
    }

    public function validate(){

        $username =  $this->input->post('username');
        $password =  $this->input->post('password');
             
        //call the model for auth
        if($this->users->login($username, $password)){
        	redirect(base_url());
        }
        else{
        	$data['success'] = 0;
        	$this->load->view('login',$data);	
        }
     }    
}