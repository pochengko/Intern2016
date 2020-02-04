<?php
class Sms_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function send_sms($sms_phone = NULL, $num = NULL)
    {
        $this->load->helper('url','sendsms_helper');

        $data = array(
            'sms_phone' => $this->input->post('sms_phone'),
            'sms_body' => $num
            );

            return $this->db->insert('sms', $data);
    }
}
