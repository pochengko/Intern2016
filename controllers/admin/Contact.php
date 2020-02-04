<?php
/*Admin Contact Controller*/
class Contact extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('session');
    $this->logged_in();
    $this->load->model('admin/contact_model');
  }

  public function index($set = NULL)
  {
    $rows = $this->contact_model->get_contact_rows();//新聞總筆數
    $this->load->library("pagination");

    $config['base_url'] = 'http://0711.pocheng.farwin.tw/admin/contact/page';
    $config['total_rows'] = $rows;
    $config['per_page'] = 20;
    $config['uri_segment'] = 4;
    $config['first_url'] = site_url('admin/contact/index'); // 設置第一頁連結
    //$config['use_page_numbers'] = TRUE;

    $this->pagination->initialize($config);

    $data['link'] = $this->pagination->create_links();
    $data['admin_contact'] = $this->contact_model->page_contact($set);//取得新聞清單，($set:第幾筆)
    $data['title'] = 'Admin_Contact Archive';

    $this->load->view('templates/admin/header', $data);
    $this->load->view('templates/admin/side');
    $this->load->view('admin/contact/index', $data);
  }

    public function logged_in()
    {
        $logged_in = $this->session->userdata('logged_in');
  		  if(!isset($logged_in) || $logged_in != true){
  			redirect('/fail');
        }
    }

    public function view($c_id = NULL)
    {
        $data['contact_item'] = $this->contact_model->get_contact($c_id);
        if (empty($data['contact_item']))
        {
            show_404();
        }
        $data['title'] = $data['contact_item']['c_name'];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side');
        $this->load->view('admin/contact/view', $data);
    }

    public function del($c_id = NULL)
    {
      if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);

        $this->contact_model->del_contact($c_id);

        $data['title'] = 'Success Page';
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side');
        $this->load->view('admin/contact/success');
      } else {
        header("location: http://0711.pocheng.farwin.tw/fail");
      }
    }

}
