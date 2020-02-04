<?php
class Pages extends CI_Controller {

    public function __construct() {
      parent::__construct();

      $this->load->helper('url');
      $this->load->model('pages_model');
    }

    public function view($page = 'home') {
        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php')) {
            //Whoops, we don't have a page fot that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['news_home'] = $this->pages_model->get_news();
        $data['home'] = $this->pages_model->get_home();
        $data['banner'] = $this->pages_model->get_banner();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }
}
