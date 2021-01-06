<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DistrictHospital extends My_Controller { 
	public function index(){
	  $config = $this->pagination_setting();
		$config["base_url"] = base_url() ."DistrictHospital/index" ;
		$config["total_rows"] = $this->General_modal->num_rows("SELECT * FROM district_hospitals");
		$like=array();$where=array();
		$sql=' SELECT * FROM district_hospitals where 1 ';

		if($this->input->post('search')){  	     	    
	      if($this->input->post('dh_name')){
	     	 $like['dh_name'] = trim($this->input->post('dh_name'));
	     	 $sql .= " AND dh_name like '".$like['dh_name']."'";
	      } 

	      $config["total_rows"] = $this->General_modal->num_rows($sql);
	   }
	   // elseif ($this->session->flashdata('province_id')){        
    //     $where['district_hospitals.province_id'] = $this->session->flashdata('province_id');
    //     $sql .= " AND province_id =  '".$this->session->flashdata('province_id')."'";
    //     $config["total_rows"] = $this->General_modal->num_rows($sql);
    //     if($this->uri->segment(3)) { 
    //       $this->session->set_flashdata("province_id",$this->session->flashdata('province_id'));
    //     }
      // }

	   $this->pagination->initialize($config);
	   $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	   $data["links"] = $this->pagination->create_links(); 
	   $limit = $config['per_page']; 
	   // $jion = array(array(
	   // 	'table'=>'province',
	   // 	'condition'=>'province.province_id=district_hospitals.province_id',
	   // 	'type'=>'LEFT'
	   // ));
	   $data['districts'] = $this->General_modal->select_fields_where_like_join('district_office','*');
	   $data['district_hospitals'] = $this->General_modal->select_fields_where_like_join('district_hospitals','*','',$where,'','',$like,'','',$limit,$page);
      $this->show('district_hospitals/dist_listing',$data);
	}

	public function dist_insert()
	{
        //print_r($this->input->post());
        if($this->input->post('savedata')){
            $formdata['dh_name'] = $this->input->post('dh_name');
            $formdata['dh_id'] = $this->input->post('dh_id');
            $formdata['dh_focal_person'] = $this->input->post('dh_focal_person');
            $formdata['dh_phone'] = $this->input->post('dh_phone');
            $formdata['dh_latitude'] = $this->input->post('dh_latitude'); 
            $formdata['dh_longitude'] = $this->input->post('dh_longitude');
            $where = array('dh_name'=>$formdata['dh_name']);
            if ($this->General_modal->check_duplicate("district_hospitals",$where)){
            	$this->session->set_flashdata("duplicate","DistrictHospital Name already exist");
            	redirect('DistrictHospital');
            }
            else
            {
            	if($data['users'] = $this->General_modal->insert('district_hospitals',$formdata)){
                  $this->session->set_flashdata("success","Data upload succeefuly");
                }
                else
                {
                  $this->session->set_flashdata("error","Data upload Failed");                
                }
                redirect('DistrictHospital');
            }
        }
        else
        {
            echo "Form Not Submitted";
        }
	}

	// Edit organization dataTable
	public function dist_edit($param=null){
		//Ajax request for edit data
		// print_r($this->input->post());
		if($this->input->post()){

			$data['dh_name'] = $this->input->post('dh_name');
			$data['dh_latitude'] = $this->input->post('dh_latitude');			
			$data['dh_longitude'] = $this->input->post('dh_longitude');
			$data['dh_focal_person'] = $this->input->post('dh_focal_person');
			$data['dh_phone'] = $this->input->post('dh_phone');  
			$where =array('dh_name'=> $this->input->post('dh_name'),'dh_id !='=> $this->input->post('dh_id'));

			if ($this->General_modal->check_duplicate("district_hospitals",$where)){ 
				$this->session->set_flashdata("duplicate","duplicate data found");
                redirect('DistrictHospital');
            }

            else
            {
            	$where =array('dh_id'=> $this->input->post('dh_id'));
            	if($update = $this->General_modal->update_query('district_hospitals ',$where,$data)){
				  $this->session->set_flashdata("success","Data update succeefuly");
                  redirect('DistrictHospital');
			    }
            }
			
		}
		if ($param) {
			$select ='';
			$res=$this->General_modal->read_conditionally('district_hospitals',$param,'dh_id');
			foreach($res as $row){

				$data['dh_id']       = $row['dh_id'];
				$data['dh_name']     = $row['dh_name'];
				$data['dh_latitude']     = $row['dh_latitude'];
				$data['dh_phone']     = $row['dh_phone'];
				$data['dh_focal_person']     = $row['dh_focal_person']; 
				$data['dh_longitude']     = $row['dh_longitude'];
				 
			}
			$data['select'] = $select;
			echo json_encode($data);
		}

	}


}
