<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller{
  public $data = [];
  public function __construct(){ 
    parent::__construct(); 
    $this->load->library('session'); 
    $this->load->model('Auth_modal');
  }
  // redirect to the login page if neccessary
  public function index(){
    if (!$this->session->userdata('adm_id')){
      redirect('Auth/login', 'refresh');
    }
    elseif ($this->session->userdata('adm_id')) {
      redirect('Main', 'refresh');
    }
  }
  //login function
  public function login(){
    if ($this->input->post('username') && $this->input->post('password')) {
        $username = $this->input->post('username');
        $password = sha1("WK*&%&".$this->input->post('password'));
        $this->Auth_modal->login($username,$password);
    }
    elseif ($this->session->userdata('ad_id')) {
       redirect('Main', 'refresh');
     }
    else{
      $this->load->view('auth/login');
    }

  }
  //logout function
  public function logout(){
      $this->session->unset_userdata('ad_id');
      $this->session->unset_userdata('ad_name');
      $this->session->unset_userdata('ad_username');
      $this->load->view('auth/login');
    
  }
  public function passwordReset(){ 
    $plain_password = '';
    $where = array("ad_email"=>$this->input->get('email'));
    if ($this->input->get()) { 
        $plain_password = "GK".rand(1000,9999)."Rt-12";
        $upd_data['ad_password'] = sha1("WK*&%&".$plain_password);
        if($this->Auth_modal->update_query('admin_user',$where,$upd_data)){
          mail($this->input->get('email'),'Password Reset',"New Password: '".$plain_password."'");
          $response['success'] = '1';
          $response['message'] = "update successfully";
          echo json_encode($response);
        }else{
          $response['success'] = '0';
          $response['message'] = "updatation Failed";
          echo json_encode($response);
        }              
    }
    
  }

}
