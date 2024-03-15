<?php
get_header();
?>
	<h1>Title: <?php the_title(); ?></h1>
	<div><h2>Content:</h2> <?php the_content();?></div>
	<div><h3>Taxonomies:</h3><?php the_taxonomies(); ?></div>
<?php
get_footer();
