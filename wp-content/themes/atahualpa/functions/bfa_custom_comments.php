<?php
function bfa_comments($comment, $args, $depth) {

global $bfa_ata;

   // Sara's code starts here
   global $withtruncation;	// this is a condensed archive
   global $comment_count;     
   $comment_count = $comment_count + 1;
   
   // Limit comments on condensed subcatory page
   if ( ($comment_count < 4 && $withtruncation)  || !$withtruncation)
   {
   // Sara's code ends here

   $GLOBALS['comment'] = $comment; ?>

		<li <?php
		 if($GLOBALS['comment']->comment_parent != 0)
        { 
			comment_class($class='clearfix'); 
		}
		?> id="comment-<?php comment_ID(); ?>"> 
        
         <?php
		 // inner list for parent comment only
        if($GLOBALS['comment']->comment_parent == 0)
        {
			 ob_start(); 
				comment_class($class="clearfix"); 
				$thisCommentClass = ob_get_contents(); 
			 ob_end_clean(); 
			 print '<ul class="comment_list_inner"><li ' . $thisCommentClass . ' id="comment-' . $comment->comment_ID . '">';
        } 
		?> 
            
		<div id="div-comment-<?php comment_ID(); ?>" class="clearfix comment-container<?php 
		$comment = get_comment($comment_id);
		if ( $post = get_post($post_id) ) {
			if ( $comment->user_id === $post->post_author )
				echo ' bypostauthor';
		}
		// Comment by admin user
		$user_info = get_userdata($comment->user_id); 
		if($user_info->user_level > 6) 
		{
				echo ' byadmin';
		} 
		?>">
        
        <?php
		// Comments heading
        /* if ($comment_count == 1)
		{
		  print '<p id="comments"><a name="' . get_the_title() . '"></a>';
	comments_number(__('No comments yet to ', 'atahualpa'),
    __('Comment to ', 'atahualpa'), __('Comments to ', 'atahualpa'));
	echo get_the_title() . '</p>';
		} */
		if($withtruncation)
		{			
			if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] );
			
			if($user_info->user_level > 6) 
			{
				print '<span class="authorname">Moderator</span>';
			}
			else
			{
				$curauth = get_userdatabylogin($comment->comment_author); 
				if($curauth->first_name != '' &&  $curauth->last_name !='')
				{
					$this_author = $curauth->first_name . ' ' . $curauth->last_name;
				}
				else
				{
					$this_author = $comment->comment_author;
				}
				
				if($comment->comment_author_url && $comment->comment_author_url !='')
				{
					print '<span class="authorname"><a href="' . $comment->comment_author_url . '">' . $this_author . '</a></span>';
				}
				else
				{
					print '<span class="authorname">' . $this_author . '</span>';
				}  
			}
      
			if ($comment->comment_approved == '0')
            {
            	print '<span class="moderation">' . $bfa_ata['comment_moderation_text'] . '</span>';
            }
			
            print '<span class="comment-meta commentmetadata"> <a href="' . htmlspecialchars( get_comment_link( $comment->comment_ID ) ) .'">';
			printf(__('%1$s %2$s','atahualpa'), get_comment_date(__('n/j/y,','atahualpa')),  get_comment_time());
			print '</a></span> ';
			
			//echo comment_reply_link(array('before' => '<span class="comment-reply-link">', 'after' => '</span>', 'reply_text' => $bfa_ata['comment_reply_link_text'], 'depth' => $depth, 'max_depth' => $args['max_depth'] ));
			
			print ' ';
			global $current_user;
			get_currentuserinfo();
			if($current_user->user_email == $comment->comment_author_email || $current_user->user_level > 6)
			{
				edit_comment_link($bfa_ata['comment_edit_link_text'],'<span class="comment-edit-link">','</span> ');
			}
			
			
			if($user_info->user_level > 6) 
			{
				$comment_content = truncateStringOnBoundary($comment->comment_content,300);
			}
			else
			{
				$comment_content = truncateStringOnBoundary($comment->comment_content,300);
			}
			if ($comment_content != $comment->comment_content)
			{
				$full_comment_link = $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] .'?full=1#' . get_the_title() . '_' . $comment->comment_ID;
				$comment_content = $comment_content . '<a href="http://' . $full_comment_link . '">More ></a>';
			}
			print $comment_content;
			
			//$see_all_link = $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] .'?full=1#' . get_the_title();
			//if ($comment_count == 3)
			//{
			//  print '<p><a href="http://' . $see_all_link . '">See all comments</a></p>';
			//}
		}
		else
		{
			print '<a name="' . get_the_title() . '_' . $comment->comment_ID . '"></a>';
		?>
        
		<div class="comment-author vcard">
		<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); 
		
       		if($user_info->user_level > 6) 
			{
				$this_author = 'Moderator';
			}
			else
			{
				$curauth = get_userdatabylogin($comment->comment_author); 
				if($curauth->first_name != '' &&  $curauth->last_name !='')
				{
					$this_author = $curauth->first_name . ' ' . $curauth->last_name;
				}
				else
				{
					$this_author = $comment->comment_author;
				}
			}
			
			if($comment->comment_author_url && $comment->comment_author_url !='')
			{
				print '<span class="authorname"><a href="' . $comment->comment_author_url . '">' . $this_author . '</a></span>';
			}
			else
			{
				print '<span class="authorname">' . $this_author . '</span>';
			}  
      
			/*
			if ($comment->comment_approved == '0')
            {
            	print '<em>' . $bfa_ata['comment_moderation_text'] . '</em>';
            }
			*/
		?>
		</div>
        
		<?php if ($comment->comment_approved == '0') : ?>
		<span class="moderation"><?php echo $bfa_ata['comment_moderation_text']; ?></span><br />
		<?php endif; ?>
        
		<div class="comment-meta commentmetadata">
		<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php printf(__('%1$s %2$s','atahualpa'), get_comment_date(__('F d, Y,','atahualpa')),  get_comment_time()) ?></a>
        
        <?php 
		if(is_single())
		{
			echo comment_reply_link(array('before' => '<span class="comment-reply-link">', 'after' => '</span>', 'reply_text' => $bfa_ata['comment_reply_link_text'], 'depth' => $depth, 'max_depth' => $args['max_depth'] ));  
		}
		else
		{
			echo comment_reply_link_multi(array('before' => '<span class="comment-reply-link">', 'after' => '</span>', 'reply_text' => $bfa_ata['comment_reply_link_text'], 'depth' => $depth, 'max_depth' => $args['max_depth'] )); 
		}
		?>
        
		<?php 
		global $current_user;
      	get_currentuserinfo();
		if($current_user->user_email == $comment->comment_author_email || $current_user->user_level > 6)
		{
			edit_comment_link($bfa_ata['comment_edit_link_text'],'<span class="comment-edit-link">','</span>');
		} 
		?>
		</div>

		<?php  
        	comment_text(); 
			     
		}  // end if with trunc


       ?>
		</div>

<?php
	   if($GLOBALS['comment']->comment_parent == 0)
        {
        	 print "</li></ul>";
        } 
	} // end limit comments on subcategory pages	
} ?>