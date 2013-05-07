<?php
/**
 * 人気ブログ 管理用ウィジェット
 *
 * @author hayashida
 * @license MIT License
 */

    $title = '人気ブログ';
    $description = 'アクセスが多いブログを表示します';

    $data_period = array(
        1 => '週',
        2 => '月'
    );
?>
<?php echo $bcForm->label($key.'.limit', '表示数'); ?>&nbsp;
<?php echo $bcForm->text($key.'.limit', array('size' => 6)); ?>&nbsp;件<br />
<?php echo $bcForm->label($key.'.by_period', '取得期間'); ?>&nbsp;
<?php echo $bcForm->select($key.'.by_period',
            $data_period, null, null, false); ?><br />
<?php echo $bcForm->label($key.'.blog_content_id', 'ブログ'); ?>
<?php echo $bcForm->select($key.'.blog_content_id',
            $bcForm->getControlSource('Blog.BlogContent.id'), null, null, false); ?><br />
