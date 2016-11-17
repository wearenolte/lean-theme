<?php use Lean\Load; ?>
<section class="section latest-posts">
	<h2 class="section-title">Latest Posts</h2>
	<ul class="post-list">
	<?php while ( have_posts() ) : the_post(); ?>
		<li><?php Load::molecule( 'blocks/media-block' ); ?>
	<?php endwhile; ?>
	</ul>
	<a href="#" class="text-btn">View more posts</a>
</section>
