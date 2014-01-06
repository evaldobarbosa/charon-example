<?
namespace Blog;

use Charon\Entity;
use Blog\Author;

class Post extends Entity {
	protected $title;
	protected $contents;
	protected $created;

	/**
	* @fk Blog\Author
	* @setter setAuthor
	*/
	protected $author;
	
	/**
	 * @rk Blog\Tags
	 * @adder addTags
	 */
	protected $tags;
	
	function getName() {
		return $this->title;
	}
	
	function addTags( Post $value ) {
		if ( (int)$value->id == 0 ) {
			throw new \InvalidArgumentException("Tag's id should not be zero", 1);
		}
	
		$this->tags[ $value->id ] = $value;
	}

	function setAuthor( Author $value ) {
		if ( (int)$value->id == 0 ) {
			throw new \InvalidArgumentException("Author's id should not be zero", 1);			
		}

		$this->author = $value;
	}

	function validate() {
		return true;
	}
}