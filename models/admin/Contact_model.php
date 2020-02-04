<!-- Admin Contact_model -->
<?php

class Contact_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_contact($c_id = FALSE)
    {
        if ($c_id === FALSE)//SELECT * FROM news WHERE slug = 'slug' ORDER BY date_time DESC LIMIT 0,5
        {
            $query = $this->db->order_by('c_date_time','DESC')->get_where('contact', array('c_state' => '0'),20,0);
            return $query->result_array();
        }
        $query = $this->db->get_where('contact', array('c_id' => $c_id));
        return $query->row_array();
    }

    public function get_contact_rows()//取得新聞總筆數
    {
        $query = $this->db->get_where('contact',array('c_state' => '0'));
        return $query->num_rows();
    }

    public function page_contact($offset)//每頁顯示的新聞列表
    {//SELECT * FROM news WHERE newsState = '1' LIMIT $offset,5;
        $query = $this->db->order_by('c_date_time','DESC')->get_where('contact',array('c_state' => '0'),20,$offset);
        return $query->result_array();
    }

    public function del_contact($c_id = FALSE)
    {
        if ($c_id != FALSE)
        {
            return $this->db->delete('contact', array('c_id' => $c_id));
        }
    }

}
