<?php get_header(); ?>

<main class="container-fluid" id="content-home">
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
     data-endpoint="<?= esc_url( rest_url( 'lms/project/' ) ); ?>">
  <button type="button" class="project-panel-close" data-panel-close aria-label="Close">
    <svg version="1.1" x="0px" y="0px" viewBox="0 0 45.8 45.8" xml:space="preserve">
      <line class="st0" x1="44.5" y1="1.3" x2="1.3" y2="44.5"/>
      <line class="st0" x1="1.3" y1="1.3" x2="44.5" y2="44.5"/>
    </svg>
  </button>
  <div class="container project-panel-body"></div>
</div>

<?php get_footer(); ?>