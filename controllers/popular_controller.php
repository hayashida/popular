<?php
/**
 * 人気ブログ コントローラー
 *
 * @author hayashida
 * @license MIT License
 */
class PopularController extends BaserPluginAppController
{
    var $name = 'Popular';
    var $uses = array('Popular.PopularBlog', 'Blog.BlogContent');
    var $helpers = array('Blog.Blog');

    /**
     * get_blogposts
     * @param $limit
     * @param $by_period
     * @param $blog_content_id
     * @return object
     */
    function get_blogposts($limit, $by_period, $blog_content_id)
    {
        $oneday = 60 * 60 * 24;

        $this->BlogContent->recursive = -1;
        $data['blogContent'] = $this->BlogContent->read(null, $blog_content_id);

        $to_at = strtotime(date('Y-m-d'));
        if ($by_period == '2') {
            $from_at = $to_at - ($oneday * 30);
        } else {
            $from_at = $to_at - ($oneday * 6);
        }

        $data['popularBlogs'] = $this->PopularBlog->find('all', array(
            'fields' => array(
                'PopularBlog.blog_id',
                'Sum(PopularBlog.count) As "count"',
                'BlogPost.*',
            ),
            'conditions' => array(
                'PopularBlog.blog_content_id' => $blog_content_id,
                'PopularBlog.date_at Between ? AND ?' => array(date('Y-m-d', $from_at), date('Y-m-d', $to_at))
            ),
            'limit' => $limit,
            'group' => array(
                'PopularBlog.blog_id'
            ),
            'order' => 'Sum(PopularBlog.count) Desc',
            'cache' => false
        ));

        return $data;
    }
}