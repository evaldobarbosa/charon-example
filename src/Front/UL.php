<?php
namespace Front;

class UL {
	private $title;
	private $link;
	private $items = array();
	
	function __construct( $title, $link ) {
		$this->title = $title;
		$this->link = $link;
	}
	
	function addItem( $id, $title ) {
		$item = new \stdClass();
			$item->id = $id;
			$item->value = $title;
			
		$this->items[] = $item;
	}
	
	function render() {
		$str  = "<h1>{$this->title}</h1>";
		$str .= "<ul class=\"nav nav-pills\">";
		      	
		foreach( $this->items as $item ) {
			$str .= "<li class=\"item\">";
			$str .= "<a href=\"{$this->link}/{$item->id}\">{$item->value}</a>";
			$str .= "</li>";
		}
		$str .= "</ul>";
		
		return $str;
	}
	
	function __toString() {
		return $this->render();
	}
}