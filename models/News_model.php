<?php
class News_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_news($id = FALSE)
    {
        if ($id === FALSE)//SELECT * FROM news WHERE id = 'id' ORDER BY date_time DESC LIMIT 0,4
        {
            $query = $this->db->order_by('date_time','DESC')->get_where('news', array('state' => '0'),3,0);
            return $query->result_array();
        }
        $query = $this->db->get_where('news', array('id' => $id));
        return $query->row_array();
    }

    public function get_news_rows() // 取得新聞總筆數
    {
      $query = $this->db->get_where('news', array('state' => '0'));
      return $query->num_rows();
    }

    public function page_news($offset) //每頁顯示的新聞，$offset:每頁第一篇新聞是第幾則
    {
      $query = $this->db->order_by('date_time', 'DESC')->get_where('news', array('state' => '0'),3,$offset);
      return $query->result_array();
    }
}
