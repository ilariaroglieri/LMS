<?php 
  // rename default post type
  function rename_default_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Projects';
    $submenu['edit.php'][5][0] = 'Projects';
    $submenu['edit.php'][10][0] = 'Add Project';
    $submenu['edit.php'][16][0] = 'Projects Tags';
  }
  function rename_default_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Projects';
    $labels->singular_name = 'Project';
    $labels->add_new = 'Add Project';
    $labels->add_new_item = 'Add Project';
    $labels->edit_item = 'Edit Project';
    $labels->new_item = 'Projects';
    $labels->view_item = 'View Projects';
    $labels->search_items = 'Search Projects';
    $labels->not_found = 'No Projects found';
    $labels->not_found_in_trash = 'No Projects found in Trash';
    $labels->all_items = 'All Projects';
    $labels->menu_name = 'Projects';
    $labels->name_admin_bar = 'Projects';
  }
   
  add_action( 'admin_menu', 'rename_default_post_label' );
  add_action( 'init', 'rename_default_post_object' );

  // Register Custom Post Type
  function journal_post_type() {

    $labels = array(
      'name'                  => _x( 'Entries', 'Post Type General Name', 'text_domain' ),
      'singular_name'         => _x( 'Entry', 'Post Type Singular Name', 'text_domain' ),
      'menu_name'             => __( 'Journal', 'text_domain' ),
      'name_admin_bar'        => __( 'Journal', 'text_domain' ),
      'archives'              => __( 'Journal', 'text_domain' ),
      'attributes'            => __( 'Entry Attributes', 'text_domain' ),
      'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
      'all_items'             => __( 'All Entries', 'text_domain' ),
      'add_new_item'          => __( 'Add New Entry', 'text_domain' ),
      'add_new'               => __( 'Add New', 'text_domain' ),
      'new_item'              => __( 'New Entry', 'text_domain' ),
      'edit_item'             => __( 'Edit Entry', 'text_domain' ),
      'update_item'           => __( 'Update Entry', 'text_domain' ),
      'view_item'             => __( 'View Entry', 'text_domain' ),
      'view_items'            => __( 'View Entries', 'text_domain' ),
      'search_items'          => __( 'Search Entry', 'text_domain' ),
      'not_found'             => __( 'Not found', 'text_domain' ),
      'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
      'featured_image'        => __( 'Featured Image', 'text_domain' ),
      'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
      'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
      'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
      'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
      'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
      'items_list'            => __( 'Entries list', 'text_domain' ),
      'items_list_navigation' => __( 'Entries list navigation', 'text_domain' ),
      'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $args = array(
      'label'                 => __( 'Entry', 'text_domain' ),
      'description'           => __( 'Post Type Description', 'text_domain' ),
      'labels'                => $labels,
      'supports'              => array( 'title', 'editor', 'thumbnail' ),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => true,
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      'capability_type'       => 'page',
      'show_in_rest'          => true,
    );
    register_post_type( 'journal_entry', $args );

  }
  add_action( 'init', 'journal_post_type', 0 );
?>