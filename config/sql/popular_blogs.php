<?php 
/* SVN FILE: $Id$ */
/* PopularBlogs schema generated on: 2013-05-07 20:05:45 : 1367927625*/
class PopularBlogsSchema extends CakeSchema {
	var $name = 'PopularBlogs';

	var $file = 'popular_blogs.php';

	var $connection = 'plugin';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $popular_blogs = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'blog_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'blog_content_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'count' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'date_at' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
}
?>