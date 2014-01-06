<?
namespace Blog;

use Charon\Entity;
use Blog\Tags;

class Tag extends Entity {
	protected $name;

	/**
	* @rk Blog\Tags
	* @adder addTags
	*/
	protected $tags;
	
	function getName() {
		return $this->name;
	}

	function addTags( Tags $value ) {
		if ( (int)$value->id == 0 ) {
			throw new \InvalidArgumentException("Tag's id should not be zero", 301);			
		}

		$this->tags[ $value->id ] = $value;
	}

	function validate() {
		return true;
	}
}