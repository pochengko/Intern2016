<?php
class Category_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    /*public function get_category($classID = FALSE)
    {
        if ($classID === FALSE)//SELECT * FROM category WHERE className = 'className' ORDER BY classID DESC LIMIT 0,2
        {
            $query = $this->db->order_by('classID','ASC')->get_where('category', array('classState' => '0'));
            return $query->result_array();
        }
        $query = $this->db->get_where('category', array('className' => $className));
        return $query->row_array();
    }

    public function get_category_item($className = NULL)
    {
      if ($className === NULL)
      {
        $query = $this->db->oreder_by('p_id','DESC')->get_where('product', array('p_state' => '0'));
        return $query->result_array();
      }
      else
      {
        $query = $this->db->get_where('product', array('classID' => $classID));
        return $query->result_array();
      }
    }*/

}
