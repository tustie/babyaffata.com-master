<?php
class model_travel_post extends model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public $error;
	public $id;
	public $modified;
	
	public function save($post_title, $post_date, $post_content, $post_status, 
							$post_excerpt, $post_author_id, $post_password, 
							$comment_status, $post_categories, $post_tags, $id) {
		
		$this->error = NULL;
		
		$data['post_date'] 		= $post_date;
		$data['post_modified'] 	= date('Y-m-d H:i:s');
		$data['post_title'] 	= $post_title;
		$data['post_content'] 	= $post_content;
		$data['post_status']	= $post_status;
		$data['post_excerpt']	= $post_excerpt;
		$data['post_password']	= $post_password;
		$data['comment_status']	= $comment_status;
			
		//$cats['post_categories'] = $post_categories;
		//$tags['post_tags'] = $post_tags;

		if($id == NULL) { // saving
		
			$data['post_author_id']	= $post_author_id;
			$data['post_page'] 	= helper::getTag($post_title);

			if( $affectedRows = $this->db->insert('posts_travel', $data) ) {
				$this->id = $this->db->getLastInsertId();
				
				$this->saveCategories($this->id, $post_categories);
				$this->saveTags($this->id, $post_tags);
				
				$this->modified = $data['post_modified'];
				return true;
			} else $this->error = $this->db->getLastError();
			return false;
		} else { // updating
		
			$where['id'] = $id;
			$this->id = $id;
			$this->modified = $data['post_modified'];			
			if( $affected_rows = $this->db->update('posts_travel', $data, $where) ) {
				$this->saveCategories($this->id, $post_categories);
				$this->saveTags($this->id, $post_tags);
				return true;
			} else if( $this->error = $this->db->getLastError() ) {
				return false;
			}
			return true;
		}

	}
	
	private function saveCategories($post_id, $post_cats) {
		$pc = array();
		foreach($post_cats as $c)
			array_push($pc, "('".$post_id."','".$c."')");
		
		$sql = "INSERT IGNORE INTO posts_categories_travel VALUES ".implode(", ", $pc) ;
				
		return $this->db->query( $sql );
	}
	
	private function saveTags($post_id, $post_tags) {
		
		$this->db->query("DELETE FROM posts_tags_travel WHERE post_id = '".$post_id."'");
		if($post_tags) {
			$tag_tag = array();
			foreach($post_tags as $name) {
				$tag = helper::getTag($name);
				array_push($tag_tag, $tag);
				$this->db->query("INSERT IGNORE INTO tags_travel VALUES ('".$name."','".$tag."')");
			}
	
			$pt = array();
			foreach($tag_tag as $tag)
				array_push($pt, "('".$post_id."','".$tag."')");
			
			$sql = "INSERT IGNORE INTO posts_tags_travel VALUES ".implode(", ", $pt);
			
			return $this->db->query( $sql );
		} else return false;
	}
	
	public function getList($page = 1, $perpage = 10){
		$offset = ($page-1)*$perpage;
		
		$sql = "SELECT id, post_page, post_title, DATE_FORMAT(post_date, '%d/%m/%Y %H:%i') AS post_date, 
				DATE_FORMAT(post_modified, '%d/%m/%Y %H:%i') AS post_modified, 
				SUBSTRING(post_content, 1,100) AS post_content, 
				post_status, post_excerpt, post_author_id, post_password, 
				comment_status
				FROM posts_travel 
				ORDER BY id DESC 
				LIMIT $offset, $perpage ";
				
		$result = $this->db->getResults( $sql );
		return $result;
	}
	
	public function delete($id) {
		if($this->db->delete('posts_travel', array('id'=>$id)))
			return true;
		else $this->error = $this->db->getLastError();
		return false;
	}
	
	public function getPost($postid) {
		
		$columns = array("id", "post_page", "post_title", "DATE_FORMAT(post_date, '%d/%m/%Y') AS post_date", 
				"DATE_FORMAT(post_date, '%H:%i:%s') AS post_time", 
				"DATE_FORMAT(post_modified, '%d/%m/%Y %H:%i%s') AS post_modified", 
				"post_content", 
				"post_status", "post_excerpt", "post_author_id", "post_password", 
				"comment_status");
		
		$result = $this->db->select("posts_travel", $columns, array("id"=>$postid));
		if($result)
			return $result[0];
	}	
	
	public function getCategories($postid) {
		$sql = "SELECT ct.name AS name, ct.tag AS tag " .
				"FROM posts_categories_travel pct LEFT JOIN categories_travel ct ON pct.category_tag = ct.tag " .
				"WHERE pct.post_id = '".$postid."'";
		return $this->db->query( $sql );
	}
	
	public function getTags($postid) {
		$sql = "SELECT tt.name AS name, tt.tag AS tag " .
				"FROM posts_tags_travel ptt LEFT JOIN tags_travel tt ON ptt.tag_tag = tt.tag " .
				"WHERE ptt.post_id = '".$postid."'";
		return $this->db->query( $sql );
	}
}