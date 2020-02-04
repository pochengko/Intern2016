<!-- Admin Category Model -->
<?php
class Category_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

/*CATEGORY*/
    public function get_category($classID = FALSE)
    {
        if ($classID === FALSE)//SELECT * FROM category WHERE className = 'className' ORDER BY classID DESC LIMIT 0,2
        {
            $query = $this->db->order_by('classID','ASC')->get_where('category', array('classState' => '0'),10,0);
            return $query->result_array();
        }
        $query = $this->db->get_where('category', array('classID' => $classID));
        return $query->row_array();
    }

    public function get_dropdown_list()
    {
      $this->db->from('category');
      $this->db->order_by('classID');
      $result = $this->db->get();
      $return = array();
      $return[''] = 'Select';
      if ($result->num_rows() > 0)
      {
        foreach ($result->result_array() as $row)
        {
          $return[$row['classID']] = $row['className'];
        }
      }
      return $return;
      }

    public function set_category()
    {
        $this->load->helper('url');
        $className = url_title($this->input->post('className'), 'dash', TRUE);
        $data = array(
          'className' => $this->input->post('className')
            );
            return $this->db->insert('category', $data);
    }

    public function edit_category($classID)
    {
        $this->load->helper('url');
        $data = array(
          'classID' => $this->input->post('classID'),
          'className' => $this->input->post('className')
        );
        $this->db->where('classID', $this->input->post('classID'));
        return $this->db->update('category', $data);
    }

    public function del_category($classID = FALSE)
    {
        if ($classID != FALSE)
        {
            return $this->db->delete('category', array('classID' => $classID));
        }
    }
}
