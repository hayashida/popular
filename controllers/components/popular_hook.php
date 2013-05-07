<?php
/**
 * 人気ブログ コンポーネントフック
 * 
 * @author hayashida
 * @license MIT License
 */
class PopularHookComponent extends Object
{
    /**
     * 登録フック
     */
    var $registerHooks = array('beforeRender');

    /**
     * モデル
     */
    var $popularBlog = null;

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->popularBlog = ClassRegistry::init('Popular.PopularBlog');
    }

    /**
     * beforeRender
     * @param  $controller
     */
    function beforeRender($controller)
    {
        if ($controller->name != 'Blog') {
            return;
        }
        if ($controller->action != 'archives') {
            return;
        }

        $pass = $controller->params['pass'];
        if (!is_numeric($pass[0])) {
            return;
        }

        $today = date('Y-m-d');
        $post = $controller->viewVars['post'];

        $data = $this->popularBlog->find('first', array(
            'conditions' => array(
                'blog_id' => $post['BlogPost']['id'],
                'date_at' => $today
            )
        ));

        if (isset($data['PopularBlog'])) {
            $count = $data['PopularBlog']['count'] + 1;
            $this->popularBlog->id = $data['PopularBlog']['id'];
            $this->popularBlog->saveField('count', (int)$data['PopularBlog']['count'] + 1);
        } else {
            $this->popularBlog->set(array(
                'blog_id' => $post['BlogPost']['id'],
                'blog_content_id' => $post['BlogPost']['blog_content_id'],
                'count' => 1,
                'date_at' => $today
            ));
            $this->popularBlog->save();
        }
    }
}