<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tehsil extends My_Controller { 
	public function index(){
	  $config = $this->pagination_setting();
		$config["base_url"] = base_url() ."Tehsil/index" ;
		$config["total_rows"] = $this->General_modal->num_rows("SELECT * FROM tehsil");
		$like=array();$where=array();
		$sql=' SELECT * FROM tehsil where 1 ';

		if($this->input->post('search')){  	     	    
	      if($this->input->post('tehsil_name')){
	     	 $like['tehsil_name'] = trim($this->input->post('tehsil_name'));
	     	 $sql .= " AND tehsil_name like '".$like['tehsil_name']."'";
	      }if($this->input->post('dist_id')){ 
	     	 $where['tehsil.dist_id'] = trim($this->input->post('dist_id'));
	     	 $sql .= " AND tehsil.dist_id = '".$this->input->post('dist_id')."'";
	      }  

	      $config["total_rows"] = $this->General_modal->num_rows($sql);
	   } 

	   $this->pagination->initialize($config);
	   $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	   $data["links"] = $this->pagination->create_links(); 
	   $limit = $config['per_page']; 
	   $jion = array(array(
	   	'table'=>'district_office',
	   	'condition'=>'district_office.dist_id=tehsil.dist_id',
	   	'type'=>'LEFT'
	   ));
	   $data['tehsil'] = $this->General_modal->select_fields_where_like_join('tehsil','*',$jion,$where,'','',$like,'','',$limit,$page);
	   $data['districts'] = $this->General_modal->select_fields_where_like_join('district_office','*');
      $this->show('tehsil/listing',$data);
	}

	public function teh_insert()
	{ 
        if($this->input->post('savedata')){
            $formdata['tehsil_name'] = $this->input->post('tehsil_name');
            $formdata['dist_id'] = $this->input->post('dist_id');
            $where = array('tehsil_name'=>$formdata['tehsil_name'],'dist_id'=>$formdata['dist_id']);
            if ($this->General_modal->check_duplicate("tehsil",$where)){
            	$this->session->set_flashdata("duplicate","Tehsil Name already exist");
            	redirect('Tehsil');
            }
            else
            {
            	if($data['users'] = $this->General_modal->insert('tehsil',$formdata)){
                  $this->session->set_flashdata("success","Data upload succeefuly");
                }
                else
                {
                  $this->session->set_flashdata("error","Data upload Failed");                
                }
                redirect('Tehsil');
            }
        }
        else
        {
            echo "Form Not Submitted";
        }
	}

	// Edit organization dataTable
	public function teh_edit($param=null){ 
		if($this->input->post()){
			// echo "<pre>"; print_r($this->input->post());exit();
			$data['tehsil_name'] = $this->input->post('tehsil_name');
			$data['dist_id'] = $this->input->post('dist_id');
			$where =array('tehsil_name'=> $this->input->post('tehsil_name'),'dist_id'=> $this->input->post('dist_id'));

			if ($this->General_modal->check_duplicate("tehsil",$where)){ 
				$this->session->set_flashdata("duplicate","duplicate data found");
                redirect('Tehsil');
            }

            else
            {
            	$where =array('tehsil_id'=> $this->input->post('tehsil_id'));
            	if($update = $this->General_modal->update_query('tehsil ',$where,$data)){
				  $this->session->set_flashdata("success","Data update succeefuly");
                  redirect('Tehsil');
			    }
            }
			
		}
		if ($param) {
			$select ='';
			$res=$this->General_modal->read_conditionally('tehsil',$param,'tehsil_id');
			foreach($res as $row){
				$data['tehsil_id']       = $row['tehsil_id'];
				$data['dist_id']       = $row['dist_id'];
				$data['tehsil_name']     = $row['tehsil_name'];
				$district_office = $this->General_modal->select_fields_where_like_join('district_office ','*');
		        $select  .="<option value=''>"."Select"."</option>";
		        foreach($district_office as $district_office){
		          if ($district_office->dist_id == $row['dist_id']){
		             $selected ="selected";
		          }else{$selected='';} 
		          $select  .="<option $selected  value='".$district_office->dist_id."'>". $district_office->dist_name."</option>";
		        }
			}
			$data['select'] = $select;
			echo json_encode($data);
		}

	}


}
