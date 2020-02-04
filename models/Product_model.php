<?php
class Product_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_category($className = FALSE)
    {
        if ($className === FALSE)//SELECT * FROM category WHERE className = 'className' ORDER BY classID DESC LIMIT 0,2
        {
            $query = $this->db->order_by('classID','ASC')->get_where('category', array('classState' => '0'));
            return $query->result_array();
        }
        $query = $this->db->get_where('category', array('className' => $className));
        return $query->row_array();
    }

    public function get_wool($p_name = FALSE)
    {
      if ($p_name === FALSE)
      {
        $query = $this->db->get_where('product', array('p_classID' => '1'));
        return $query->result_array();
      }
      $query = $this->db->get_where('product');
      return $query->row_array();
    }

    public function get_bracelet($p_name = FALSE)
    {
      if ($p_name === FALSE)
      {
        $query = $this->db->get_where('product', array('p_classID' => '2'));
        return $query->result_array();
      }
      $query = $this->db->get_where('product');
      return $query->row_array();
    }

    public function get_necklace($p_name = FALSE)
    {
      if ($p_name === FALSE)
      {
        $query = $this->db->get_where('product', array('p_classID' => '3'));
        return $query->result_array();
      }
      $query = $this->db->get_where('product');
      return $query->row_array();
    }

    public function get_product($p_id = FALSE)
    {
        if ($p_id === FALSE)//SELECT * FROM product WHERE p_name = 'p_name' ORDER BY p_id DESC LIMIT 0,2
        {
            $query = $this->db->order_by('p_id','ASC')->get_where('product', array('p_state' => '0'));
            return $query->result_array();
        }
        $query = $this->db->get_where('product', array('p_id' => $p_id));
        return $query->row_array();
    }

    public function get_product_rows() // 取得產品總筆數
    {
      $query = $this->db->get_where('product', array('p_state' => '0'));
      return $query->num_rows();
    }

    public function page_product($offset) //每頁顯示的產品，$offset:每頁第一篇產品是第幾則
    {
      $query = $this->db->order_by('p_id', 'ASC')->get_where('product', array('p_state' => '0'),6,$offset);
      return $query->result_array();
    }


}
