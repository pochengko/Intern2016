<?php //admin news model
class News_model extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function get_news($id = FALSE)
    {
        if ($id === FALSE)//SELECT * FROM news WHERE slug = 'slug' ORDER BY date_time DESC LIMIT 0,5
        {
            $query = $this->db->order_by('date_time','DESC')->get_where('news', array('state' => '0'),11,0);
            return $query->result_array();
        }
        $query = $this->db->get_where('news', array('id' => $id));
        return $query->row_array();
    }

    public function get_news_rows()//取得新聞總筆數
    {
        $query = $this->db->get_where('news',array('state' => '0'));
        return $query->num_rows();
    }

    public function page_news($offset)//每頁顯示的新聞列表
    {//SELECT * FROM news WHERE newsState = '1' LIMIT $offset,5;
        $query = $this->db->order_by('date_time','DESC')->get_where('news',array('state' => '0'),11,$offset);
        return $query->result_array();
    }

    public function set_news()
    {
        $this->load->helper('url');
        $this->load->helper('date');
        $slug = url_title($this->input->post('title'), 'dash', TRUE);
        $now = time('UP8');
        $human = unix_to_human($now, TRUE, 'eu');
        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text'),
            'date_time' => $human
            );

            return $this->db->insert('news', $data);
    }

    public function edit_news($id)
    {
        $this->load->helper('date');
        $this->load->helper('url');
        $now = time('UP8');
        $human = unix_to_human($now, TRUE, 'eu');
        $data = array(
          'id' => $this->input->post('id'),
            'title' => $this->input->post('title'),
            'text' => $this->input->post('text'),
            'date_time' => $this->input->post('date_time')
            );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('news', $data);
    }

    public function del_news($id = FALSE)
    {
        if ($id != FALSE)
        {
            return $this->db->delete('news', array('id' => $id));
        }
    }

}
