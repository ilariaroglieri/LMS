<?php get_header(); ?>

<main class="container grid-row" id="content-about">

  <section id="about-container">
    <?php if( have_rows('about_text_modules') ): ?>
      <div id="project-info" class="d-flex flex-row wrap m-column" data-reveal="parent">
        <?php $i = 0; while( have_rows('about_text_modules') ) : the_row(); 
          $label = get_sub_field('text_section_label');
          $val = get_sub_field('text_section_content'); 
          $i++; 
          $fontSize = ($i == 1) ? 's-medium' : 's-regular'; ?>

          <div class="info-label d-3-twelfth m-whole spacing-b-4" data-reveal="child">
            <span class="s-regular uppercase"><?= $label ?></span>
          </div>

          <div class="info-value d-9-twelfth m-whole spacing-b-4 wysiwyg <?= $fontSize; ?>" data-reveal="child">
            <?= $val ?>
          </div>

        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </section>

  <section id="contacts-container">
    <?php if( have_rows('contacts_text_modules') ): ?>
      <div id="project-info" class="d-flex flex-row wrap m-column" data-reveal="parent">
        <?php while( have_rows('contacts_text_modules') ) : the_row(); 
          $label = get_sub_field('text_section_label');
          $val = get_sub_field('text_section_content'); ?>

          <div class="info-label d-one-third t-3-twelfth m-whole spacing-b-4" data-reveal="child">
            <span class="s-regular"><?= $label ?></span>
          </div>

          <div class="info-value d-two-thirds t-9-twelfth m-whole spacing-b-4 wysiwyg s-regular" data-reveal="child">
            <?= $val ?>
          </div>

        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </section>

</main>

<?php get_footer(); ?>