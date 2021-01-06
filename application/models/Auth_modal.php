<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_modal extends CI_Model{
   // Count all num of rows
   public function num_rows($query){
       $query = $this->db->query($query);
       $num_rows =  $query->num_rows();
       return $num_rows;
   }


   public function login($email,$pass){
     $sql = "SELECT * FROM admin_user where (ad_uname = '$email' || ad_email = '$email' ) AND ad_password = '$pass'";
     $query = $this->db->query($sql);
     if(!$query){
         $response['message']='error in sql query';
         $response['success']='201';
         echo json_encode($response);
     }
     else{
      if ($query->num_rows() > 0){
       $result =  $query->result_array();
       $this->load->library('session');
       foreach ($result as $row_show) {
         $this->session->set_userdata('ad_id', $row_show['ad_id']);
         $this->session->set_userdata('ad_uname', $row_show['ad_uname']); 
       }
       redirect('Main');
     }
     else {
       $this->session->set_flashdata('invalid','invalid username or password');
       redirect('Auth/login');
     }
   }
 }
   public function custom_query($query){
       $query = $this->db->query($query);
       return $query->result_array();
   }

   public function read_conditionally($table,$id,$col){
       $query = $this->db->query("SELECT * FROM $table WHERE $col = '$id' ");
       return $query->result_array();
   }

   public function insert($table,$data){
     if($this->db->insert($table,$data)){
         return true;
     }
     else{
         return  false;
      }
   }

    public  function update_query($tbl, $where, $data){
      $this->db->where($where);
      $this->db->update($tbl, $data);
      // print_r($this->db->last_query());exit(); 
      if ($this->db->affected_rows() > 0) {
        return true;
      }else {
        return false;
      }
    }

    //check duplicate
    public function check_duplicate($table,$where){
     $data = $this->db->select('*')->where($where)->get($table);
     $num = $data->num_rows();
     if($num > 0){
        return true;
     }
     else{
       return false;
     }

   }
  // check duplicate for app users againts email
  public function check_app_user($email){
     $data = $this->db->select('*')
     ->where('appus_email',$email)
     ->get('rescue_app_users');
     if ( $data->num_rows() > 0 ){
        $row = $data->row_array();
        return true;
     }
     else{
       return false;
     }

   }


  // delte record
  public function delete_rec($table,$id,$col){
     $result = $this->db->query("delete from $table where $col = $id");
     if($result){
         return TRUE;
     }
     else{
         return FALSE;
     }
   }



}
