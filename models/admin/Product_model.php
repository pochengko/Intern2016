<!-- Admin Product Model -->
<?php
class Product_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

/*PRODUCT*/
    public function get_product($p_id = FALSE)
    {
        if ($p_id === FALSE)//SELECT * FROM product WHERE slug = 'slug' ORDER BY date_time DESC LIMIT 0,5
        {
            $query = $this->db->order_by('p_id','DESC')->get_where('product', array('p_state' => '0'),11,0);
            return $query->result_array();
        }
        $query = $this->db->get_where('product', array('p_id' => $p_id));
        return $query->row_array();
    }

    public function get_product_rows()//取得新聞總筆數
    {
        $query = $this->db->get_where('product',array('p_state' => '0'));
        return $query->num_rows();
    }

    public function page_product($offset)//每頁顯示的新聞列表
    {//SELECT * FROM product WHERE productState = '1' LIMIT $offset,5;
        $query = $this->db->order_by('p_id','DESC')->get_where('product',array('p_state' => '0'),11,$offset);
        return $query->result_array();
    }

    public function set_product()
    {
        $this->load->helper('url');

        $keys = $this->input->post('field_name');
        $values = $this->input->post('field_value');
        $spec = array();
        foreach($keys as $key=>$value){
          $spec[$value] = $values[$key];
        }
        $data['p_spec'] = json_encode($spec,JSON_UNESCAPED_UNICODE);

        $data = array(
          'p_filepath' => $this->input->post('p_filepath'),
          'p_name' => $this->input->post('p_name'),
          'p_classID' => $this->input->post('p_classID'),
          'p_describe' => $this->input->post('p_describe'),
          'p_detail' => $this->input->post('p_detail'),
          'p_spec' => json_encode($spec,JSON_UNESCAPED_UNICODE)
        );
        return $this->db->insert('product', $data);
      }

    public function edit_product($p_id)
    {
        $this->load->helper('url');
        $keys = $this->input->post('field_name');
        $values = $this->input->post('field_value');
        $spec = array();
        foreach($keys as $key => $value){
          $spec[$value] = $values[$key];
        }
        $data['p_spec'] = json_encode($spec, JSON_UNESCAPED_UNICODE);

        $data = array(
          'p_id' => $this->input->post('p_id'),
          'p_filepath' => $this->input->post('p_filepath'),
          'p_name' => $this->input->post('p_name'),
          'p_classID' => $this->input->post('p_classID'),
          'p_describe' => $this->input->post('p_describe'),
          'p_detail' => $this->input->post('p_detail'),
          'p_spec' => json_encode($spec, JSON_UNESCAPED_UNICODE)
            );
        $this->db->where('p_id', $this->input->post('p_id'));
        return $this->db->update('product', $data);
    }

    public function del_product($p_id = FALSE)
    {
        if ($p_id != FALSE)
        {
            return $this->db->delete('product', array('p_id' => $p_id));
        }
    }
}
