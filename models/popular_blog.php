<?php
/**
 * 人気ブログ モデル
 * 
 * @author hayashida
 * @license MIT License
 */

App::import('Model', 'BaserPluginAppModel');

class PopularBlog extends BaserPluginAppModel
{
    var $name = 'PopularBlog';
    var $plugin = 'Popular';

    var $belongsTo = array(
        'BlogPost' => array(
            'className' => 'Blog.BlogPost',
            'foreignKey' => 'blog_id',
        ),
    );
}