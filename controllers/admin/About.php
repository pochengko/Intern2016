<?php
/*Admin About Controller*/
class About extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->logged_in();
        $this->load->database();
        $this->load->model('admin/about_model');
    }

    public function index($set = NULL, $aboutID = NULL)//about index
    {
        $rows = $this->about_model->get_about_rows();//新聞總筆數
        $this->load->library("pagination");

        $config['base_url'] = 'http://0711.pocheng.farwin.tw/admin/about/page';
        $config['total_rows'] = $rows;
        $config['per_page'] = 4;
        $config['first_url'] = site_url('admin/about/index'); // 設置第一頁連結
        //$config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $data['link'] = $this->pagination->create_links();
        $data['admin_about'] = $this->about_model->page_about($set);//取得新聞清單，($set:第幾筆)
        $data['title'] = 'Admin_About Archive';

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side');
        $this->load->view('admin/about/index', $data);
    }

    public function view($aboutID = NULL)
    {
        $data['about_item'] = $this->about_model->get_about($aboutID);
        if (empty($data['about_item']))
        {
            show_404();
        }
        $data['title'] = $data['about_item']['aboutTitle'];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side');
        $this->load->view('admin/about/view', $data);
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a About Item';

        $this->form_validation->set_rules('aboutTitle', 'aboutTitle', 'required');
        $this->form_validation->set_rules('aboutText', 'aboutText', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/about/create');
        }
        else
        {
            $this->about_model->set_about();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/about/success');
        }
    }

    public function edit($aboutID = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['about_item'] = $this->about_model->get_about($aboutID);

        $data['title'] = 'About Update';

        $this->form_validation->set_rules('aboutID', 'aboutID', 'required');
        $this->form_validation->set_rules('aboutTitle', 'aboutTitle', 'required');
        $this->form_validation->set_rules('aboutText', 'aboutText', 'required');
        $this->form_validation->set_rules('aboutState', 'aboutState', 'required');
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/about/edit', $data);
        }
        else
        {
            $this->about_model->edit_about($aboutID);
            $data['title'] = 'Success Page';
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/about/success');
        }
    }

    public function del($aboutID = NULL)
    {

      if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);

        $this->about_model->del_about($aboutID);

        $data['title'] = 'Success Page';
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side');
        $this->load->view('admin/about/success');

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
