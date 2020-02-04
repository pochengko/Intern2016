<?php
class Category extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('product_model');
    }

    public function index($className = NULL)//category index
    {
      $data['category'] = $this->category_model->get_category();
      $data['cateitem'] = $this->product_model->get_product();
      //$data['category'] = $this->category_model->get_category();
      //Load the view in advance and pass to the other view. First put this in the controller:
      // the "TRUE" argument tells it to return the content, rather than display it immediately
      //$data['category'] = $this->load->view('product/category', NULL, TRUE);
      //$this->load->view('product/index', $data);

        /*$data['title'] = 'category archive';

        $this->load->view('templates/header', $data);
        $this->load->view('product/index', $data);
        $this->load->view('templates/footer');*/
    }


}
