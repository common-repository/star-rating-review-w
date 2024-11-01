<?php
/*
 * comments.php file is welcart only.
 * Please use it to enable the welcart.
 * To the theme, please upload (overwriting) the comments.php file.
 * Before uploading please always back up.
 */
   if(post_password_required()){ ?>
     <p><?php _e('This post is password protected. Enter the password to view comments.'); ?></p> 
       <?php
         return;
   }
     if(usces_is_item() && is_plugin_active('star-rating-review-w/star_rating_review.php')){
      if(get_comments_number() == '0'){
       echo '<p class="no-review">'.__('There are no customer reviews yet.','srrwtx').'</p>';
      }
     }
?>

  <?php if(have_comments()){ ?>
    <?php //.srrwtx-body?>
    <article class="srrwtx-body">
      <?php //.srrwtx-comment-in?>
      <div class="srrwtx-body-in">
        <?php if(usces_is_item() && is_plugin_active('star-rating-review-w/star_rating_review.php')){ ?>
          <div class="srrwtx-rating-synthesis">
            <h2 id="srrwtx-rating-h2"><span><?php echo get_comments_number().__('Reviews', 'srrwtx');?></span></h2>
              <?php
                 global $post;
                   $comment_gross_rating = get_comment_meta( $post->ID, 'star', false);
                     $comment_gross_rating_total = array_sum($comment_gross_rating);
                       $comment_gross_rating_count = count($comment_gross_rating);
                         $comment_gross_rating_rate = $comment_gross_rating_total / max($comment_gross_rating_count, 1);
                           $comment_gross_rating_rounding = sprintf('%.1f', $comment_gross_rating_rate);
                             if($comment_gross_rating_rounding <= '1.4'){ $rating_number = '1.0';
                               $comment_gross_rating_star = array( 'rating' => 1.0, 'type' => 'rating', 'number' => '' );
                             }elseif($comment_gross_rating_rounding >= '1.5' && $comment_gross_rating_rounding <= '1.9'){ $rating_number = '1.5';
                               $comment_gross_rating_star = array( 'rating' => 1.5, 'type' => 'rating', 'number' => '' );
                             }elseif($comment_gross_rating_rounding >= '2.0' && $comment_gross_rating_rounding <= '2.4'){ $rating_number = '2.0';
                               $comment_gross_rating_star = array( 'rating' => 2.0, 'type' => 'rating', 'number' => '' );
                             }elseif($comment_gross_rating_rounding >= '2.5' && $comment_gross_rating_rounding <= '2.9'){ $rating_number = '2.5';
                               $comment_gross_rating_star = array( 'rating' => 2.5, 'type' => 'rating', 'number' => '' );
                             }elseif($comment_gross_rating_rounding >= '3.0' && $comment_gross_rating_rounding <= '3.4'){ $rating_number = '3.0';
                               $comment_gross_rating_star = array( 'rating' => 3.0, 'type' => 'rating', 'number' => '' );
                             }elseif($comment_gross_rating_rounding >= '3.5' && $comment_gross_rating_rounding <= '3.9'){ $rating_number = '3.5';
                               $comment_gross_rating_star = array( 'rating' => 3.5, 'type' => 'rating', 'number' => '' );
                             }elseif($comment_gross_rating_rounding >= '4.0' && $comment_gross_rating_rounding <= '4.4'){ $rating_number = '4.0';
                               $comment_gross_rating_star = array( 'rating' => 4.0, 'type' => 'rating', 'number' => '' );
                             }elseif($comment_gross_rating_rounding >= '4.5' && $comment_gross_rating_rounding <= '4.9'){ $rating_number = '4.5';
                               $comment_gross_rating_star = array( 'rating' => 4.5, 'type' => 'rating', 'number' => '' );
                             }elseif($comment_gross_rating_rounding >= '5.0'){ $rating_number = '5.0';
                               $comment_gross_rating_star = array( 'rating' => 5.0, 'type' => 'rating', 'number' => '' );
                             }else{
                               $comment_gross_rating_star = array( 'rating' => 0, 'type' => 'rating', 'number' => '' );
                             } 
                             wp_star_rating($comment_gross_rating_star);
                               echo '<p>'.__('Total Review','srrwtx').'&nbsp;('.$rating_number.')</p></div>';
              ?>
          <?php //.srrwtx-rating-list?>
          <div class="srrwtx-rating-list">
            <?php wp_list_comments(array('callback'=>'srrwtx_comment_list'));?>
        <?php }else{ ?>
              <h2 id="srrwtx-comment-h2"><span><?php echo get_comments_number().__('Comments', 'srrwtx');?></span></h2>
                <?php //.srrwtx-comment-list?>
                <div class="srrwtx-comment-list">
	           <?php wp_list_comments();?>
        <?php } ?>
        <?php if(get_comment_pages_count() > 1 && get_option('page_comments')){ ?>
	  <div class="rc-navigation">
            <?php if(usces_is_item() && is_plugin_active('star-rating-review-w/star_rating_review.php')){ ?>
	       <div class="rc-right"><?php previous_comments_link(__('Old Reviews','srrwtx')) ?></div>
	         <div class="rc-left"><?php next_comments_link(__('New Review','srrwtx')) ?></div>
            <?php }else{ ?>
	       <div class="rc-right"><?php previous_comments_link(__('Old Comments','srrwtx')) ?></div>
	         <div class="rc-left"><?php next_comments_link(__('New Comments','srrwtx')) ?></div>
            <?php } ?>
	  </div>
        <?php } ?>
          </div>
          <?php //.srrwtx-rating-list & .srrwtx-comment-list?>
      </div>
      <?php //.srrwtx-body-in?>
    </article>
    <?php //.srrwtx-body?>

        <?php if(!comments_open() && get_comments_number()){ ?>
        <p class="nocomments"><?php printf(__('Comments are closed.')); ?></p>
	<?php }} ?>

          <?php
            global $user_ID,$usces,$wpdb,$post;
              if(comments_open()){
                if(!$user_ID && usces_is_login()){
                  $usces_member_post = $post->ID;
	            $usces_member_information = $usces->get_member();
	              $usces_member_possession = $usces->get_member_history($usces_member_information['ID']);
                        foreach($usces_member_possession as $usces_member_conversion){
                          $usces_member_storage = $usces_member_conversion['cart'];
                            foreach($usces_member_storage as $usces_member_storage_in){
                              $usces_member_id_post[] = $usces_member_storage_in['post_id'];



                          }
                        }
                        $usces_member_id_post_array = array_unique($usces_member_id_post);
                          foreach($usces_member_id_post_array as $usces_member_id_post_selection){
                            if($usces_member_id_post_selection == $usces_member_post){
          ?>

            <?php //.srrwtx-body?>
            <section class="srrwtx-body">
              <?php //.srrwtx-body-in?>
              <div class="srrwtx-body-in">
                <h2 id="srrwtx-rating-form-h2"><span><?php _e('Leave a review','srrwtx'); ?></span></h2>
                  <?php //.srrwtx-rating-form?>
                  <div class="srrwtx-rating-form">
                    <?php //.srrwtx-rating-form-in?>
                    <div class="srrwtx-rating-form-in">

              <?php
                $args = array();
	          $args = wp_parse_args( $args );
	            if(! isset($args['format']))
		      $args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';
	                $req = get_option('require_name_email');
	                  $aria_req = ($req ? " aria-required='true'" : '');
	                    $html5 = 'html5' === $args['format'];
                              $srrwtx_fields = array(
                                'fields' => array(
                                  'author' => '<p class="comment-form-author"><label for="author">'.__('Name(Nickname)','srrwtx') . ($req ? ' <span class="required">*</span>' : '').'</label> ' . '<input id="author" name="author" type="text" value="'.esc_attr($commenter['comment_author']).'" size="30"'.$aria_req.' /></p>',
                                  'email' => '<p class="comment-form-email"><label for="email">'.__('E-MAIL','srrwtx') . ($req ? ' <span class="required">*</span>' : '').'</label> ' . '<input id="email" name="email"'.($html5 ? 'type="email"' : 'type="text"').' value="'.esc_attr($commenter['comment_author_email']).'" size="30"'.$aria_req.' /></p>',
                                  'url' => '',
                                  'star' => '<div class="comment-form-star"><p class="comment-form-star-label"><label for="star">'.__('Rating','srrwtx') . ($req ? ' <span class="required">*</span>' : '').'</label></p>' .
                                            '<p class="comment-form-star-input"><input id="star1" name="star" type="radio" value="1"'.$aria_req.' /><label for="star1">★1</label>
                                             <input id="star2" name="star" type="radio" value="2"'.$aria_req.' /><label for="star2">★2</label>
                                             <input id="star3" name="star" type="radio" value="3"'.$aria_req.' /><label for="star3">★3</label>
                                             <input id="star4" name="star" type="radio" value="4"'.$aria_req.' /><label for="star4">★4</label>
                                             <input id="star5" name="star" type="radio" value="5"'.$aria_req.' /><label for="star5">★5</label>
                                             </p></div>',
                                ),
                                'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8"'.$aria_req.'>' . '</textarea></p>',
                                'must_log_in' => '<p class="must-log-in">'.sprintf(__('You must be logged in to post a review.','srrwtx')).'</p>',
	                        'title_reply' => '',
                                'comment_notes_before' => '<p class="comment-notes">'.__('E-MAIL will not be published.','srrwtx').'<br /><span class="required">*</span>'.__('Indicates a required field.','srrwtx').'</p>',
                                //'comment_notes_after' => '<p class="form-allowed-tags">'.__('Please send if there is no problem.','srrwtx').'</p>',
                                'label_submit' => __('Send Review','srrwtx'),
                              );
                               if(usces_is_item() && is_plugin_active('star-rating-review-w/star_rating_review.php')){
                                 comment_form($srrwtx_fields);
                               }
              ?>

                    </div>
                    <?php //.srrwtx-rating-form-in?>
                  </div>
                  <?php //.srrwtx-rating-form?>
              </div>
              <?php //.srrwtx-body-in?>
            </section>
            <?php //.srrwtx-body?>

            <?php
                       }
                     }
               }
            if(!usces_is_item()){
            ?>

            <?php //.srrwtx-body?>
            <section class="srrwtx-body">
              <?php //.srrwtx-body-in?>
              <div class="srrwtx-body-in">
                  <h2 id="srrwtx-comment-h2"><span><?php comment_form_title(__('Leave a Comment')); ?></span></h2>
                    <?php //.srrwtx-comment-form?>
                    <div class="srrwtx-comment-form">
                      <?php //.srrwtx-comment-form-in?>
                      <div class="srrwtx-rating-form-in">
                      <?php comment_form(); ?>
                    </div>
                    <?php //.srrwtx-rating-form-in?>
                  </div>
                  <?php //.srrwtx-rating-form?>
              </div>
              <?php //.srrwtx-body-in?>
            </section>
            <?php //.srrwtx-body?>

<?php }} ?>