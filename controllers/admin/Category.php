<?php
/*Admin Category Controller*/
class Category extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('session');
    $this->logged_in();
    $this->load->model('admin/category_model');
    $this->load->model('admin/product_model');
  }

  public function index()
  {
    $data['admin_category'] = $this->category_model->get_category();//取得新聞清單，($set:第幾筆)
    $data['title'] = 'Admin_Category Archive';

    $this->load->view('templates/admin/header', $data);
    $this->load->view('templates/admin/side');
    $this->load->view('admin/category/index', $data);
  }

  public function create()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $data['title'] = 'Create a Category Item';

      $this->form_validation->set_rules('className', 'className', 'required');

      if ($this->form_validation->run() === FALSE)
      {
          $this->load->view('templates/admin/header', $data);
          $this->load->view('templates/admin/side');
          $this->load->view('admin/category/create');
      }
      else
      {
          $this->category_model->set_category();
          $this->load->view('templates/admin/header', $data);
          $this->load->view('templates/admin/side');
          $this->load->view('admin/category/success');
      }
    }

    public function logged_in()
    {
        $logged_in = $this->session->userdata('logged_in');
  		  if(!isset($logged_in) || $logged_in != true){
  			redirect('/fail');
        }
    }

    public function view($className = NULL)
    {
        $data['category_item'] = $this->category_model->get_category($className);
        if (empty($data['category_item']))
        {
            show_404();
        }
        $data['title'] = $data['category_item']['className'];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side');
        $this->load->view('admin/category/view', $data);
    }

    public function edit($classID = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['category_item'] = $this->category_model->get_category($classID);

        $data['title'] = 'Category Update';

        $this->form_validation->set_rules('classID', 'classID', 'required');
        $this->form_validation->set_rules('className', 'className', 'required');
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/category/edit', $data);
        }
        else
        {
            $this->category_model->edit_category($classID);
            $data['title'] = 'Success Page';
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/category/success');
        }
    }

    public function del($classID= NULL)
    {
      if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);

        $this->category_model->del_category($classID);

        $data['title'] = 'Success Page';
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side');
        $this->load->view('admin/category/success');
      } else {
        header("location: http://0711.pocheng.farwin.tw/fail");
      }
    }
}
