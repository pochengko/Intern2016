<?php //admin user model
class User_model extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function get_user($username = FALSE)
    {
        if ($username === FALSE)//SELECT * FROM user WHERE u_state = '0' ORDER BY u_id DESC LIMIT 0,20
        {
            $query = $this->db->order_by('u_id','DESC')->get_where('user', array('u_state' => '0'),20,0);
            return $query->result_array();
        }
        $query = $this->db->get_where('user', array('username' => $username));
        return $query->row_array();
    }

    public function get_user_rows()//取得用戶總筆數
    {
        $query = $this->db->get_where('user',array('u_state' => '0'));
        return $query->num_rows();
    }

    public function page_user($offset)//每頁顯示的用戶列表
    {//SELECT * FROM user WHERE u_state = '0' LIMIT $offset,20;
        $query = $this->db->order_by('u_id','DESC')->get_where('user',array('u_state' => '0'),20,$offset);
        return $query->result_array();
    }

    public function set_user()
    {
        $this->load->helper('url');
        $username = url_title($this->input->post('username'), 'dash', TRUE);
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            );
            return $this->db->insert('user', $data);
    }

    public function edit_user()
    {
        $this->load->helper('url');
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
            );
        $this->db->where('username', $this->input->post('username'));
        return $this->db->update('user', $data);
    }

    public function del_user($u_id = FALSE)
    {
        if ($u_id != FALSE)
        {
            return $this->db->delete('user', array('u_id' => $u_id));
        }
    }

}
