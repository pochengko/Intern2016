<?php
class News extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('news_model');

    }

    public function index($set = NULL)//news index
    {
        $rows = $this->news_model->get_news_rows();//新聞總筆數
        $this->load->library("pagination");

        $config['base_url'] = 'http://0711.pocheng.farwin.tw/news/page';
        $config['total_rows'] = $rows;
        $config['per_page'] = 3;
        $config['num_links'] = 4;
        $config['first_url'] = site_url('news'); // 設置第一頁連結

        $this->pagination->initialize($config);

        $data['link'] = $this->pagination->create_links();
        $data['news'] = $this->news_model->page_news($set);//取得新聞清單，($set:第幾筆)
        $data['title'] = 'News';

        $this->load->view('templates/header', $data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($id = NULL)
    {
        $data['news_item'] = $this->news_model->get_news($id);
        if (empty($data['news_item']))
        {
            show_404();
        }
        $data['title'] = $data['news_item']['title'];

        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer');
    }
}
