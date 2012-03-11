<?php
class News_model extends CI_Model {
  
  public function __construct() {
    $this->load->database();
  }
  
  //Get article by slug
  public function get_article($url_title) {
    $query = $this->db->get_where('news',array('url_title' => $url_title));
    return $query->row_array();
  }
	
  //Get all articles
  public function get_articles($limit = 0) {
    if($limit!=0) $this->db->limit($limit);
    $this->db->order_by('entry_time','desc');
    $query = $this->db->get('news');
    return $query->result_array();
  }
	
  //create a new article
  public function insert() {
    $this->load->helper('url');
    $this->load->helper('date');
    $url_title = url_title($this->input->post('title'),'dash',TRUE);

    $data = array(
      'entry_time' => gmt_to_local(local_to_gmt(now()),'UM6'),  //convert server time to central timezone
      'title' => $this->input->post('title'),
      'url_title' => $url_title,
      'article' => $this->input->post('article')
    );
    return $this->db->insert('news', $data);
  }
	
  //update and existing article
  public function update() {
    $id = $this->input->post('id');
    $data = array(
     'title' => $this->input->post('title'),
     'url_title' => $this->input->post('url_title'),
     'article' => $this->input->post('article')
    );
    $this->db->where('id', $id);
    return $this->db->update('news', $data);
  }
	
  //delete an article
  public function delete($id) {
    return $this->db->delete('news', array('id' => $id)); 
  }
	
  //Get the previous article
  public function get_prev($entry_time) {
    $this->db->order_by('entry_time','desc');
    $this->db->limit(1);
    $query = $this->db->get_where('news',array('entry_time <' => $entry_time));
    return $query->row_array();
  }
	
  //Get the next article
  public function get_next($entry_time) {
    $this->db->order_by('entry_time','asc');
    $this->db->limit(1);
    $query = $this->db->get_where('news',array('entry_time >' => $entry_time));
    return $query->row_array();
  }
}

?>