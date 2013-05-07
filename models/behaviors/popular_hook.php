<?php
/**
 * 人気ブログ ビヘイビアフック
 *
 * @author hayashida
 * @license MIT License
 */
class PopularHookBehavior extends ModelBehavior
{
    var $registerHooks = array(
        'BlogPost' => array('afterDelete'),
        'BlogContent' => array('afterDelete'),
    );

    /**
     * afterDelete
     * @param $model
     */
    function afterDelete($model)
    {
        $popularModel = ClassRegistry::init('Popular.PopularBlog');
        $popularModel->recursive = -1;

        if ($model->alias == 'BlogPost') {
            $posts = $popularModel->find('all', array(
                'conditions' => array(
                    'PopularBlog.blog_id' => $model->id,
                ),
            ));

            if ($posts) {
                foreach ($posts as $post) {
                    $popularModel->delete($post['PopularBlog']['id']);
                }
            }
        }

        if ($model->alias == 'BlogContent') {
            $posts = $popularModel->find('all', array(
                'conditions' => array(
                    'PopularBlog.blog_content_id' => $model->id,
                ),
            ));

            if ($posts) {
                foreach ($posts as $post) {
                    $popularModel->delete($post['PopularBlog']['id']);
                }
            }
        }
    }
}