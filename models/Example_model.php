<?php
class Example_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function facebook_submit($id = NULL, $name = NULL, $email = NULL)
    {
        $data = array(
            'fb_id' => $id,
            'username' => $name,
            'email' => $email
            );

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($data);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 0)
        {
            $this->db->insert('user', $data);

            if ($this->db->affected_rows() > 0)
            {
                return true;
            }
        }
        else
        {
            return false;
        }

    }
}
