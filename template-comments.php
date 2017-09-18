<?php if (comments_open()) : ?>

<section id="respond">

    <div class="alert alert-warning">
        <strong>The discussion will be displayed after you leave your first reply.</strong>
    </div>
  <h3><?php comment_form_title(__('Leave a Reply', 'Hide_Then_Show_Comments'), __('Leave a Reply to %s', 'Hide_Then_Show_Comments')); ?></h3>
  <p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
  <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
    <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'Hide_Then_Show_Comments'), wp_login_url(get_permalink())); ?></p>
<?php else : ?>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
      <?php if (is_user_logged_in()) : ?>
        <p>
          <?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'Hide_Then_Show_Comments'), get_option('siteurl'), $user_identity); ?>
          <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'Hide_Then_Show_Comments'); ?>"><?php _e('Log out &raquo;', 'Hide_Then_Show_Comments'); ?></a>
      </p>
  <?php else : ?>
    <div class="form-group">
      <label for="author"><?php _e('Name', 'Hide_Then_Show_Comments'); if ($req) _e(' (required)', 'Hide_Then_Show_Comments'); ?></label>
      <input type="text" class="form-control required" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" <?php if ($req) echo 'aria-required="true"'; ?>>
  </div>
  <div class="form-group">
      <label for="email"><?php _e('Email (will not be published)', 'Hide_Then_Show_Comments'); if ($req) _e(' (required)', 'Hide_Then_Show_Comments'); ?></label>
      <input type="email" class="form-control <?php if ($req) { ?>required<?php }?>" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" <?php if ($req) echo 'aria-required="true"'; ?>>
  </div>
  <div class="form-group">
      <label for="url"><?php _e('Website', 'Hide_Then_Show_Comments'); ?></label>
      <input type="url" class="form-control" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22">
  </div>
<?php endif; ?>
<div class="form-group">
<label for="comment"><?php _e('Comment', 'Hide_Then_Show_Comments'); ?></label>
<textarea name="comment" id="comment" class="form-control <?php if ($req) { ?>required<?php } ?>" rows="5" aria-required="true"></textarea>
</div>
<p><input name="submit" class="btn btn-primary" type="submit" id="submit" value="<?php _e('Submit Comment', 'Hide_Then_Show_Comments'); ?>"></p>
<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; ?>
</section><!-- /#respond -->
<?php endif; ?>