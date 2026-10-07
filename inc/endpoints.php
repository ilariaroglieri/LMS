<?php 
add_action( 'rest_api_init', function () {
  register_rest_route( 'lms', '/project/(?P<id>\d+)', [
    'methods'             => 'GET',
    'callback'            => 'load_project',
    'permission_callback' => '__return_true',
  ] );
} );

function load_project( WP_REST_Request $request ) {
  $post = get_post( (int) $request['id'] );

  if ( ! $post || $post->post_type !== 'post' || $post->post_status !== 'publish' || post_password_required( $post ) ) {
    return new WP_Error( 'not_found', 'Project not found', [ 'status' => 404 ] );
  }

  $GLOBALS['post'] = $post;
  setup_postdata( $post );

  ob_start();
  get_template_part( 'snippets/project-item' );
  $html = ob_get_clean();

  wp_reset_postdata();

  return [ 'html' => $html ];
}
