<?
namespace Blog;

use Charon\Entity;
use Blog\Post;
use Blog\Tag;

class Tags extends Entity {
	/**
	 * @fk Blog\Tag
	 * @setterer setTag
	 */
	protected $tag;
	
	/**
	 * @fk Blog\Post
	 * @setter setPost
	 */
	protected $post;
	
	function getName() {
		return $this->post->id;
	}
	
	function setPost( Post $value ) {
		if ( (int)$value->id == 0 ) {
			throw new \InvalidArgumentException("Post's id should not be zero", 401);
		}
	
		$this->post = $value;
	}
	
	function setTag( Tag $value ) {
		if ( (int)$value->id == 0 ) {
			throw new \InvalidArgumentException("Tag's id should not be zero", 402);
		}
	
		$this->tag = $value;
	}
	
	function validate() {
		return true;
	}
}