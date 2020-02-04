<?php
class About_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_about($aboutID = FALSE)
    {
        if ($aboutID === FALSE)//SELECT * FROM about WHERE id = 'id' ORDER BY date_time DESC LIMIT 0,1
        {
            $query = $this->db->order_by('aboutID','ASC')->get_where('about', array('aboutState' => '1'));
            return $query->result_array();
        }
        $query = $this->db->get_where('about', array('aboutID' => $aboutID));
        return $query->row_array();
    }

    public function get_about_text($aboutTitle = NULL)
    {
      if ($aboutTitle === NULL)
      {
        $query = $this->db->order_by('aboutID','ASC')->get_where('about', array('aboutState' => '1'),1,0);
        return $query->result_array();
      }
      else
      {
        $query = $this->db->get_where('about', array('aboutTitle' => $aboutTitle),1,0);
        return $query->result_array();
      }
    }
  }
