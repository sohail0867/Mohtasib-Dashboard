<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller {

    private $title;
    private $description;
    private $date; 
    public $data = array();
    public $formdata = array();
    public $divHeeadStyle;
    public $loged_org_id;
    public function __construct(){        
        date_default_timezone_set('Asia/Karachi');
        parent::__construct(); 
        $this->CI =& get_instance(); 
        $dataX = array();  
        $dataX['divHeeadStyle'] = "padding: 10px 50px; border-radius: 2px 2px;"; 
        $this->CI->load->vars($dataX); 
        $this->loged_org_id = $this->session->userdata('org_id') ; 
        $this->load->model('General_modal');
        if (!$this->session->userdata('ad_id')){
            redirect('Auth/login');
        } 
    }
    
    public function Get_spesifc_row($table='',$column='',$id=''){
        if($data = $this->General_modal->Fetch_specific_row($table,$column,$id)){
            return $data;
        }
    }
    
    public function Get_Custome_query($query=''){
        if($data = $this->General_modal->custom_query($query)){
            return $data;
        }
    }
    
    public function DateWithTime($date){
        return $date = date ("d M Y g:i:s A" , strtotime ($date));
    }
    public function returnDate($date){
        return $date = date ("d M Y" , strtotime ($date));
    }
    public function Count_rows($query=''){
        // echo $query;
        return $this->General_modal->num_rows($query);
    }

    public function pagination_setting(){
        $config = array();
        $this->load->library("pagination");
        $config["uri_segment"] = 3;

        $config['per_page'] = 20;        
        $config['reuse_query_string'] = true;
        $config['full_tag_open'] = '<ul class="pagination justify-content-end pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link'];
         
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
         
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
         
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
         
        $config['prev_link'] = '&larr; Prev';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
         
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
         
        $config['anchor_class'] = 'follow_link';
        return $config;
    }
    function show($viewPath, $viewData = array()){      
        

        $this->load->view('includes/inc_head',$viewData);
        $this->load->view('includes/inc_header',$viewData);
        $this->load->view('includes/inc_sidebar_menu',$viewData);
        $this->load->view($viewPath, $viewData);
        $this->load->view('includes/inc_footer',$viewData);
    }

    function fetch_fromView($query){
       return $result = $this->General_modal->custom_query($query);
    }

}
?>