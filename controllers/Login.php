<?php

//session_start(); //we need to start session in order to acess it through CI

class Login extends CI_Controller {

  public function __construct() {
    parent::__construct();

    // Load form helper library
    $this->load->helper('form');

    // Load form validation library
    $this->load->library('form_validation');

    // Load session library
    //$this->load->library('session');

    // Load database
    $this->load->model('login_model');
  }

  // Show login page
  public function index() {

    if($this->session->userdata('logged_in'))
    {
      redirect('login/user_login_process');//('admin/products')
    }
    else
    {
      $data['title'] = 'Login Page';

      //$this->load->view('templates/header', $data);
      $this->load->view('login/login_form');//('/login')
      //$this->load->view('templates/footer');
    }
  }

  /*//encrypt the password
  function __encryp_password($password) {
    return md5($password);
  }*/

  // Show registration page
  public function user_registration_show() {

    $data['title'] = 'Sign Up';

    //$this->load->view('templates/header', $data);
    $this->load->view('login/registration_form');
    //$this->load->view('templates/footer');
  }

  // Validate and store registration data in database
  public function new_user_registration() {

    // Check validation for user input in SignUp form
    $this->form_validation->set_rules('username', 'Username', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    if ($this->form_validation->run() == FALSE) {

      $data['title'] = 'Sign Up';
      //$this->load->view('templates/header', $data);
      $this->load->view('login/registration_form');
      //$this->load->view('templates/footer');

    } else {
      $data = array(
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password')
      );
      $result = $this->login_model->registration_insert($data);
      if ($result == TRUE) {
        $data['title'] = 'Sign Up Check';
        $data2['message_display'] = 'Registration Successfully !';

        //$this->load->view('templates/header', $data);
        $this->load->view('login/login_form', $data2);
        //$this->load->view('templates/footer');
      } else {
        $data['title'] = 'Sign Up Check';
        $data2['message_display'] = 'Username already exist!';

        //$this->load->view('templates/header', $data);
        $this->load->view('login/registration_form', $data2);
        //$this->load->view('templates/footer');
      }
    }
  }

  // Check for user login process
  public function user_login_process() {
    $this->form_validation->set_rules('username', 'Username', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      if (isset($this->session->userdata['logged_in'])) {
        $data['title'] = 'Logged !';
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/side', $data);
        $this->load->view('login/admin_page');
      } else {
        $data['title'] = 'Login Check';
        //$this->load->view('templates/header', $data);
        $this->load->view('login/login_form');
        //$this->load->view('templates/footer');
      }
    } else {
      $data = array(
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password')
      );
      $result = $this->login_model->login($data);
      if ($result == TRUE) {
        $username = $this->input->post('username');
        $result = $this->login_model->read_user_information($username);
        if ($result != false) {
          $data['title'] = 'Login Check';
          $session_data = array(
            'username' => $result[0]->username,
          );

          // Add user data in session
          $this->session->set_userdata('logged_in', $session_data);
          $this->load->view('templates/admin/header', $data);
          $this->load->view('templates/admin/side', $data);
          $this->load->view('login/admin_page');
        }
      } else {
        $data['title'] = 'Login Check';
        $data2 = array(
          'error_message' => 'Invalid Username or Password'
        );

        //$this->load->view('templates/header', $data);
        $this->load->view('login/login_form', $data2);
        //$this->load->view('templates/footer');
      }
    }
  }


  // Logout from admin page
  public function logout() {
    // Removing session data
    $sess_array = array(
      'username' => ''
    );
    $this->session->unset_userdata('logged_in', $sess_array);
    $data['title'] = 'Logout';
    $data2['message_display'] = 'Successfully Logout';
    //$this->load->view('templates/header', $data);
    $this->load->view('login/login_form', $data2);
    //$this->load->view('templates/footer');
  }
}
?>
