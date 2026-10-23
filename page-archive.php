<?php get_header(); ?>

<main class="container grid-row" id="content-archive">

  <section id="archive-container">
    <?php $categories = get_categories();
    if ($categories): ?>
      <div id="cats-container" class="d-grid grid-row">
        <div class="button-container">
          <button class="s-regular uppercase active" data-cat="all">All</button>
        </div>
        <?php foreach($categories as $category): ?>
          <div class="button-container">
            <button class="s-regular uppercase" data-cat="<?= esc_attr($category->slug) ;?>"><?= esc_html($category->name); ?></button>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    
    <?php $args = array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'order' => 'DESC',
      'orderby' => 'date',
      'posts_per_page' => -1
    );

    $projects = new WP_Query( $args );

    if ( $projects->have_posts() ): ?>
      <div id="projects-container" class="d-flex flex-row wrap">
        <?php while ( $projects->have_posts() ): $projects->the_post();?>
          <?php $categories = get_the_category(); ?>
          <div class="single-project p-relative spacing-b-6 spacing-m-b-3 d-half m-whole" data-project-cat="<?= esc_html($categories[0]->slug); ?>">
            <a class="p-absolute overall" href="<?php the_permalink(); ?>"></a>

            <?php if ( has_post_thumbnail() ) : 
              $thumb_id = get_post_thumbnail_id();
              $img_meta = wp_get_attachment_metadata($thumb_id);
              $orientation = '';
              if ( $img_meta && isset($img_meta['width'], $img_meta['height']) ) {
                $orientation = $img_meta['width'] > $img_meta['height'] ? 'landscape' : 'portrait';
              }
            ?>
              <figure class="project-img spacing-b-4 spacing-t-b-2 <?= $orientation ?>" data-reveal="parent">
                <?php the_post_thumbnail('medium'); ?>
              </figure>
            <?php endif; ?>
            <?php if ($categories): ?>
              <h3 class="project-category uppercase s-small s-m-small spacing-b-half" data-cat="<?= $categories[0]->slug ?>"><?= esc_html( $categories[0]->name ); ?></h3>
            <?php endif; ?>
            <h2 class="s-regular uppercase"><?php the_title(); ?></h2>
          </div>
        <?php endwhile ?>
      </div>
    <?php wp_reset_postdata(); endif; ?>
  </section>

  <section id="journal-container">
    <?php get_template_part( 'snippets/journal-list' ); ?>
  </section>

</main>

<?php get_footer(); ?>