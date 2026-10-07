<?php 
// Pannelli dinamici: slug URL → post type e partial
function lms_panel_types() {
  return [
    'project' => [ 'post_type' => 'post',          'part' => 'snippets/project-item' ],
    'journal' => [ 'post_type' => 'journal_entry', 'part' => 'snippets/journal-item' ],
  ];
}

add_action( 'rest_api_init', function () {
  foreach ( lms_panel_types() as $slug => $config ) {
    register_rest_route( 'lms', '/' . $slug . '/(?P<id>\d+)', [
      'methods'             => 'GET',
      'permission_callback' => '__return_true',
      'callback'            => function ( WP_REST_Request $request ) use ( $config ) {
        return lms_render_panel( (int) $request['id'], $config );
      },
    ] );
  }
} );

function lms_render_panel( $id, $config ) {
  $post = get_post( $id );

  if ( ! $post || $post->post_type !== $config['post_type'] || $post->post_status !== 'publish' ) {
    return new WP_Error( 'not_found', 'Not found', [ 'status' => 404 ] );
  }

  $GLOBALS['post'] = $post;
  setup_postdata( $post );

  ob_start();
  get_template_part( $config['part'] );
  $html = ob_get_clean();

  wp_reset_postdata();

  return [ 'html' => $html ];
}