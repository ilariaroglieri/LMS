<?php $args = array(
  'post_type' => 'journal_entry',
  'post_status' => 'publish',
  'order' => 'DESC',
  'orderby' => 'date',
  'posts_per_page' => -1
);

$journalEntries = new WP_Query( $args );

if ( $journalEntries->have_posts() ): ?>
  <div class="journal-list spacing-b-4">
    <?php while ( $journalEntries->have_posts() ): $journalEntries->the_post();
      $date = get_the_date('m/Y');
      $title = get_the_title(); ?>
      <div class="journal-item">
        <div class="journal-header">
          <h3 class="journal-date s-regular"><?= $date ?></h3>
          <h2 class="journal-title s-regular"><?= $title; ?></h2>
        </div>
        <div class="journal-content">
          <div class="journal-content-inner">
            <?php if ( has_post_thumbnail() ) : the_post_thumbnail('medium', array('class' => 'journal-thumb')); endif; ?>

            <div class="journal-txt wysiwyg s-small spacing-t-4">
              <?php the_content(); ?>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile ?>
  </div>
<?php wp_reset_postdata(); endif; ?>