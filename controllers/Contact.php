<?php defined('BASEPATH') or exit ('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('contact_model');
    }

    public function index()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        //
        // Load the library
        $this->load->library('recaptcha');

        // Catch the user's answer
        $captcha_answer = $this->input->post('g-recaptcha-response');

        // Verify user's answer
        $response = $this->recaptcha->verifyResponse($captcha_answer);

        $this->form_validation->set_rules('c_name', 'Name', 'required');
        $this->form_validation->set_rules('c_email', 'E-mail', 'required');
        $this->form_validation->set_rules('c_content', 'Content', 'required');

        $data['title'] = 'Coutact Us';

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('contact/index');
            $this->load->view('templates/footer');
        }
        else
        {
          // Processing ...
          if ($response['success']) {
            // Your success code here
            $this->contact_model->add_contact();
            $this->load->view('templates/header', $data);
            $this->load->view('contact/success');
            $this->load->view('templates/footer');

          } else {
            // Something goes wrong
            //var_dump($response);
            $this->load->view('templates/header', $data);
            $this->load->view('contact/index');
            $this->load->view('templates/footer');

          }
        }
    }
}
