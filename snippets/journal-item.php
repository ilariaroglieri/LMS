<div class="journal-panel">
  <?php
    $date = get_the_date('m/Y');
    $title = get_the_title(); 
  ?>
  <div class="journal-item">
    <div class="journal-header">
      <h3 class="journal-date s-regular"><?= $date ?></h3>
      <h2 id="journal-title" class="journal-title s-regular"><?= $title; ?></h2>
    </div>
    <div class="journal-content">
      <div class="journal-content-inner">
        <?php if ( has_post_thumbnail() ) : the_post_thumbnail('medium', array('class' => 'journal-thumb spacing-t-4')); endif; ?>

        <div class="journal-txt wysiwyg s-small spacing-t-4">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
