<?php
/*Admin Pages Controller*/
class Banner extends CI_Controller {

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
      $data['title'] = 'Banner';
      $data['banner'] = $this->pages_model->get_banner();

      $this->load->view('templates/admin/header', $data);
      $this->load->view('templates/admin/side');
      $this->load->view('admin/banner/index', $data);
    }

    public function view($bannerID = NULL)
    {
        $data['banner_item'] = $this->pages_model->get_banner($bannerID);
        if (empty($data['banner_item']))
        {
            show_404();
        }
        $data['title'] = $data['banner_item']['bannerName'];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side');
        $this->load->view('admin/banner/view', $data);
    }


    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a Banner Item';
        $data['error'] = '' ;

        $this->form_validation->set_rules('bannerPath', 'bannerPath', 'required');
        $this->form_validation->set_rules('bannerName', 'bannerName', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/banner/create');
        }
        else
        {
          //
          $config['upload_path']          = './img/banner/';
          $config['allowed_types']        = 'gif|jpg|png';
          $config['max_width']            = '1200';
          $config['max_height']           = '400';

          $this->load->library('upload', $config);

          if ( ! $this->upload->do_upload('userfile'))
          {
                  $error = array('error' => $this->upload->display_errors());
                  $this->load->view('templates/admin/header', $data);
                  $this->load->view('templates/admin/side');
                  $this->load->view('admin/banner/create', $error);
          }
          else
          {
                  $this->pages_model->set_banner();
                  $data = array('upload_data' => $this->upload->data());
                  $data2['title'] = 'Success Page';
                  $this->load->view('templates/admin/header', $data2);
                  $this->load->view('templates/admin/side');
                  $this->load->view('admin/banner/upload_success', $data);
          }
          //
        }
    }

    public function edit($bannerID = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        //Banner id
        $bannerID = $this->uri->segment(4);

        $data['banner_item'] = $this->pages_model->get_banner($bannerID);
        $data['error'] = '';

        $data['title'] = 'Banner Update';

        $this->form_validation->set_rules('bannerID', 'bannerID', 'required');
        $this->form_validation->set_rules('bannerPath', 'bannerPath', 'required');
        $this->form_validation->set_rules('bannerName', 'bannerName', 'required');
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/side');
            $this->load->view('admin/banner/edit', $data);
        }
        else
        {
          //
          $config['upload_path']          = './img/banner/';
          $config['allowed_types']        = 'gif|jpg|png';
          $config['max_width']            = '1200';
          $config['max_height']           = '400';

          $this->load->library('upload', $config);

          if ( ! $this->upload->do_upload('userfile'))
          {
                  $error = array('error' => $this->upload->display_errors());
                  $this->load->view('templates/admin/header', $data);
                  $this->load->view('templates/admin/side');
                  $this->load->view('admin/banner/edit', $error);
                  //redirect('admin/banner/edit/'.$bannerID.'');
          }
          else
          {
                  $this->pages_model->edit_banner($bannerID);
                  $data = array('upload_data' => $this->upload->data());
                  $data2['title'] = 'Success Page';
                  $this->load->view('templates/admin/header', $data2);
                  $this->load->view('templates/admin/side');
                  $this->load->view('admin/banner/upload_success', $data);
          }
          //
        }
    }

    public function del($bannerID = NULL)
    {
      if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);

        $this->pages_model->del_banner($bannerID);

        $data['title'] = 'Success Page';
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side');
        $this->load->view('admin/banner/success');

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
