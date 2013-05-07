<?php
/**
 * 人気ブログウィジェット
 *
 * @author hayashida
 * @license MIT License
 */

    if (empty($limit)) {
        $limit = 5;
    }

    $data = $this->requestAction('/popular/popular/get_blogposts/'.$limit.'/'.$by_period.'/'.$blog_content_id);
    $posts = $data['popularBlogs'];
    $blogContent = $data['blogContent'];
?>
<div class="widget widget-popular">
    <?php if ($name && $use_title): ?>
    <h2><?php echo $name; ?></h2>
    <?php endif ?>
    <ul>
        <?php foreach ($posts as $post): ?>
        <li>
            <?php $bcBaser->link(
                    $post['BlogPost']['name'],
                    array(
                        'admin' => false,
                        'plugin' => '',
                        'controller' => $blogContent['BlogContent']['name'],
                        'action' => 'archives',
                        $post['BlogPost']['no']
                    )); ?>
        </li>
        <?php endforeach ?>
    </ul>
</div>