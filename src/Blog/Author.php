<?
namespace Blog;

use Charon\Entity;
use Blog\Post;

class Author extends Entity {
	protected $name;

	/**
	* @rk Blog\Post
	* @adder addPost
	*/
	protected $posts;
	
	function getName() {
		return $this->name;
	}

	function addPost( Post $value ) {
		if ( (int)$value->id == 0 ) {
			throw new \InvalidArgumentException("Post's id should not be zero", 1);			
		}

		$this->posts[ $value->id ] = $value;
	}

	function validate() {
		return true;
	}
}