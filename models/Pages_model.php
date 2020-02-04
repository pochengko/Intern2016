<?php
class Pages_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_news()
    {//SELECT * FROM news WHERE slug = 'slug' ORDER BY date_time DESC LIMIT 0,4
        $query = $this->db->order_by('date_time','DESC')->get_where('news', array('state' => '0'),3,0);
        return $query->result_array();
    }

    public function get_home()
    {//SELECT * FROM news WHERE slug = 'slug' ORDER BY date_time DESC LIMIT 0,4
        $query = $this->db->order_by('homeID','DESC')->get_where('home', array('homeState' => '0'),1,0);
        return $query->result_array();
    }

    public function get_banner()
    {
      $query = $this->db->order_by('bannerID', 'DESC')->get_where('banner', array('bannerState' => '0'),1,0);
      return $query->result_array();
    }
}
