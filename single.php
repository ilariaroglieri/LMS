<?php get_header(); ?>

<main class="container-fluid" id="content-single">

  <?php get_template_part( 'snippets/journal-marquee' ); ?>

  <?php if ( have_posts() ) : ?>
    <div class="container">
      <?php while ( have_posts() ) : the_post(); 
        $categories = get_the_category(); 
      ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class('d-flex v-center'); ?>>
        <div class="d-two-thirds t-whole ">
          <h2 id="project-cat" class="project-category uppercase s-medium t-center spacing-b-4"><?= esc_html( $categories[0]->name ); ?></h2>
          <h1 id="project-title" class="s-huge uppercase t-center spacing-b-6"><?php the_title() ?></h1>

          <?php if ( has_post_thumbnail() ) : ?> 
            <figure id="project-img" class="d-flex v-center spacing-b-6">
              <?php the_post_thumbnail('full'); ?>
            </figure>
          <?php endif; ?>

          <div id="project-txt" class="wysiwyg s-regular-2">
            <?php the_content(); ?>
          </div>

          <div class="project-carousel">
          </div>


          <?php if( have_rows('project_credits') ): ?>
            <div id="project-info" class="d-flex wrap m-column">
              <?php while( have_rows('project_credits') ) : the_row(); 
                $label = get_sub_field('label');
                $val = get_sub_field('value'); ?>

                <div class="project-info-label d-half m-whole spacing-b-4">
                  <span class="s-regular-2 uppercase"><?= $label ?></span>
                </div>

                <div class="project-info-value d-half m-whole spacing-b-4">
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