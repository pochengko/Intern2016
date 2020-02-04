<?php
/*Admin News Controller*/
class News extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('session');
    $this->logged_in();
    $this->load->model('admin/news_model');
  }

  public function index($set = NULL)
  {
    $rows = $this->news_model->get_news_rows();//新聞總筆數
    $this->load->library("pagination");

    $config['base_url'] = 'http://0711.pocheng.farwin.tw/admin/news/page';
    $config['total_rows'] = $rows;
    $config['per_page'] = 11;
    $config['uri_segment'] = 4;
    $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
    $config['first_url'] = site_url('admin/news/index'); // 設置第一頁連結

    //$config['use_page_numbers'] = TRUE;

    $this->pagination->initialize($config);

    $data['link'] = $this->pagination->create_links();
    $data['admin_news'] = $this->news_model->page_news($set);//取得新聞清單，($set:第幾筆)
    $data['title'] = 'Admin_News Archive';

    $this->load->view('templates/admin/header', $data);
    $this->load->view('templates/admin/side', $data);
    $this->load->view('admin/news/index', $data);
  }

  public function create()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $data['title'] = 'Create a News Item';

      $this->form_validation->set_rules('title', 'title', 'required');
      $this->form_validation->set_rules('text', 'text', 'required');

      if ($this->form_validation->run() === FALSE)
      {
          $this->load->view('templates/admin/header', $data);
          $this->load->view('templates/admin/side');
          $this->load->view('admin/news/create');
      }
      else
      {
          $this->news_model->set_news();
          $this->load->view('templates/admin/header', $data);
          $this->load->view('templates/admin/side');
          $this->load->view('admin/news/success');
      }
    }

    public function logged_in()
    {
        $logged_in = $this->session->userdata('logged_in');
  		  if(!isset($logged_in) || $logged_in != true){
  			redirect('/fail');
        }
    }

    public function view($id = NULL)
    {
        $data['news_item'] = $this->news_model->get_news($id);
        if (empty($data['news_item']))
        {
            show_404();
        }
        $data['title'] = $data['news_item']['title'];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side');
        $this->load->view('admin/news/view', $data);
    }

    public function edit($id = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['news_item'] = $this->news_model->get_news($id);
        $data['title'] = 'News Update';

        $this->form_validation->set_rules('id', 'id', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('text', 'text', 'required');
        $this->form_validation->set_rules('date_time', 'date_time', 'required');
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/news/edit', $data);
        }
        else
        {
            $this->news_model->edit_news($id);
            $data['title'] = 'Success Page';
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/news/success');
        }
    }

    public function del($id = NULL)
    {

      if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);

        $this->news_model->del_news($id);

        $data['title'] = 'Success Page';
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side');
        $this->load->view('admin/news/success');
      } else {
        header("location: http://0711.pocheng.farwin.tw/fail");
      }
    }
}
