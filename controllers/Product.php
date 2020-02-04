<?php
class Product extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('product_model');

    }

    public function index($set = NULL)//product index
    {
      $rows = $this->product_model->get_product_rows();
      $this->load->library("pagination");

      $config['base_url'] = 'http://0711.pocheng.farwin.tw/product/page';
      $config['total_rows'] = $rows;
      $config['per_page'] = 6;
      $config['num_links'] = 4;
      $config['first_url'] = site_url('product');

      $this->pagination->initialize($config);

      $data['link'] = $this->pagination->create_links();
      $data['product'] = $this->product_model->page_product($set);//取得產品清單，($set:第幾筆)

      $data['category'] = $this->product_model->get_category();

        $data['title'] = 'Product';

        $this->load->view('templates/header', $data);
        $this->load->view('product/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($p_id = NULL)
    {
        $data['product_item'] = $this->product_model->get_product($p_id);
        if (empty($data['product_item']))
        {
            show_404();
        }
        $data['category'] = $this->product_model->get_category();
        $data['title'] = $data['product_item']['p_name'];
        $data['spec'] = json_decode($data['product_item']['p_spec']);

        $this->load->view('templates/header', $data);
        $this->load->view('product/view', $data);
        $this->load->view('templates/footer');
    }

    public function wool($p_name = NULL)
    {
      $data['product_wool'] = $this->product_model->get_wool();
      $data['product_item'] = $this->product_model->get_product();
      if (empty($data['product_item']))
      {
        show_404();
      }
      $data['category'] = $this->product_model->get_category();
      $data['title'] = 'Wool';

      $this->load->view('templates/header', $data);
      $this->load->view('product/view_wool', $data);
      $this->load->view('templates/footer');
    }

    public function bracelet($p_name = NULL)
    {
      $data['product_bracelet'] = $this->product_model->get_bracelet();
      $data['product_item'] = $this->product_model->get_product();
      if (empty($data['product_item']))
      {
        show_404();
      }
      $data['category'] = $this->product_model->get_category();
      $data['title'] = 'Bracelet';

      $this->load->view('templates/header', $data);
      $this->load->view('product/view_bracelet', $data);
      $this->load->view('templates/footer');
    }

    public function necklace($p_name = NULL)
    {
      $data['product_necklace'] = $this->product_model->get_necklace();
      $data['product_item'] = $this->product_model->get_product();
      if (empty($data['product_item']))
      {
        show_404();
      }
      $data['category'] = $this->product_model->get_category();
      $data['title'] = 'Necklace';

      $this->load->view('templates/header', $data);
      $this->load->view('product/view_necklace', $data);
      $this->load->view('templates/footer');
    }

}
