<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Firebase extends MY_Controller {

    public $title;
    public $description;
    public $short_description;
    public $date;
    public $file_name;
    public $file_type; 


	//Firebase notification setting
    public function send($to, $message) {
        $fields = array(
            'to' => $to,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }

    // Sending message to a topic by topic name
    public function sendToTopic($to, $message) {
        $fields = array(
            'to' => '/topics/' . $to,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }

    // sending push message to multiple users by firebase registration ids
    public function sendMultiple($registration_ids, $message) {
        $fields = array(
            'to' => $registration_ids,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }

    // function makes curl request to firebase servers
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

    public function setNotif_type($notif_type) {
        $this->notif_type = $notif_type;
    }
    public function setTitle($title) {
        $this->title = $title;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function setShortDescription($shortDescription) {
        $this->short_description = $shortDescription;
    }
    public function setDate($date) {
        $this->date = $date;
    }
    public function filename($name){
    	return $this->file_name = $name;
    }
    public function file_type($type){
    	return $this->file_type = $type;
    }
    


    public function getPush() {
        $res = array();
        if($this->notif_type != ''){$res['data']['notif_type'] = $this->notif_type;} 
        if($this->title != ''){$res['data']['title'] = $this->title;} 
        if($this->description != ''){$res['data']['description'] = $this->description;}
        if($this->short_description != ''){$res['data']['short_description'] = $this->short_description;}
        if($this->date != ''){$res['data']['date'] = $this->date;}
        if($this->file_name != ''){ $res['data']['filename'] = $this->file_name;}
        if($this->file_type != ''){ $res['data']['file_type'] = $this->file_type;}
    return $res;

    }

    //End Firebase notification setting

}