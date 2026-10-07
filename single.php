<?php get_header(); ?>

<main class="container-fluid" id="content-single">
   
  <div class="container">
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); 
        get_template_part('snippets/project-item');
      endwhile; 
    else: ?>
      <p>Sorry, no content found.</p>
    <?php endif; ?>
  </div>

</main>

<?php get_footer(); ?>