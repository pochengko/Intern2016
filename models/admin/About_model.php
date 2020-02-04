<?php /*Admin About Model*/
class About_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_about($aboutID = FALSE)
    {
        if ($aboutID === FALSE)//SELECT * FROM about WHERE id = 'id' ORDER BY date_time DESC LIMIT 0,4
        {
            $query = $this->db->order_by('aboutID','DESC')->get_where('about');
            return $query->result_array();
        }
        $query = $this->db->get_where('about', array('aboutID' => $aboutID));
        return $query->row_array();
    }

    public function get_about_rows() // 取得關於總筆數
    {
      $query = $this->db->get_where('about');
      return $query->num_rows();
    }

    public function page_about($offset) //每頁顯示的新聞，$offset:每頁第一篇新聞是第幾則
    {
      $query = $this->db->order_by('aboutID', 'DESC')->get_where('about');
      return $query->result_array();
    }

    public function set_about()
    {
        $this->load->helper('url');
        $aboutTitle = url_title($this->input->post('aboutTitle'), 'dash', TRUE);
        $data = array(
            'aboutTitle' => $this->input->post('aboutTitle'),
            'aboutText' => $this->input->post('aboutText')
            );
            return $this->db->insert('about', $data);
    }

    public function edit_about($aboutID)
    {
        $this->load->helper('url');
        $data = array(
          'aboutID' => $this->input->post('aboutID'),
            'aboutTitle' => $this->input->post('aboutTitle'),
            'aboutText' => $this->input->post('aboutText'),
            'aboutState' => $this->input->post('aboutState')
            );

        $this->db->where('aboutID', $this->input->post('aboutID'));
        return $this->db->update('about', $data);
    }

    public function del_about($aboutID = FALSE)
    {
        if ($aboutID != FALSE)
        {
            return $this->db->delete('about', array('aboutID' => $aboutID));
        }
    }
}
