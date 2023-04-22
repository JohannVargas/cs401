<?php 
add_action( 'init', 'custom_taxonomy_interests', 0 );
function custom_taxonomy_interests() {

	$labels = array(
		'name'                       => _x( 'Interests', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Interests', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Interests', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => array( 'slug' => 'custom-taxonomy' ),
		'rest_base'                  => 'custom-taxonomy',
		'rest_controller_class'      => 'WP_REST_Terms_Controller',
	);
	register_taxonomy( 'custom_taxonomy_interests', array( 'post' ), $args );

}
add_action( 'init', 'custom_tiles' );
// Register the custom post type
function custom_tiles() {

    // Set labels for the custom post type
    $labels = array(
        'name'                  => __( 'Tiles', 'textdomain' ),
        'singular_name'         => __( 'Tile', 'textdomain' ),
        'menu_name'             => __( 'Tiles', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Tiles:', 'textdomain' ),
        'all_items'             => __( 'All  Tiles', 'textdomain' ),
        'view_item'             => __( 'View Tile', 'textdomain' ),
        'add_new_item'          => __( 'Add New Tile', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'edit_item'             => __( 'Edit Tile', 'textdomain' ),
        'update_item'           => __( 'Update Tile', 'textdomain' ),
        'search_items'          => __( 'Search Tiles', 'textdomain' ),
        'not_found'             => __( 'Not found', 'textdomain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'textdomain' ),
    );

    // Set arguments for the custom post type
    $args = array(
        'label'                 => __( 'Tile', 'textdomain' ),
        'description'           => __( 'Custom post type Tiles', 'textdomain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'taxonomies'),
        'taxonomies'            => array( 'category', 'post_tag','custom_taxonomy_interests' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-book',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'map_meta_cap'          => true,
    );

    // Register the custom post type
    register_post_type( 'custom_tiles', $args );

}
function add_author_column($columns) {
    $columns['author'] = __('Author');
    return $columns;
}
add_filter('manage_custom_tiles_posts_columns', 'add_author_column');

// Populate author column with data
function populate_author_column($column, $post_id) {
    if ($column == 'author') {
        $author = get_userdata(get_post_field('post_author', $post_id));
        echo $author->display_name;
    }
}
add_action('manage_custom_tiles_posts_custom_column', 'populate_author_column', 10, 2);
function add_gifts_metabox() {
    add_meta_box( 
      'gifts_metabox',
      'Gifts',
      'gifts_metabox_callback',
      'custom_tiles',
      'normal',
      'default'
    );
  }
  add_action( 'add_meta_boxes', 'add_gifts_metabox' );// Callback function to display the metabox
  // Callback function to display the metabox
function gifts_metabox_callback( $post ) {
    // Retrieve the existing gift data
    $gifts = get_post_meta( $post->ID, '_gifts', true );
    // Display the gift form
    ?>
    <div class="gifts-container">
        <?php if ( $gifts ) : ?>
            <?php foreach ( $gifts as $gift ) : ?>
                <div class="gift">
                    <label>Name</label>
					<br>
                    <input type="text" name="gift_name[]" value="<?php echo esc_attr( $gift['name'] ); ?>">
                    <br>
					<label>Description</label>
                    <br>
					<textarea name="gift_description[]" cols="75"><?php echo esc_textarea( $gift['description'] ); ?></textarea>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="gift">
                <label>Name</label>
				<br>
                <input type="text" name="gift_name[]">
                <br>
				<label>Description</label>
                <br>
				<textarea name="gift_description[]" cols="75"></textarea>
            </div>
        <?php endif; ?>
    </div>
    <button class="add-gift button">Add Gift</button>
    <script>
        jQuery(document).ready(function($) {
            // Add gift button
            $('.add-gift').on('click', function() {
                $('.gifts-container').append('<div class="gift"><label>Name</label><br><input type="text" name="gift_name[]"><br><label>Description</label><br><textarea name="gift_description[]" cols="75"></textarea><button class="remove-gift button">Remove Gift</button></div>');
                return false;
            });
            // Remove gift button
            $('.gifts-container').on('click', '.remove-gift', function() {
                $(this).parent().remove();
                return false;
            });
        });
    </script>
    <?php
}

// Save the metabox data
function save_gifts_metabox_data( $post_id ) {
    // Check if the user has permission to save the data
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    // Check if the data was submitted
    if ( ! isset( $_POST['gift_name'] ) || ! isset( $_POST['gift_description'] ) ) {
        return;
    }
    // Sanitize and save the data
    $gifts = array();
    $gift_names = array_map( 'sanitize_text_field', $_POST['gift_name'] );
    $gift_descriptions = array_map( 'sanitize_textarea_field', $_POST['gift_description'] );
    for ( $i = 0; $i < count( $gift_names ); $i++ ) {
        if ( ! empty( $gift_names[$i] ) ) {
            $gifts[] = array(
                'name' => $gift_names[$i],
                'description' => $gift_descriptions[$i],
            );
        }
    }
    update_post_meta( $post_id, '_gifts', $gifts );
}
add_action( 'save_post', 'save_gifts_metabox_data' );
  function add_stores_metabox() {
    add_meta_box( 
      'stores_metabox',
      'Recommended Stores',
      'stores_metabox_callback',
      'custom_tiles',
      'normal',
      'default'
    );
  }
  add_action( 'add_meta_boxes', 'add_stores_metabox' );// Callback function to display the metabox
  function stores_metabox_callback( $post ) {
      // Retrieve the existing store data
      $stores = get_post_meta( $post->ID, '_stores', true );
      // Display the store form
      ?>
      <div class="stores-container">
          <?php if ( $stores ) : ?>
              <?php foreach ( $stores as $store ) : ?>
                  <div class="store">
                      <label>Name</label>
					  <br>
                      <input type="text" name="store_name[]" value="<?php echo esc_attr( $store['name'] ); ?>">
					  <br>
                      <label>Link</label>
					  <br>
                      <input type="text" name="store_link[]" value="<?php echo esc_attr( $store['link'] ); ?>">
                  </div>
              <?php endforeach; ?>
          <?php else : ?>
              <div class="store">
					  <label>Name</label>
					  <br>
                      <input type="text" name="store_name[]">
					  <br>
                      <label>Link</label>
					  <br>
                      <input type="text" name="store_link[]">
              </div>
          <?php endif; ?>
      </div>
      <button class="add-store button">Add Store</button>
      <script>
          jQuery(document).ready(function($) {
              // Add store button
              $('.add-store').on('click', function() {
                  $('.stores-container').append('<div class="store"><label>Name</label><br><input type="text" name="store_name[]"><br><label>Link</label><br><input type="text" name="store_link[]"><button class="remove-store button">Remove Store</button></div>');
                  return false;
              });
              // Remove store button
              $('.stores-container').on('click', '.remove-store', function() {
                  $(this).parent().remove();
                  return false;
              });
          });
      </script>
      <?php
  }

function save_stores_metabox_data($post_id) {
    // Check if the user has permission to save the data
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Check if the data was submitted
    if (!isset($_POST['store_name']) || !isset($_POST['store_link'])) {
        return;
    }

    // Sanitize and save the data
    $stores = array();
    $store_names = array_map('sanitize_text_field', $_POST['store_name']);
    $store_links = array_map('sanitize_text_field', $_POST['store_link']);
    for ($i = 0; $i < count($store_names); $i++) {
        if (!empty($store_names[$i]) && !empty($store_links[$i])) {
            $stores[] = array(
                'name' => $store_names[$i],
                'link' => $store_links[$i],
            );
        }
    }
    update_post_meta($post_id, '_stores', $stores);
}
add_action('save_post', 'save_stores_metabox_data');