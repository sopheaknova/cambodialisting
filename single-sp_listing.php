<?php get_header(); ?>

<div id="content" class="clearfix">
	<div class="container clearfix">    
    <?php 
    if (have_posts()) : while (have_posts()) : the_post();
    
    	get_template_part('inc/loop/loop','sp_listing');
	
	endwhile; endif; 
	?>
    </div><!-- end .container -->
</div><!-- end #content -->

<?php get_footer(); ?>
