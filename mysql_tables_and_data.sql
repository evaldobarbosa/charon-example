DROP TABLE IF EXISTS post;
DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS author;
DROP TABLE IF EXISTS tags;

CREATE TABLE post (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	title varchar(150) not null,
	contents text not null,
	created TIMESTAMP NOT NULL,
	author_id integer not null,
	PRIMARY KEY(id)
);

CREATE TABLE tag (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	name varchar(100) not null,
	PRIMARY KEY(id)
);

CREATE TABLE author (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	name varchar(100) not null,
	PRIMARY KEY(id)
);

CREATE TABLE tags (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	post_id integer not null,
	tag_id integer not null,
	PRIMARY KEY(id)
);

INSERT INTO tag (name) VALUES ('Main');
INSERT INTO tag (name) VALUES ('Geek');
INSERT INTO tag (name) VALUES ('Charon');
INSERT INTO tag (name) VALUES ('Uncategorized');

INSERT INTO author (name) VALUES ('Charon');
INSERT INTO author (name) VALUES ('Evaldo Barbosa');

INSERT INTO post (title, contents, created, author_id) VALUE (
	'First Look at Charon',
	'In Greek mythology, Charon or Kharon (/ˈkɛərɒn/ or /ˈkɛərən/; Greek Χάρων) is the ferryman of Hades who carries souls of the newly deceased across the rivers Styx and Acheron that divided the world of the living from the world of the dead. A coin to pay Charon for passage, usually an obolus or danake, was sometimes placed in or on the mouth of a dead person.[1] Some authors say that those who could not pay the fee, or those whose bodies were left unburied, had to wander the shores for one hundred years. In the catabasis mytheme, heroes – such as Heracles, Orpheus, Aeneas, Dante, Dionysus and Psyche – journey to the underworld and return, still alive, conveyed by the boat of Charon.',
	NOW(),
	1
);

INSERT INTO post (title, contents, created, author_id) VALUE (
	'Charon README',
	'<p>Is a tool created to retrieve data to your project from database. This is like any other ORM.</p>
<p>With Charon you will:</p>

<ul>
    <li>Create simple classes using annotations</li>
    <li>Load data with your classes</li>
    <li>Use semantic filters</li>
    <li>Get JSON without NoSQL</li>
</ul>

<h4>Composer:</h4>

<pre>
require: {
    "evaldobarbosa/charon": "0.1.*@dev"
}
</pre>

<h4>Usage:</h4>

<p>$conn = new PDO(\'your_dsn\');</p>

<p>$dl = new Charon\\Loader( $conn );</p>

<p>Filtering post with your tags and related author</p>

<pre>$dl->load(\'YourNamespace\Post\')
  ->join(\'tags->tag\')
  ->join(\'author\')
  ->equal(\'post->id\',999);
</pre>

<h4>Choosing output format</h4>

<h5>Using PHP Objects based on classes that you wrote</h5>

<pre>
  $rs = $dl->get();
</pre>

<h5>Using json</h5>
<pre>
  $rs = $dl->get(true);
</pre>
',
	NOW(),
	2
);

INSERT INTO tags (post_id,tag_id) values (1,1);
INSERT INTO tags (post_id,tag_id) values (1,2);
INSERT INTO tags (post_id,tag_id) values (1,3);

INSERT INTO tags (post_id,tag_id) values (2,1);
INSERT INTO tags (post_id,tag_id) values (2,3);