<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class District extends My_Controller { 

	public function csv(){
		 $file = fopen("http://localhost/mustahiq/assets/Mansehra.csv", "r"); 
		while ($data = fgetcsv ($file)){ 
		     $importSQL = "INSERT INTO local_zakat_council (dist_id,lzc_name,lzc_chairman,lzc_phone)   VALUES('".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."')";
    		 $this->db->query($importSQL);
		}
      
	}
	public function index(){
    
  
	  $config = $this->pagination_setting();
		$config["base_url"] = base_url() ."District/index" ;
		$config["total_rows"] = $this->General_modal->num_rows("SELECT * FROM district_office");
		$like=array();$where=array();
		$sql=' SELECT * FROM district_office where 1 ';

		if($this->input->post('search')){  	     	    
	      if($this->input->post('dist_name')){
	     	 $like['dist_name'] = trim($this->input->post('dist_name'));
	     	 $sql .= " AND dist_name like '".$like['dist_name']."'";
	      }if($this->input->post('dist_phone')){
	      	$this->session->set_flashdata('dist_phone','dist_phone');
	     	$where['district_office.dist_phone'] = trim($this->input->post('dist_phone'));
	     	$sql .= " AND dist_phone = '".trim($this->input->post('dist_phone'))."'";
	      }if($this->input->post('dist_officer_name')){
	      	$this->session->set_flashdata('dist_officer_name','dist_officer_name');
	     	$where['district_office.dist_officer_name'] = trim($this->input->post('dist_officer_name'));
	     	$sql .= " AND dist_officer_name = '".trim($this->input->post('dist_officer_name'))."'";
	      } 

	      $config["total_rows"] = $this->General_modal->num_rows($sql);
	   }
	 

	   $this->pagination->initialize($config);
	   $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	   $data["links"] = $this->pagination->create_links(); 
	   $limit = $config['per_page']; 
	   // $jion = array(array(
	   // 	'table'=>'province',
	   // 	'condition'=>'province.dist_phone=district_office.dist_phone',
	   // 	'type'=>'LEFT'
	   // ));
	   $data['districts'] = $this->General_modal->select_fields_where_like_join('district_office','*','',$where,'','',$like,'','',$limit,$page);
      $this->show('district/dist_listing',$data);
	}


	public function localZakatCommitte(){
	  $config = $this->pagination_setting();
		$config["base_url"] = base_url() ."District/localZakatCommitte" ;
		$config["total_rows"] = $this->General_modal->num_rows("SELECT * FROM local_zakat_council");
		$like=array();$where=array();
		$sql=' SELECT * FROM local_zakat_council where 1 ';

		if($this->input->post('search')){  	     	    
	      if($this->input->post('dist_name')){
	     	 $like['dist_name'] = trim($this->input->post('dist_name'));
	     	 $sql .= " AND dist_name like '".$like['dist_name']."'";
	      }if($this->input->post('dist_phone')){
	      	$this->session->set_flashdata('dist_phone','dist_phone');
	     	$where['local_zakat_council.dist_phone'] = trim($this->input->post('dist_phone'));
	     	$sql .= " AND dist_phone = '".trim($this->input->post('dist_phone'))."'";
	      }if($this->input->post('dist_officer_name')){
	      	$this->session->set_flashdata('dist_officer_name','dist_officer_name');
	     	$where['local_zakat_council.dist_officer_name'] = trim($this->input->post('dist_officer_name'));
	     	$sql .= " AND dist_officer_name = '".trim($this->input->post('dist_officer_name'))."'";
	      } 

	      $config["total_rows"] = $this->General_modal->num_rows($sql);
	   }
	 

	   $this->pagination->initialize($config);
	   $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	   $data["links"] = $this->pagination->create_links(); 
	   $limit = $config['per_page']; 
	   $jion = array(
		   array(
		   	'table'=>'district_office',
		   	'condition'=>'district_office.dist_id=local_zakat_council.dist_id',
		   	'type'=>'LEFT'
		   ),array(
		   	'table'=>'tehsil',
		   	'condition'=>'tehsil.tehsil_id=local_zakat_council.tehsil_id',
		   	'type'=>'LEFT'
		   )
	   );
	   $data['districts'] = $this->General_modal->select_fields_where_like_join('district_office','*');
	   $data['tehsil'] = $this->General_modal->select_fields_where_like_join('tehsil','*');
	   $data['local_zakat_council'] = $this->General_modal->select_fields_where_like_join('local_zakat_council','*',$jion,$where,'','',$like,'','',$limit,$page);
	   // echo "<pre>";print_r($data);exit();
      $this->show('district/localZakatCommitte',$data);
	}

	public function commite_insert()
	{
        print_r($this->input->post());
        if($this->input->post('savedata')){
            $formdata['lzc_name'] = $this->input->post('lzc_name');
            $formdata['lzc_chairman'] = $this->input->post('lzc_chairman');
            $formdata['lzc_phone'] = $this->input->post('lzc_phone');
            $formdata['dist_id'] = $this->input->post('dist_id');
            $formdata['tehsil_id'] = $this->input->post('tehsil_id'); 
            
        	if($data['users'] = $this->General_modal->insert('local_zakat_council',$formdata)){
              $this->session->set_flashdata("success","Data upload succeefuly");
            }
            else
            {
              $this->session->set_flashdata("error","Data upload Failed");                
            }
            redirect('District/localZakatCommitte'); 
        }
        else
        {
            echo "Form Not Submitted";
        }
	}public function dist_insert()
	{
        //print_r($this->input->post());
        if($this->input->post('savedata')){
            $formdata['dist_name'] = $this->input->post('dist_name');
            $formdata['dist_officer_name'] = $this->input->post('dist_officer_name');
            $formdata['dist_phone'] = $this->input->post('dist_phone');
            $formdata['dist_no_lzc'] = $this->input->post('dist_no_lzc');
            $formdata['dist_chairman_name'] = $this->input->post('dist_chairman_name');
            $formdata['dist_chairman_phone'] = $this->input->post('dist_chairman_phone');
            $formdata['dist_latitude'] = $this->input->post('dist_latitude');
            $formdata['dist_longitude'] = $this->input->post('dist_longitude');
            $where = array('dist_name'=>$formdata['dist_name']);
            if ($this->General_modal->check_duplicate("district_office",$where)){
            	$this->session->set_flashdata("duplicate","District Name already exist");
            	redirect('District');
            }
            else
            {
            	if($data['users'] = $this->General_modal->insert('district_office',$formdata)){
                  $this->session->set_flashdata("success","Data upload succeefuly");
                }
                else
                {
                  $this->session->set_flashdata("error","Data upload Failed");                
                }
                redirect('District');
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

			$data['dist_name'] = $this->input->post('dist_name');
			$data['dist_no_lzc'] = $this->input->post('dist_no_lzc');
			$data['dist_officer_name'] = $this->input->post('dist_officer_name');
			$data['dist_phone'] = $this->input->post('dist_phone');
			$data['dist_officer_name'] = $this->input->post('dist_officer_name');
			$data['dist_officer_name'] = $this->input->post('dist_officer_name');
			$data['dist_chairman_name'] = $this->input->post('dist_chairman_name');
            $data['dist_chairman_phone'] = $this->input->post('dist_chairman_phone');
			$data['dist_longitude'] = $this->input->post('dist_longitude');
			$where =array('dist_name'=> $this->input->post('dist_name'),'dist_id !='=> $this->input->post('dist_id'));

			if ($this->General_modal->check_duplicate("district_office",$where)){ 
				$this->session->set_flashdata("duplicate","duplicate data found");
                redirect('District');
            }

            else
            {
            	$where =array('dist_id'=> $this->input->post('dist_id'));
            	if($update = $this->General_modal->update_query('district_office ',$where,$data)){
				  $this->session->set_flashdata("success","Data update succeefuly");
                  redirect('District');
			    }
            }
			
		}
		if ($param) {
			$select ='';
			$res=$this->General_modal->read_conditionally('district_office',$param,'dist_id');
			foreach($res as $row){

				$data['dist_id']       = $row['dist_id'];
				$data['dist_name']     = $row['dist_name'];
				$data['dist_no_lzc']     = $row['dist_no_lzc'];
				$data['dist_phone']     = $row['dist_phone'];
				$data['dist_chairman_name']     = $row['dist_chairman_name'];
				$data['dist_chairman_phone']     = $row['dist_chairman_phone'];
				$data['dist_officer_name']     = $row['dist_officer_name'];
				$data['dist_latitude']     = $row['dist_latitude'];
				$data['dist_longitude']     = $row['dist_longitude'];
				 
			}
			$data['select'] = $select;
			echo json_encode($data);
		}

	}


}
