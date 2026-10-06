<?php get_header(); ?>

<main class="container grid-row" id="content-archive">
  
    <?php $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'date',
    'posts_per_page' => -1
  );

  $journalEntries = new WP_Query( $args );

  if ( $journalEntries->have_posts() ): ?>
    <section id="projects-container" class="d-grid grid-row">
      <?php while ( $journalEntries->have_posts() ): $journalEntries->the_post();?>
        <div class="single-project p-relative spacing-b-6">
          <a class="p-absolute overall" href="<?php the_permalink(); ?>"></a>

          <?php if ( has_post_thumbnail() ) : 
            $thumb_id = get_post_thumbnail_id();
            $img_meta = wp_get_attachment_metadata($thumb_id);
            $orientation = '';
            if ( $img_meta && isset($img_meta['width'], $img_meta['height']) ) {
              $orientation = $img_meta['width'] > $img_meta['height'] ? 'landscape' : 'portrait';
            }
          ?>
            <figure class="project-img spacing-b-4 <?= $orientation ?>" data-reveal="parent">
              <?php the_post_thumbnail('medium'); ?>
            </figure>
          <?php endif; ?>
          <?php $categories = get_the_category(); 
          if ($categories): ?>
            <h3 class="project-category uppercase s-small spacing-b-half" data-cat="<?= $categories[0]->slug ?>"><?= esc_html( $categories[0]->name ); ?></h3>
          <?php endif; ?>
          <h2 class="s-regular uppercase"><?php the_title(); ?></h2>
        </div>
      <?php endwhile ?>
    </section>
  <?php wp_reset_postdata(); endif; ?>

  <section id="journal-container">JOURNAL</section>

</main>

<?php get_footer(); ?>