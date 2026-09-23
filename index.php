<?php get_header(); ?>

<main class="container-fluid" id="content-home">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php $categories = get_the_category(); ?>

    <section id="project-<?php the_ID(); ?>" <?php post_class('project'); ?>>
      <a href="<?php the_permalink(); ?>" class="overall" aria-label="<?php the_title(); ?>"></a>    

      <div class="project-title-wrap">
        <div class="project-title-track">
          <span class="project-title uppercase s-huge"><?php the_title(); ?></span>
        </div>
      </div>

      <span class="project-category uppercase s-small" data-cat="<?= $categories[0]->slug ?>"><?= esc_html( $categories[0]->name ); ?></span>

      <?php if ( has_post_thumbnail() ) : the_post_thumbnail('medium', array('class' => 'project-thumb')); endif; ?>
    </section>
  
  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</main>

<?php get_footer(); ?>