<?php
class Contact_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function add_contact()
    {
        $this->load->helper('url');
        $this->load->helper('date');
        $c_name = url_title($this->input->post('c_name'), 'dash', TRUE);
        $now = time();
        $human = unix_to_human($now, TRUE, 'eu');
        $data = array(
            'c_email' => $this->input->post('c_email'),
            'c_name' => $this->input->post('c_name'),
            'c_content' => $this->input->post('c_content'),
            'c_date_time' => $human
            );
            return $this->db->insert('contact', $data);
    }
}
