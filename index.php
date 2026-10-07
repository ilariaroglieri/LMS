<?php get_header(); ?>

<main class="container-fluid" id="content-home">
  
  <?php get_template_part( 'snippets/journal-marquee' ); ?>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <section id="project-<?php the_ID(); ?>" <?php post_class('project'); ?>>
      <a href="<?php the_permalink(); ?>" class="overall" aria-label="<?php the_title(); ?>" data-id="<?php the_ID(); ?>"></a>    

      <div class="project-title-wrap">
        <div class="project-title-track">
          <span class="project-title uppercase s-huge"><?php the_title(); ?></span>
        </div>
      </div>

      <?php $categories = get_the_category(); 
      if ($categories): ?>
        <span class="project-category uppercase s-small" data-cat="<?= $categories[0]->slug ?>"><?= esc_html( $categories[0]->name ); ?></span>
      <?php endif; ?>

      <?php if ( has_post_thumbnail() ) : the_post_thumbnail('medium', array('class' => 'project-thumb')); endif; ?>
    </section>
  
  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>
</main>

<div id="project-panel" class="project-panel" data-state="closed" role="dialog" aria-modal="true" aria-labelledby="project-title" tabindex="-1"
     data-endpoint="<?= esc_url( rest_url( 'lms-theme/project/' ) ); ?>">
  <button type="button" class="project-panel-close" data-panel-close aria-label="Close"></button>
  <div class="container" data-panel-body></div>
</div>

<?php get_footer(); ?>