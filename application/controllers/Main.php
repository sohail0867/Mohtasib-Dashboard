<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {
    public function index() {     
        $this->show('index');
    }
    
     

    public function delete_file() {
        $base_dir    = realpath($_SERVER["DOCUMENT_ROOT"]);
        $file_delete = "$base_dir/" . $this->input->get('file_path');
        unlink($file_delete);
    }
    public function profile() {
        $where = array(
            "ad_id" => $this->session->userdata('ad_id')
        );
        if ($this->input->post()) {
            $upd_data['ad_email'] = $this->input->post('ad_email');
            $upd_data['ad_uname'] = $this->input->post('ad_uname');
            if ($this->input->post('ad_password')) {
                if ($this->input->post('ad_password') == $this->input->post('cf_ad_password')) {
                    $upd_data['ad_password'] = sha1("WK*&%&" . $this->input->post('ad_password'));
                } else {
                    $this->session->set_flashdata("error", "Password not matched");
                    redirect('Main/profile');
                }
            }
            if ($this->General_modal->update_query('admin_user ', $where, $upd_data)) {
                $this->session->set_flashdata("success", "success");
                redirect('Main/profile');
            }
        }
        $data['profile'] = $this->General_modal->select_fields_where_like_join('admin_user', '*', '', $where);
        $this->show("general_files/profile", $data);
    }
}