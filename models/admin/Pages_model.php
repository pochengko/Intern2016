<!--Admin Pages Model -->
<?php
class Pages_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    /* NEWS */
    public function get_news()
    {//SELECT * FROM news WHERE slug = 'slug' ORDER BY date_time DESC LIMIT 0,4
        $query = $this->db->order_by('date_time','DESC')->get_where('news', array('state' => '0'),3,0);
        return $query->result_array();
    }

    public function set_pages()
    {
        $this->load->helper('url');
        $aboutTitle = url_title($this->input->post('aboutTitle'), 'dash', TRUE);
        $data = array(
            'home' => $this->input->post('home')
            );
    }

    /* HOME_TEXT */
    public function get_home($homeID = FALSE)
    {
      if ($homeID === FALSE)//SELECT * FROM home WHERE homeState = '0' ORDER BY homeID DESC LIMIT 0,2
      {
          $query = $this->db->order_by('homeID','DESC')->get_where('home', array('homeState' => '0'),2,0);
          return $query->result_array();
      }
      $query = $this->db->get_where('home', array('homeID' => $homeID));
      return $query->row_array();
    }

    public function set_home()
    {
        $this->load->helper('url');
        $homeText = url_title($this->input->post('homeText'), 'dash', TRUE);
        $data = array(
            'homeText' => $this->input->post('homeText')
            );
            return $this->db->insert('home', $data);
    }

    public function edit_home($homeID)
    {
        $this->load->helper('url');
        $data = array(
          'homeID' => $this->input->post('homeID'),
          'homeText' => $this->input->post('homeText')
            );
        $this->db->where('homeID', $this->input->post('homeID'));
        return $this->db->update('home', $data);
    }

    public function del_home($homeID = FALSE)
    {
        if ($homeID != FALSE)
        {
            return $this->db->delete('home', array('homeID' => $homeID));
        }
    }

    /* BANNER */
    public function get_banner($bannerID = FALSE)
    {
      if ($bannerID === FALSE)
      {
          $query = $this->db->order_by('bannerID','DESC')->get_where('banner', array('bannerState' => '0'),4,0);
          return $query->result_array();
      }
      $query = $this->db->get_where('banner', array('bannerID' => $bannerID));
      return $query->row_array();
    }

    public function set_banner()
    {
        $this->load->helper('url');
        $data = array(
            'bannerPath' => $this->input->post('bannerPath'),
            'bannerName' => $this->input->post('bannerName')
            );
            return $this->db->insert('banner', $data);
    }

    public function edit_banner($bannerID)
    {
        $this->load->helper('url');
        $data = array(
          'bannerID' => $this->input->post('bannerID'),
          'bannerPath' => $this->input->post('bannerPath'),
          'bannerName' => $this->input->post('bannerName')
            );
        $this->db->where('bannerID', $this->input->post('bannerID'));
        return $this->db->update('banner', $data);
    }

    public function del_banner($bannerID = FALSE)
    {
        if ($bannerID != FALSE)
        {
            return $this->db->delete('banner', array('bannerID' => $bannerID));
        }
    }
}
