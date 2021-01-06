<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class API_Model extends CI_Model{  
  // General select query to select * data from table without any condition 
  public function fetch_all($table){
     $query = $this->db->query("select * from $table");
     if (!$query) {
         $response['message']='error in sql query';
         $response['success']='201';
         echo json_encode($response); exit();
     }else{
      return $query->result_array();
     }
       
   }    
   public function num_rows($query){
       // echo $query; 
       $query = $this->db->query($query); 
       $num_rows =  $query->num_rows();
       return $num_rows;
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

   public function update_query($tbl, $where, $data){
      $this->db->where($where);
      $this->db->update($tbl, $data);
      // print_r($this->db->last_query());  exit();
      $affectedRows = $this->db->affected_rows();
      if ($affectedRows) {
          return true;
      }else{
          return $this->db->error();
      }
    }

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

