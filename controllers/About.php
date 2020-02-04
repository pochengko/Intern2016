<?php
class About extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('about_model');
    }

    public function index($aboutTitle = NULL)//about index
    {
        $data['about'] = $this->about_model->get_about();
        $data['text'] = $this->about_model->get_about_text($aboutTitle);
        $data['title'] = 'About';

        $this->load->view('templates/header', $data);
        $this->load->view('about/index', $data);
        $this->load->view('templates/footer');
    }

}
