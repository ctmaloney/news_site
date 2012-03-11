<?php
class News extends CI_Controller {
	
	public function __construct() {
		parent::__construct();		
		$this->load->model('news_model');
	}
	
  public function index() {
    $data['articles'] = $this->news_model->get_articles(5);

    $this->load->view('templates/header');
    $this->load->view('news/index', $data);
    $this->load->view('templates/footer');
  }
	
  //Display Article by url slug
  public function article($url_title) {
    $data['article'] = $this->news_model->get_article($url_title);
    if (empty($data['article'])) show_404();
    $entry_time = $data['article']['entry_time'];
    $data['prev'] = $this->news_model->get_prev($entry_time);
    $data['next'] = $this->news_model->get_next($entry_time);
    $this->load->view('templates/header');
    $this->load->view('news/article', $data);
    $this->load->view('templates/footer');
  }
	
  //Display Archives
  public function archives() {
    $data['articles'] = $this->news_model->get_articles();

    $this->load->view('templates/header');
    $this->load->view('news/index', $data);
    $this->load->view('templates/footer');
  }
	
	//Save when creating a new article or updating
  public function save($url_title="") {
    $this->load->helper('form');
    $this->load->library('form_validation');
    
    //editing, fetch data from db and adjust validation
    if($url_title!="") {
      $data['article'] = $this->news_model->get_article($url_title);
      if (empty($data['article'])) show_404();
      $this->form_validation->set_rules('url_title', 'URL Title', 'required');
    }
    
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('article', 'Content', 'required');
  
    if(!$this->form_validation->run()) { //failed validation
      if($url_title!="") { //if editing
        $this->load->view('templates/header');
        $this->load->view('news/edit', $data);
        $this->load->view('templates/footer');
      }
      else {
        $this->load->view('templates/header');
        $this->load->view('news/new');
        $this->load->view('templates/footer');
      }
    }
    else {
      if($this->input->post('id')==''){ //if new post
        $this->news_model->insert();
        $data['message']='Your post was created successfully.';
      }
      else {
        $this->news_model->update();
        $data['message']='Your post was updated successfully.';
      }
      $this->load->view('templates/header');
      $this->load->view('news/message', $data);
      $this->load->view('templates/footer');
    }    
  }
	
  public function delete($id=0) {
    if($id==0) show_404();
    $this->news_model->delete($id);
    $data['message']='Your post was deleted successfully.';
    $this->load->view('templates/header');
    $this->load->view('news/message', $data);
    $this->load->view('templates/footer');
  }
	
}

?>