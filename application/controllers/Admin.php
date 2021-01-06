 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends My_Controller {
	public function index(){ 
		$data['admins'] = $this->General_modal->select_fields_where_like_join('admin_user','*');
        $this->show('admin/admin_listing',$data);
	}

	public function admin_insert(){
        //print_r($this->input->post());
        if($this->input->post('savedata')){
            $where ="ad_uname ='".$this->input->post('ad_uname')."' ";
            if ($this->General_modal->check_duplicate("admin_user",$where)){ 
                $this->session->set_flashdata("duplicate","Same username already exist"); 
            }
            else{
                $formdata['ad_uname'] = $this->input->post('ad_uname'); 
                $formdata['ad_email'] = $this->input->post('ad_email'); 
                $formdata['ad_contact'] = $this->input->post('ad_contact'); 
                $formdata['ad_password'] =  sha1("WK*&%&".$this->input->post('ad_password'));
                if($data['users'] = $this->General_modal->insert('admin_user',$formdata)){
                    $this->session->set_flashdata("success","Data upload succeefuly");
                }else{
                   $this->session->set_flashdata("error","Data upload Failed"); 
                }
            }
            redirect('Admin');
            
        }else{
            echo "Form Not Submitted";
        }
	}


	 

 // Edit admin dataTable
	public function admin_edit($param=null){ 
		if($this->input->get()){
            $where ="ad_uname ='".$this->input->get('e_ad_uname')."' AND ad_id !='".$this->input->get('e_ad_id')."' ";
            if ($this->General_modal->check_duplicate("admin_user",$where)){ 
                $this->session->set_flashdata("duplicate","Update Failed :: Same data Exist");
                redirect('Admin'); 
            }
			$id = $this->input->get('e_ad_id'); 
        	$data['ad_uname'] = $this->input->get('e_ad_uname');
            $data['ad_email'] = $this->input->get('e_ad_email'); 
            $data['ad_contact'] = $this->input->get('e_ad_contact'); 
           
            if (!empty($this->input->get('e_ad_password'))) { 
             $data['ad_password'] =  sha1("WK*&%&".$this->input->get('e_adm_password'));
            }
            // echo "<pre>"; print_r($this->input->get());exit();
        	$where =array('ad_id'=>$id);
			if($update = $this->General_modal->update_query('admin_user ',$where,$data)){
				$this->session->set_flashdata("success","Stations Assgin to Admin Officer Successfuly");
                redirect('Admin');  
			}
		}
       if ($param) {
    	$select =''; $data=array();
        $select_admin ='';
        $res=$this->General_modal->read_conditionally('admin_user',$param,'ad_id');
        foreach($res as $row){
        	$data['ad_id']       = $row['ad_id']; 
        	$data['ad_uname'] = $row['ad_uname']; 
            $data['ad_email'] = $row['ad_email']; 
            $data['ad_contact'] = $row['ad_contact'];   
        }
        echo json_encode($data);
      }

	}

	public function delete(){
        $num=0;
        $table = $this->input->get('table');
        if (!empty($table)) { 
            if ( $table == 'rescue_districts') {
             $num = $this->General_modal->num_rows("SELECT * FROM rescue_stations WHERE dist_id='".$this->input->get('id')."'");
            }
            else if ( $table == 'rescue_adv_category') {
             $num = $this->General_modal->num_rows("SELECT * FROM rescue_adv_alerts WHERE adv_cat_id='".$this->input->get('id')."'");
            }
            else if ( $table == 'rescue_organizations') {
              $officers = $this->General_modal->num_rows("SELECT * FROM rescue_organization_officers WHERE org_id='".$this->input->get('id')."'");
              $stationss = $this->General_modal->num_rows("SELECT * FROM rescue_stations WHERE org_id='".$this->input->get('id')."'");
              $num = $officers + $stationss;
            }
        }
        

        if ($num > 0) {
            $res['success'] ='2';
            echo json_encode($res); 
        }


        else{
            $id = $this->input->get('id');
            $table = $this->input->get('table');
            $col = $this->input->get('col');
            if($this->General_modal->delete_rec($table,$id,$col)){
                $res['success'] ='1';
                echo json_encode($res);
            }
        }
		
	}
}
?>
