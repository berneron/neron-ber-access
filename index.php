<?php get_header() ?>

	<!-- only logged user view the post -->

<!-- <div class="post1"> -->

<?php
$current_user = wp_get_current_user();
$user_login = $current_user->user_login;

if ($current_user->user_login==root) { ?>
 	
	<?php query_posts('category_name=news'); ?>
	<?php if( have_posts() ){ while( have_posts() ){ the_post(); ?>
	  <span>
	    <a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
	  </span>
	    <p>
	      <?php the_content('Читати далі'); ?></p><hr>
	    </p>

	<?php } /* конец while post*/ ?>
	<?php } /* конец while have post*/ ?>

<?php } else if ($current_user->user_login==beton) { ?>
 	
	<?php query_posts('category_name=beton'); ?>
	<?php if( have_posts() ){ while( have_posts() ){ the_post(); ?>
	  <span>
	    <a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
	  </span>
	    <p>
	      <?php the_content('Читати далі'); ?></p><hr>
	    </p>

	<?php } /* конец while post*/ ?>
	<?php } /* конец while have post*/ ?>

<?php } else echo "<h3>No access</h3>"; ?>

<?php get_footer() ?>