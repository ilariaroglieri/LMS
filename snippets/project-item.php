<article id="post-<?php the_ID(); ?>" <?php post_class('d-flex flex-row d-column center'); ?>>
  <div class="d-whole spacing-t-4 spacing-m-t-2">
    <?php $categories = get_the_category(); 
    if ($categories): ?>
      <h2 id="project-cat" class="project-category uppercase s-medium s-m-small t-center spacing-b-4 spacing-m-b-2" data-reveal="parent"><?= esc_html( $categories[0]->name ); ?></h2>
    <?php endif; ?>
    <h1 id="project-title" class="s-huge uppercase t-center spacing-b-6 spacing-m-b-2" data-reveal="parent"><?php the_title() ?></h1>
  </div>

  <div class="d-two-thirds t-whole">
    <?php if ( has_post_thumbnail() ) : ?> 
      <figure id="project-img" class="d-flex v-center spacing-b-6 spacing-m-b-2" data-reveal="parent">
        <?php the_post_thumbnail('full'); ?>
      </figure>
    <?php endif; ?>

    <div id="project-txt" class="wysiwyg s-regular s-m-small spacing-b-6 spacing-m-b-2">
      <?php the_content(); ?>
    </div>

    <?php 
      $media = get_field('project_carousel'); 
      if ($media): ?>
      <div id="project-carousel" class="spacing-b-6 spacing-m-b-2">
        <div class="swiper-slider" data-reveal="parent">
          <div class="swiper-wrapper">
            <?php 
            $size = 'full';
            foreach ($media as $img): 
              $orientation = $img['width'] > $img['height'] ? 'landscape' : 'portrait'; 
            ?>
              <div class="swiper-slide <?= $orientation ?>">
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
      <div id="project-info" class="d-flex flex-row wrap" data-reveal="parent">
        <?php while( have_rows('project_credits') ) : the_row(); 
          $label = get_sub_field('label');
          $val = get_sub_field('value'); ?>

          <div class="project-info-label d-half spacing-b-4 spacing-m-b-2" data-reveal="child">
            <span class="s-regular-2 s-m-xsmall uppercase"><?= $label ?></span>
          </div>

          <div class="project-info-value d-half spacing-b-4 spacing-m-b-2" data-reveal="child">
            <h3 class="s-regular-2 s-m-xsmall"><?= $val ?></h3>
          </div>

        <?php endwhile; ?>
      </div>
    <?php endif; ?>

  </div>
</article>