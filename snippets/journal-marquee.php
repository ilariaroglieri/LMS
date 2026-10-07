<?php $args = array(
  'post_type' => 'journal_entry',
  'post_status' => 'publish',
  'order' => 'DESC',
  'orderby' => 'date',
  'posts_per_page' => 3
);

$journalEntries = new WP_Query( $args );

if ( $journalEntries->have_posts() ): ?>
  <div id="journal-banner" class="journal-banner">
    <div class="journal-track">
      <p class="journal-titles">
        <?php while ( $journalEntries->have_posts() ): $journalEntries->the_post();
          $date = get_the_date('m/Y');
          $title = get_the_title(); ?>
          <span class="s-medium"><a href="<?php the_permalink(); ?>" data-id="<?php the_ID(); ?>"><?= $date . ' > ' . $title; ?></a></span>
        <?php endwhile ?>
      </p>
    </div>
  </div>
<?php wp_reset_postdata(); endif; ?>