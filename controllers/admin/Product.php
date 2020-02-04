<?php
/*Admin Product Controller*/
class Product extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->load->library('session');
    $this->logged_in();
    $this->load->model('admin/product_model');
    $this->load->model('admin/category_model');
  }

  public function index($set = NULL)
  {
    $rows = $this->product_model->get_product_rows();//新聞總筆數
    $this->load->library("pagination");

    $config['base_url'] = 'http://0711.pocheng.farwin.tw/admin/product/page';
    $config['total_rows'] = $rows;
    $config['per_page'] = 11;
    $config['uri_segment'] = 4;
    $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
    $config['first_url'] = site_url('admin/product/index'); // 設置第一頁連結
    //$config['use_page_numbers'] = TRUE;

    $this->pagination->initialize($config);

    $data['link'] = $this->pagination->create_links();
    $data['admin_product'] = $this->product_model->page_product($set);//取得新聞清單，($set:第幾筆)
    $data['title'] = 'Admin_Product Archive';

    $this->load->view('templates/admin/header', $data);
    $this->load->view('templates/admin/side');
    $this->load->view('admin/product/index', $data);
  }

  public function view($p_id = NULL)
  {
      $data['product_item'] = $this->product_model->get_product($p_id);
      if (empty($data['product_item']))
      {
          show_404();
      }
      $data['title'] = $data['product_item']['p_name'];
      $data['spec'] = json_decode($data['product_item']['p_spec']);

      $this->load->view('templates/admin/header', $data);
      $this->load->view('templates/admin/side');
      $this->load->view('admin/product/view', $data);
  }

  public function create()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $data['title'] = 'Create a Product Item';
      $data['category_list'] = $this->category_model->get_dropdown_list();
      $data['error'] = '';

      $this->form_validation->set_rules('p_filepath', 'p_filepath', 'required');
      $this->form_validation->set_rules('p_name', 'p_name', 'required');
      $this->form_validation->set_rules('p_classID', 'p_classID', 'required');
      $this->form_validation->set_rules('p_describe', 'p_describe', 'required');
      $this->form_validation->set_rules('p_detail', 'p_detail', 'required');

      if ($this->form_validation->run() === FALSE)
      {
          $this->load->view('templates/admin/header', $data);
          $this->load->view('templates/admin/side');
          $this->load->view('admin/product/create', $data);
      }
      else
      {
          //
          $config['upload_path']          = './img/product/';
          $config['allowed_types']        = 'gif|jpg|png';

          $this->load->library('upload', $config);

          if ( ! $this->upload->do_upload('userfile'))
          {
                  $error = array('error' => $this->upload->display_errors());
                  $this->load->view('templates/admin/header', $data);
                  $this->load->view('templates/admin/side');
                  $this->load->view('admin/product/create', $error);
          }
          else
          {
                  $this->product_model->set_product();
                  $data = array('upload_data' => $this->upload->data());
                  $data2['title'] = 'Success Page';
                  $this->load->view('templates/admin/header', $data2);
                  $this->load->view('templates/admin/side');
                  $this->load->view('admin/product/upload_success', $data);
          }
          //
      }
    }

    public function edit($p_id = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        //product id
        $p_id = $this->uri->segment(4);

        $data['product_item'] = $this->product_model->get_product($p_id);
        $data['spec'] = json_decode($data['product_item']['p_spec']);
        $data['title'] = 'Product Update';
        $data['category_list'] = $this->category_model->get_dropdown_list();
        $data['error'] = '' ;

        $this->form_validation->set_rules('p_filepath', 'p_filepath', 'required');
        $this->form_validation->set_rules('p_name', 'p_name', 'required');
        $this->form_validation->set_rules('p_classID', 'p_class', 'required');
        $this->form_validation->set_rules('p_describe', 'p_describe', 'required');
        $this->form_validation->set_rules('p_detail', 'p_detail', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/product/edit', $data);
        }
        else
        {
          $config['upload_path']          = './img/product/';
          $config['allowed_types']        = 'gif|jpg|png';

          $this->load->library('upload', $config);

          if ( ! $this->upload->do_upload('userfile'))
          {
                  $error = array('error' => $this->upload->display_errors());
                  $this->load->view('templates/admin/header', $data);
                  $this->load->view('templates/admin/side');
                  $this->load->view('admin/product/edit', $error);
                  //redirect('admin/product/edit/'.$p_id.'');
          }
          else
          {
                  $data2['title'] = 'Success Page';
                  $this->product_model->edit_product($p_id);
                  $data = array('upload_data' => $this->upload->data());
                  $this->load->view('templates/admin/header', $data2);
                  $this->load->view('templates/admin/side');
                  $this->load->view('admin/product/upload_success', $data);
          }
        }
      }

    public function del($p_id = NULL)
    {
      if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);

        $this->product_model->del_product($p_id);

        $data['title'] = 'Success Page';

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side');
        $this->load->view('admin/product/success');

      } else {
        header("location: http://0711.pocheng.farwin.tw/fail");
      }
    }

    public function logged_in()
    {
        $logged_in = $this->session->userdata('logged_in');
  		  if(!isset($logged_in) || $logged_in != true){
  			redirect('/fail');
        }
    }
}
