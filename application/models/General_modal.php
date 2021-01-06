<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class General_modal extends CI_Model{



   public function Fetch_specific_row($table='',$column='',$id=''){
    $query_data = "SELECT * FROM " . $table . " WHERE " .$column. " = " .$id;
    $query = $this->db->query($query_data);
    return $query->result_array();
   }


   public function fetch_all($table,$limit='', $start=''){
       // $sql = "select * from $table";
       // if ($limit) {
       //   $sql .=" LIMIT '$limit', '$start'  ";
       // }
        // echo $table."  ".$limit."   ".$start;exit();
       if(!empty($limit)){
        $this->db->limit($limit, $start);
       }

       $query = $this->db->get($table); 
       // $query = $this->db->query($sql);
       return $query->result_array();
   }

   // Count all num of rows
   public function num_rows($query){
       // echo $query; 
       $query = $this->db->query($query); 
       $num_rows =  $query->num_rows();
       return $num_rows;
   }
 

   public function num_row_feed($query){
       // echo $query;
       $query = $this->db->query("SELECT * FROM rescue_feedbacks"); 
       $num_rows =  $query->num_rows();
       return $num_rows;
   }

   


   public function Off_vehicle_types($index=''){
      $activity_log_title = array(
          "1"=> 'Ambulance',
          "2"=> 'Truck');

      if($index == ''){
        return '';
      }else{
        return $activity_log_title[$index];
      }

   }

    

  public function insert_last_id($table,$data){
     if($this->db->insert($table,$data)){
      //print_r($this->db->last_query());//exit();
      //print_r($this->db->error());
         return $this->db->insert_id();
     }
     else{
         return  false;
      }
   }

    

   // Select general query 
   public function select_fields_where_like_join($tbl = '', $data='', $joins = '', $where = '', $single = FALSE, $field = '', $value = '',$group_by='',$order_by = '',$limit = '',$page='',$where_in_col='',$where_in_array=''){
   
        if (is_array($data) and isset($data[1])){
            $this->db->select($data[0],$data[1]);
        }else{
            $this->db->select($data);
        }

        $this->db->from($tbl);
        if ($joins != '') {
            foreach ($joins as $k => $v) {
                $this->db->join($v['table'], $v['condition'], $v['type']);
            }
        }

        if ($value !== '') {
            // $this->db->like('LOWER(' . $field . ')', strtolower($value));
            // $this->db->or_like($value);
            $this->db->like($value);
        }

        if ($where != '') {
            $this->db->where($where);
        }

        if ($where_in_col != '' && $where_in_array !='') {
             $this->db->where_in($where_in_col,$where_in_array);
        }
           

        if($group_by != ''){
            $this->db->group_by($group_by);
        }
        if($order_by != ''){
            if(is_array($order_by)){
                $this->db->order_by($order_by[0],$order_by[1]);
            }else{
                $this->db->order_by($order_by);
            }
        }
        if($limit != ''){
            // if(is_array($limit)){
            //     $this->db->limit($limit[0],$limit[1]);
            // }else{
            //     $this->db->limit($limit);
            // }           
          $this->db->limit($limit,$page);
        }
        $query = $this->db->get(); 
        //print_r($this->db->last_query());//exit();
        if ($query) { 
          if ($single == TRUE) {
              return $query->row();
          } else {
              return $query->result();
          }
        } else { 
            return FALSE;
        }
    }

   public function custom_query($query){
       $query = $this->db->query($query);
       return $query->result_array();
   }
 

 
 

   public function read_conditionally($table,$id,$col){
       // echo "SELECT * FROM $table WHERE $col = '$id' ";exit();
       $query = $this->db->query("SELECT * FROM $table WHERE $col = '$id' ");
       return $query->result_array();
   }

   public function read_conditionally_officers($table,$where){
       // echo "SELECT * FROM $table WHERE $col = '$id' ";exit();
       $query = $this->db->query("SELECT * FROM $table " . $where);
       return $query->result_array();
   }

   public function insert($table,$data){
     if($this->db->insert($table,$data)){
       return $this->db->insert_id();
     }
     else{
         return  false;
      }
   }

   


  public  function update_query($tbl, $where, $data){
        $this->db->where($where);
        $this->db->update($tbl, $data);
        // print_r($this->db->last_query());exit();
        $affectedRows = $this->db->affected_rows();
        if ($affectedRows) {
            return TRUE;
        } else {
            return $this->db->error();
        }



    }

    //check duplicate 
    public function check_duplicate($table,$where){
     $data = $this->db->select('*')->where($where)->get($table);
     // print_r($this->db->last_query());exit();
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

   // delete record
  public function delete_data($table,$where){
    $this->db->where($where);
    $del=$this->db->delete($table);   
    return $del;
   }



}
