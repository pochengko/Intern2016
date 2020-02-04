<?php
/*Admin User Controller*/
class User extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('session');
    $this->logged_in();
    $this->load->model('admin/user_model');
  }

  public function index($set = NULL)
  {
    $rows = $this->user_model->get_user_rows();//新聞總筆數
    $this->load->library("pagination");

    $config['base_url'] = 'http://0711.pocheng.farwin.tw/admin/user/page';
    $config['total_rows'] = $rows;
    $config['per_page'] = 20;
    $config['uri_segment'] = 4;
    $config['first_url'] = site_url('admin/user/index'); // 設置第一頁連結
    //$config['use_page_numbers'] = TRUE;

    $this->pagination->initialize($config);

    $data['link'] = $this->pagination->create_links();
    $data['admin_user'] = $this->user_model->page_user($set);//取得新聞清單，($set:第幾筆)
    $data['title'] = 'Admin_User Archive';

    $this->load->view('templates/admin/header', $data);
    $this->load->view('templates/admin/side');
    $this->load->view('admin/user/index', $data);
  }

  public function create()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $data['title'] = 'Create a User Item';

      $this->form_validation->set_rules('username', 'username', 'required');
      $this->form_validation->set_rules('password', 'password', 'required');

      if ($this->form_validation->run() === FALSE)
      {
          $this->load->view('templates/admin/header', $data);
          $this->load->view('templates/admin/side');
          $this->load->view('admin/user/create');
      }
      else
      {
          $this->user_model->set_user();
          $this->load->view('templates/admin/header', $data);
          $this->load->view('templates/admin/side');
          $this->load->view('admin/user/success');
      }
    }

    public function logged_in()
    {
        $logged_in = $this->session->userdata('logged_in');
  		  if(!isset($logged_in) || $logged_in != true){
  			redirect('/fail');
        }
    }

    public function view($username = NULL)
    {
        $data['user_item'] = $this->user_model->get_user($username);
        if (empty($data['user_item']))
        {
            show_404();
        }
        $data['title'] = $data['user_item']['username'];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side');
        $this->load->view('admin/user/view', $data);
    }

    public function edit($username = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['user_item'] = $this->user_model->get_user($username);

        $data['title'] = 'User Update';

        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/user/edit', $data);
        }
        else
        {
            $this->user_model->edit_user();
            $data['title'] = 'Success Page';
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/user/success');
        }
    }

    public function del($u_id = NULL)
    {

      if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);

        $this->user_model->del_user($u_id);

        $data['title'] = 'Success Page';
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side');
        $this->load->view('admin/user/success');

      } else {
        header("location: http://0711.pocheng.farwin.tw/fail");
      }
    }
}
