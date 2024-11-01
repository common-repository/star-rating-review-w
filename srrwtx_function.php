<?php
/****** Enable the plugin ******/
if(!function_exists('is_plugin_active')){
  require_once(ABSPATH . 'wp-admin/includes/plugin.php');
}


/****** Reads the dashicons ******/
function srrwtx_dashicons(){
  wp_enqueue_style('dashicons', ABSPATH.'/wp-includes/css/dashicons.min.css', array(), NULL, false);
}
add_action('wp_enqueue_scripts','srrwtx_dashicons');


/****** Reads the template.php ******/
require_once(ABSPATH.'wp-admin/includes/template.php');


/****** Save rating ******/
function srrwtx_comment_meta_save($comment_id){
  global $post;
    if(isset($_POST['star'])){
      $srrwtx_star = wp_filter_nohtml_kses($_POST['star']);
        add_comment_meta($post->ID, 'star', $srrwtx_star, false);
        add_comment_meta($comment_id, 'star', $srrwtx_star, false);
    }
}
add_action ('comment_post', 'srrwtx_comment_meta_save');


/****** Clear the tags ******/
function srrwtx_comment_tags_clear($data){
  global $allowedtags;
    if(usces_is_item()){
      unset($allowedtags['a']);
      unset($allowedtags['abbr']);
      unset($allowedtags['acronym']);
      unset($allowedtags['b']);
      unset($allowedtags['blockquote']);
      unset($allowedtags['cite']);
      unset($allowedtags['code']);
      unset($allowedtags['del']);
      unset($allowedtags['em']);
      unset($allowedtags['i']);
      unset($allowedtags['q']);
      unset($allowedtags['strike']);
      unset($allowedtags['strong']);
    }
     return $data;
}
add_filter('comments_open', 'srrwtx_comment_tags_clear');
add_filter('pre_comment_approved', 'srrwtx_comment_tags_clear');


/****** Customizing the comment list ******/
if(! function_exists('srrwtx_comment_list')) :
function srrwtx_comment_list($comment, $args, $depth){
$GLOBALS['comment'] = $comment;
?>

  <li id="star-rating-review-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
    <div id="div-star-rating-review-<?php comment_ID(); ?>" class="star-rating-review">
      <div class="star-rating-review-meta">
        <div class="star-rating-review-author vcard">
          <div class="star-rating-review-metadata">
            <?php printf(__('%s <span class="says">says:</span>','srrwtx'), sprintf('<b class="fn">%s</b>', get_comment_author_link())); ?>
             <time datetime="<?php comment_time('c'); ?>">
                <?php printf(_x('%1$s at %2$s', '1: date, 2: time'), get_comment_date(), get_comment_time()); ?>
             </time>
                <?php edit_comment_link(__( 'Edit' ), '<span class="edit-link">', '</span>'); ?>
          </div>
          <?php //.star-rating-review-metadata ?>

            <?php
              $comment_list_rating = get_comment_meta($comment->comment_ID, 'star', true);
                $comment_list_rating_star = array('rating' => $comment_list_rating, 'type' => 'rating', 'number' => '');
                  if($comment_list_rating == true){
                    wp_star_rating($comment_list_rating_star);
                  }else{
                    echo '<div class="star-rating">'.__('No rating','srrwtx').'</div>';
                  }
            ?>
        </div>
        <?php //.star-rating-review-author ?>

        <?php if ('0' == $comment->comment_approved):
              echo '<p class="star-rating-review-awaiting-moderation">'.__('Your review is awaiting moderation.','srrwtx').'</p>';
              endif;
        ?>
      </div>
      <?php //.star-rating-review-meta ?>

        <div class="star-rating-review-content">
          <?php comment_text(); ?>
        </div>
        <?php //.star-rating-review-content ?>

    </div>
    <?php //.star-rating-review ?>

<?php
}
endif;
?>