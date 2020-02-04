<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('sms_model');
    }

    public function index()
    {
        //$this->load->library('sendsms');
        //$this->sendsms->send();
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Send Message';

        $this->form_validation->set_rules('sms_phone', 'Phone', 'required');

        $num="";              // rand後所存的地方
        $num_max = 4;      // 產生4個驗證碼
        for( $i=0; $i<$num_max; $i++ )
        {
          $num .= rand(0,9);
        }
        $sms_phone = $this->input->post('sms_phone');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('send/index');
            $this->load->view('templates/footer');
        }
        else
        {
            $this->load->helper('sendsms_helper');
            $this->load->library('session');
            $this->session->set_userdata('sms_check', $num);
            sendsms($sms_phone, $num);
            //$this->sms_model->send_sms($sms_phone,$num);
            $this->load->view('templates/header', $data);
            $this->load->view('send/index');
            $this->load->view('templates/footer');
        }
    }

    public function check($num = NULL)
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $data['title'] = 'Send Message';

      $sms_check = $this->input->post('sms_check', 'vcode', 'required');

      if ($this->form_validation->run() === FALSE)
      {
          $this->load->view('templates/header', $data);
          $this->load->view('send/index');
          $this->load->view('templates/footer');
      }




        $num = $this->session->userdata('sms_check');
        if($sms_check == $num)
        {
          echo $sms_check."=".$num;
          //$this->load->view('templates/header');
          //$this->load->view('pages/home');
          //$this->load->view('templates/footer');
        }
        else
        {
          echo $sms_check."X".$num;
          //$this->load->view('templates/header');
          //$this->load->view('send/index');
          //$this->load->view('templates/footer');
        }



    }
}
