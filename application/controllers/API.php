<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
 
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
/**
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class API extends REST_Controller {
    function __construct(){
        // Construct the parent class
        parent::__construct();
        date_default_timezone_set( 'Asia/Karachi' );
        $this->load->helper('url'); 
        $this->load->helper('text'); 
        $this->load->model('General_modal');
        $this->load->model('API_Model');
        $this->db->simple_query('SET NAMES \'utf-8\'');  

    }

    public function DateWithTime($date){
        return $date = date ("d M Y g:i A" , strtotime ($date));
        //return $date = date ("d M Y g:i:s A" , strtotime ($date));
    }

    // add firebased page access fucntion, xyz_post, send, sendPushNotification
    public function xyz_post(){
        $res = array();
        $res['data']['title'] = "This is title";
        $res['data']['Description'] = "This is Description";
        $res['data']['title'] = "12/25/2019";
        // $this->response($res);
        $response = $this->send($district->appus_notify_key, $res); 
    }

    public function send($to, $message) {
        $fields = array(
            'to' => $to,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }

    private function sendPushNotification($fields) {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            'Authorization: key=' . "AIzaSyDnBOdA5qkBD4rLKQl0IhFJmpQfeMdBTR0",
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        return $result;
    }
 

    public function update_nofity_key_post(){ 
        $notif_id =  $this->input->post("notif_id");
        $appus_id =  $this->input->post("uid");
        $where = array('appus_id'=>$appus_id);
        $data['appus_notify_key'] =  $notif_id; 
        if($res = $this->General_modal->update_query('rescue_app_users',$where,$data)){
            $response['message']='key update  successfuly';
            $response['success']=200;
            echo json_encode($response);
        }        

    }  
   
    // public function add_feedback_post(){

    //     $data['feedb_full_name']   = $this->input->post('feedb_full_name');
    //     $data['feedb_email']       = $this->input->post('feedb_email');
    //     $data['feedb_subject']     = $this->input->post('feedb_subject');
    //     $data['feedb_description'] = $this->input->post('feedb_description');           
    //     $data['appus_id'] = $this->input->post('appus_id');           
    //     $data['feedb_created']     = date('Y-m-d H:i:s',time());               

    //     if($this->API_Model->insert('rescue_feedbacks',$data))
    //     {
    //         $response['message']='Feedback added successfuly';
    //         $response['success']='200';
    //     }else{
    //         $response['message']='error in sql query';
    //         $response['success']='201';
    //     }
    //     $this->response($response);
    // }

    
    //  sources listing
    public function districtOffices_get(){
    	$response["data"] = array();
        $sources = $this->API_Model->fetch_all('district_office');
        if (!empty($sources)) {
        	foreach ($sources as $row) {
        	  $data['dist_id'] = $row['dist_id'];
            $data['dist_name'] = $row['dist_name'];
            $data['dist_officer_name'] = $row['dist_officer_name'];
            $data['dist_no_lzc'] = $row['dist_no_lzc'];
            $data['dist_phone'] = $row['dist_phone'];
            $data['dist_chairman_phone'] = $row['dist_chairman_phone'];
            $data['dist_chairman_name'] = $row['dist_chairman_name'];
            $data['dist_latitude'] = $row['dist_latitude'];
            $data['dist_longitude'] = $row['dist_longitude'];
            array_push($response["data"], $data);
            $response['success'] = 200;
        	}
        }
        else{
        	$response['message']='No data found';
            $response['success']=0;
        }
         $this->response($response);
    }
    public function districtOffices_detail_get(){
        $dist_id='';
        if (@$_GET['dist_id']) {
          $dist_id = $_GET['dist_id'];
        }
        $response["data"] = array();
        $sources = $this->API_Model->read_conditionally('district_office',$dist_id,'dist_id');
        if (!empty($sources)) {
            foreach ($sources as $row) {
              $response["data"]['dist_id'] = $row['dist_id'];
              $response["data"]['dist_name'] = $row['dist_name'];
              $response["data"]['dist_officer_name'] = $row['dist_officer_name'];
              $response["data"]['dist_no_lzc'] = $row['dist_no_lzc'];
              $response["data"]['dist_phone'] = $row['dist_phone'];
              $response["data"]['dist_chairman_phone'] = $row['dist_chairman_phone'];
              $response["data"]['dist_chairman_name'] = $row['dist_chairman_name'];
              $response["data"]['dist_latitude'] = $row['dist_latitude'];
              $response["data"]['dist_longitude'] = $row['dist_longitude'];
              // array_push($response["sources"], $data);
              $response['success'] = 200;
            }
        }
        else{
            $response['message']='No data found';
            $response['success']=0;
        }
         $this->response($response);
    }

    public function localZakatCommitte_get(){
        $dist_id='';
        if (@$_GET['dist_id']) {
           $dist_id = $_GET['dist_id'];
        }
        $response["data"] = array();
        $where['local_zakat_council.dist_id'] = $dist_id;
        $joins = array(
            array(
                'table'=>'tehsil t',
                'condition'=>'t.tehsil_id = local_zakat_council.tehsil_id',
                'type'=>'LEFT'
            )
        );
        $sources = $this->API_Model->select_fields_where_like_join('local_zakat_council','*',$joins,$where);
        if (!empty($sources)) {
            foreach ($sources as $row) {
              // $data['dist_id'] = $row->dist_id;
              $data['tehsil_id'] = $row->tehsil_id; 
              $data['tehsil_name'] = $row->tehsil_name; 
              $data['lzc_chairman'] = $row->lzc_chairman;
              $data['lzc_name'] = $row->lzc_name;
              $data['lzc_phone'] = $row->lzc_phone; 
              array_push($response["data"], $data);
              $response['success'] = 200;
            }
        }
        else{
            $response['message']='No data found';
            $response['success']=0;
        }
         $this->response($response);
    }
    public function districtHospitals_get(){
        $response["data"] = array();
        $joins = array(
            array(
                'table'=>'district_office d',
                'condition'=>'d.dist_id = district_hospitals.dist_id',
                'type'=>'LEFT'
            )
        );
        $sources = $this->API_Model->select_fields_where_like_join('district_hospitals','*',$joins);
        if (!empty($sources)) {
            foreach ($sources as $row) {
              $data['dh_name'] = $row->dh_name;
              $data['dh_focal_person'] = $row->dh_focal_person;
              $data['dh_phone'] = $row->dh_phone;
              $data['dh_phone'] = $row->dh_phone;
              $data['dist_id'] = $row->dist_id;
              $data['dist_name'] = $row->dist_name;
              $data['dh_latitude'] = $row->dh_latitude;
              $data['dh_longitude'] = $row->dh_longitude;
              array_push($response["data"], $data);
              $response['success'] = 200;
            }
        }
        else{
            $response['message']='No data found';
            $response['success']=0;
        }
        $this->response($response);
    } 
      

      
 

}
