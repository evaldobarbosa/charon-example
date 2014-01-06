<?php
ini_set("display_errors","On");
ini_set("error_reporting",E_ALL);

date_default_timezone_set('America/Belem');

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Respect\Rest\header;
use Respect\Rest\Router;
use Charon\Loader as dl;
use Front\UL;

$db = new PDO(
    'mysql:host=localhost;port=3306;dbname=charon',
    'root',
    'root123',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
  );

$r = new Router;

$r->get('/', function() use ($db) {
  $dl = new dl($db);

  $dl->load('Blog\Post')
    ->join('author')
    ->desc('post->id');

  $posts = $dl->getAll();
  
  $first = current( $posts );
  
  unset( $posts[ $first->id ] );
  
  $dl->load('Blog\Author')
  	->join('posts');
  
  $authors = $dl->getAll();
  
  $dl->load('Blog\Tag')
  	->join('tags');
  
  $tags = $dl->getAll();
  
  include "view/index.php";
});

$r->get('/posts/', function() use ($db) {
	$dl = new dl($db);
	
	$dl->load('Blog\Post')
		->desc('post->id');
	
	$items = $dl->getAll();
	
	$list = new UL(
		"List of Posts",
		"/posts/read"
	);
	
	foreach ( $items as $value ) {
		$list->addItem(
			$value->id,
			$value->title
		);
	}

	include "view/list.php";
});

	$r->get('/posts/read/*', function($id) use ($db) {
		$dl = new dl($db);
	
		$dl->load('Blog\Post')
		->join('author')
		->equal("post->id",(int)$id)
		->desc('post->id');
	
		$post = $dl->get();
	
		include "view/read.php";
	});

$r->get('/authors/', function() use ($db) {
	$dl = new dl($db);

	$dl->load('Blog\Author')
		->join('posts')
		->desc('author->name');

	$items = $dl->getAll();
	
	$list = new UL(
		"List of Authors",
		"/authors/list"
	);
	
	foreach ( $items as $value ) {
		$list->addItem(
			$value->id,
			$value->name
		);
	}

	include "view/list.php";
});

	$r->get('/authors/list/*', function($id) use ($db) {
		$dl = new dl($db);

		$dl->load('Blog\Author')
			->join('posts')
			->equal("author->id",(int)$id);
		
		$author = $dl->get();
		
		$items = $author->posts;

		//return "<pre>" . print_r($author->posts,true) . "</pre>";
		
		$list = new UL(
			"{$author->name} - List of Posts",
			"/posts/read"
		);
		
		foreach ( $items as $value ) {
			$list->addItem(
				$value->id,
				$value->title
			);
		}
		
		include "view/list.php";
	});
	
$r->get('/tags/', function() use ($db) {
	$dl = new dl($db);

	$dl->load('Blog\Tag')
		->join('tags->post')
		->desc('tag->name');

	$items = $dl->getAll();
	
	$list = new UL(
		"List of Tags",
		"/tags/list"
	);
	
	foreach ( $items as $value ) {
		$list->addItem(
			$value->id,
			$value->name
		);
	}

	include "view/list.php";
});

	$r->get('/tags/list/*', function($id) use ($db) {
		$dl = new dl($db);

		$dl->load('Blog\Tag')
			->join('tags->post')
			->equal("tag->id",(int)$id);

		$tag = $dl->get();
		
		$list = new UL(
			"Posts under {$tag->name}",
			"/posts/read"
		);
		
		foreach ( $tag->tags as $value ) {
			$list->addItem(
				$value->post->id,
				$value->post->title
			);
		}
		
		include "view/list.php";
	});
	
$r->get('/about', function() {
	$post = new stdClass();
	$post->title = "Charon";
	$post->contents = "
		<h3>Charon a simple ORM.</h3>
		<p>Evaldo Barbosa</p>
		<address>evaldobarbosa@gmail.com<br/>São Luís (MA) - Brasil</address>
	";
	$post->created = '2013-06-01 00:00:00';
	$post->author = new stdClass();
	$post->author->name = "Evaldo Barbosa";
	
	include "view/read.php";
});

$r->get('/create_records', function() use ($db) {
	$tag = new Blog\Tag( $db );
		$tag->name = 'Open Project';
	$tag->save();
	
	header("Location: /");
});

$r->exceptionRoute('Exception', function (Exception $e) {
        return "<h3>Sorry, this error happened: </h3><p>{$e->getCode()} - {$e->getMessage()}</p>";
    });