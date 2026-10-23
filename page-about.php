<?php get_header(); ?>

<main class="container grid-row" id="content-about">

  <section id="about-container">
    <?php if( have_rows('about_text_modules') ): ?>
      <div id="project-info" class="d-flex flex-row wrap" data-reveal="parent">
        <?php $i = 0; while( have_rows('about_text_modules') ) : the_row(); 
          $label = get_sub_field('text_section_label');
          $val = get_sub_field('text_section_content'); 
          $i++; 
          $fontSize = ($i == 1) ? 's-medium' : 's-regular s-m-small'; 
          $mobSize = ($i == 1) ? 'm-whole' : 'm-5-twelfth'; 
          $mobSize2 = ($i == 1) ? 'm-whole spacing-m-b-3' : 'm-7-twelfth spacing-m-b-2'; 
          ?>

          <div class="info-label d-3-twelfth <?= $mobSize ?> spacing-b-4 spacing-m-b-0 d-flex" data-reveal="child">
            <span class="s-regular s-m-small uppercase"><?= $label ?></span>
          </div>

          <div class="info-value d-9-twelfth <?= $mobSize2 ?> spacing-b-4 wysiwyg <?= $fontSize; ?>">
            <?= $val ?>
          </div>

        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </section>

  <section id="contacts-container">
    <?php if( have_rows('contacts_text_modules') ): ?>
      <div id="project-info" class="d-flex flex-row wrap" data-reveal="parent">
        <?php while( have_rows('contacts_text_modules') ) : the_row(); 
          $label = get_sub_field('text_section_label');
          $val = get_sub_field('text_section_content'); ?>

          <div class="info-label d-one-third t-3-twelfth m-5-twelfth spacing-b-4 spacing-m-b-2 d-flex">
            <span class="s-regular s-m-small"><?= $label ?></span>
          </div>

          <div class="info-value d-two-thirds t-9-twelfth m-7-twelfth spacing-b-4 spacing-m-b-2 wysiwyg s-regular s-m-small">
            <?= $val ?>
          </div>

        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </section>

</main>

<?php get_footer(); ?>