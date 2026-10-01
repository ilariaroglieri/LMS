<?php get_header(); ?>

<main class="container-fluid" id="content-single">

  <?php get_template_part( 'snippets/journal-marquee' ); ?>

  <?php if ( have_posts() ) : ?>
    <div class="container">
      <?php while ( have_posts() ) : the_post(); 
        $categories = get_the_category(); 
      ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class('d-flex v-center'); ?>>
        <div class="d-two-thirds t-whole">
          <h2 id="project-cat" class="project-category uppercase s-medium t-center spacing-b-4" data-reveal="parent"><?= esc_html( $categories[0]->name ); ?></h2>
          <h1 id="project-title" class="s-huge uppercase t-center spacing-b-6" data-reveal="parent"><?php the_title() ?></h1>

          <?php if ( has_post_thumbnail() ) : ?> 
            <figure id="project-img" class="d-flex v-center spacing-b-6" data-reveal="parent">
              <?php the_post_thumbnail('full'); ?>
            </figure>
          <?php endif; ?>

          <div id="project-txt" class="wysiwyg s-regular-2 spacing-b-6">
            <?php the_content(); ?>
          </div>

          <?php 
            $media = get_field('project_carousel'); 
            if ($media): ?>
            <div id="project-carousel" class="spacing-b-6">
              <div class="swiper-slider" data-reveal="parent">
                <div class="swiper-wrapper">
                  <?php 
                  $size = 'full';
                  foreach ($media as $img): ?>
                    <div class="swiper-slide">
                      <?= wp_get_attachment_image( $img['ID'], $size ); ?>
                    </div>
                  <?php endforeach; ?>
                </div>
                <div class="swiper-navi">
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
                </div>
              </div>
            </div>
          <?php endif; ?>


          <?php if( have_rows('project_credits') ): ?>
            <div id="project-info" class="d-flex wrap m-column" data-reveal="parent">
              <?php while( have_rows('project_credits') ) : the_row(); 
                $label = get_sub_field('label');
                $val = get_sub_field('value'); ?>

                <div class="project-info-label d-half m-whole spacing-b-4" data-reveal="child">
                  <span class="s-regular-2 uppercase"><?= $label ?></span>
                </div>

                <div class="project-info-value d-half m-whole spacing-b-4" data-reveal="child">
                  <h3 class="s-regular-2"><?= $val ?></h3>
                </div>

              <?php endwhile; ?>
            </div>
          <?php endif; ?>

        </div>
      </article>

    <?php endwhile; else: ?>

      <h2>Woops...</h2>
      <p>Sorry, no posts found.</p>

    </div>
  <?php endif; ?>

</main>

<?php get_footer(); ?>