<?php
/*Admin Pages Controller*/
class Pages extends CI_Controller {

    public function __construct() {
      parent::__construct();

      $this->load->helper('url');
      $this->load->library('session');
      $this->logged_in();
      $this->load->database();
      $this->load->model('admin/pages_model');

    }

    public function index()
    {
      $data['title'] = 'Home';
      $data['news_home'] = $this->pages_model->get_news();
      $data['home'] = $this->pages_model->get_home();

      $this->load->view('templates/admin/header', $data);
      $this->load->view('templates/admin/side', $data);
      $this->load->view('admin/page/index', $data);
    }

    /* HOME_TEXT */
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a Home Item';

        $this->form_validation->set_rules('homeText', 'homeText', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/page/create');
        }
        else
        {
            $this->pages_model->set_home();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/page/success');
        }
    }

    public function edit($homeID = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['home_item'] = $this->pages_model->get_home($homeID);

        $data['title'] = 'Home Update';

        $this->form_validation->set_rules('homeID', 'homeID', 'required');
        $this->form_validation->set_rules('homeText', 'homeText', 'required');
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/page/edit', $data);
        }
        else
        {
            $this->pages_model->edit_home($homeID);
            $data['title'] = 'Success Page';
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/page/success');
        }
    }

    public function del($homeID = NULL)
    {
      if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);

        $this->pages_model->del_home($homeID);

        $data['title'] = 'Success Page';
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side');
        $this->load->view('admin/page/success');
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
