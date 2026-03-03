<?php
if (post_password_required()) {
    return;
}
?>

<div class="comments-area">

    <?php if (have_comments()) : ?>
        <h3>Комментарии (<?php echo get_comments_number(); ?>)</h3>

        <div class="comment-list">
            <?php
            wp_list_comments([
                'style' => 'div',
                'short_ping' => true,
                'avatar_size' => 60,
            ]);
            ?>
        </div>

    <?php endif; ?>

    <?php
    comment_form([
        'title_reply' => 'Оставить комментарий',
        'label_submit' => 'Отправить',
    ]);
    ?>

</div>