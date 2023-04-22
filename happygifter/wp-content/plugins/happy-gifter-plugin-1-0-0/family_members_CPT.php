<?php 
// Hook into the 'init' action
add_action( 'init', 'custom_family_member_post_type' );
require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
// Register the custom post type
function custom_family_member_post_type() {

    // Set labels for the custom post type
    $labels = array(
        'name'                  => __( 'Family Members', 'textdomain' ),
        'singular_name'         => __( 'Family Member', 'textdomain' ),
        'menu_name'             => __( 'Family Members', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Family Member:', 'textdomain' ),
        'all_items'             => __( 'All Family Members', 'textdomain' ),
        'view_item'             => __( 'View Family Member', 'textdomain' ),
        'add_new_item'          => __( 'Add New Family Member', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'edit_item'             => __( 'Edit Family Member', 'textdomain' ),
        'update_item'           => __( 'Update Family Member', 'textdomain' ),
        'search_items'          => __( 'Search Family Members', 'textdomain' ),
        'not_found'             => __( 'Not found', 'textdomain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'textdomain' ),
    );

    // Set arguments for the custom post type
    $args = array(
        'label'                 => __( 'Family Members', 'textdomain' ),
        'description'           => __( 'Custom post type for family members', 'textdomain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-users',
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
    register_post_type( 'family_member', $args );

}

add_action( 'add_meta_boxes', 'custom_family_member_meta_boxes' );

// Define the custom meta boxes
function custom_family_member_meta_boxes() {

    add_meta_box(
        'family_member_details', // ID
        __( 'Family Member Details', 'textdomain' ), // Title
        'custom_family_member_bio_callback', // Callback
        'family_member', // Screen
        'normal', // Context
        'high' // Priority
    );

}
// Define the callback for the custom meta box
function custom_family_member_bio_callback( $post ) {

    wp_nonce_field( basename( __FILE__ ), 'custom_family_member_nonce' );
    $bio = get_post_meta( $post->ID, '_family_member_bio', true );
    $name = get_post_meta( $post->ID, '_family_member_name', true );
    $age = get_post_meta( $post->ID, '_family_member_age', true );
    $gender = get_post_meta( $post->ID, '_family_member_gender', true );
    $grade = get_post_meta( $post->ID, '_family_member_grade', true );
    $relationship = get_post_meta( $post->ID, '_family_member_relationship', true );
    $clothing_size = get_post_meta( $post->ID, '_family_member_clothing_size', true );
    $shoe_size = get_post_meta( $post->ID, '_family_member_shoe_size', true );
    $arts_and_crafts = get_post_meta( $post->ID, '_family_member_arts_and_crafts', true );
	if ( is_array( $arts_and_crafts ) ) {
    $arts_and_crafts = implode( ',', $arts_and_crafts );
	}
	$arts_and_crafts_array = explode( ',', $arts_and_crafts );
	
    $sports = get_post_meta( $post->ID, '_family_member_sports', true );
    if ( is_array( $sports ) ) {
        $sports = implode( ',', $sports );
        }
    $sports_array = explode( ',', $sports );
    $going_out = get_post_meta( $post->ID, '_family_member_going_out', true );
    if ( is_array( $going_out ) ) {
        $going_out = implode( ',', $going_out );
        }
        $going_out_array = explode( ',', $going_out );
    $staying_in = get_post_meta( $post->ID, '_family_member_staying_in', true );
    if ( is_array( $staying_in ) ) {
        $staying_in = implode( ',', $staying_in );
        }
        $staying_in_array = explode( ',', $staying_in );    
        
    $food_and_drink = get_post_meta( $post->ID, '_family_member_food_and_drink', true );
    if ( is_array( $food_and_drink ) ) {
        $food_and_drink = implode( ',', $food_and_drink );
        }
        $food_and_drink_array = explode( ',', $food_and_drink );    

    $traveling = get_post_meta( $post->ID, '_family_member_traveling', true );
    if ( is_array( $traveling ) ) {
        $traveling = implode( ',', $traveling );
        }
        $traveling_array = explode( ',', $traveling );

    $pets = get_post_meta( $post->ID, '_family_member_pets', true );
    if ( is_array( $pets ) ) {
        $pets = implode( ',', $pets );
        }
        $pets_array = explode( ',', $pets );
    $values_and_traits = get_post_meta( $post->ID, '_family_member_values_and_traits', true );
    if ( is_array( $values_and_traits ) ) {
        $values_and_traits = implode( ',', $values_and_traits );
        }
        $values_and_traits_array = explode( ',', $values_and_traits );

        

    /* picture (in progress)
    $thumbnail = get_post_meta( $post->ID, '_thumbnail_id', true );
    $image_src = wp_get_attachment_image_src( $thumbnail, 'medium' );
    ?>
    <div class="misc-pub-section">
    <label for="family_member_image"><?php _e( 'Image', 'textdomain' ); ?></label>
    <?php if ( $image_src ) : ?>
        <img src="<?php echo $image_src[0]; ?>" alt="" style="max-width:100%;height:auto;">
    <?php endif; ?>
    <input type="file" name="family_member_image" id="family_member_image" accept="image/*">
    </div> */

    ?>

    <div class="misc-pub-section">
    <label for="family_member_name"><?php _e( 'Name', 'textdomain' ); ?></label>
    <input type="text" name="family_member_name" id="family_member_name" value="<?php echo esc_attr( $name ); ?>">
    </div>
    <div class="misc-pub-section">
    <label for="family_member_age"><?php _e( 'Age', 'textdomain' ); ?></label>
    <input type="number" name="family_member_age" id="family_member_age" value="<?php echo esc_attr( $age ); ?>">
    </div>
    <div class="misc-pub-section">
    <label for="family_member_gender"><?php _e( 'Gender', 'textdomain' ); ?></label>
    <select name="family_member_gender" id="family_member_gender">
    <option value="">-- Select --</option>
    <option value="male" <?php selected( $gender, 'male' ); ?>><?php _e( 'Male', 'textdomain' ); ?></option>
    <option value="female" <?php selected( $gender, 'female' ); ?>><?php _e( 'Female', 'textdomain' ); ?></option>
    <option value="other" <?php selected( $gender, 'other' ); ?>><?php _e( 'Other', 'textdomain' ); ?></option>
    </select>
    </div>
    <div class="misc-pub-section">
    <label for="family_member_grade"><?php _e( 'Grade', 'textdomain' ); ?></label>
    <input type="text" name="family_member_grade" id="family_member_grade" value="<?php echo esc_attr( $grade ); ?>">
    </div>
    <div class="misc-pub-section">
    <label for="family_member_relationship"><?php _e( 'Relationship', 'textdomain' ); ?></label>
    <input type="text" name="family_member_relationship" id="family_member_relationship" value="<?php echo esc_attr( $relationship ); ?>">
    </div>
    <div class="misc-pub-section">
    <label for="family_member_clothing_size"><?php _e( 'Clothing Size', 'textdomain' ); ?></label>
    <input type="text" name="family_member_clothing_size" id="family_member_clothing_size" value="<?php echo esc_attr( $clothing_size ); ?>">
    </div>
    <div class="misc-pub-section">
    <label for="family_member_shoezise_size"><?php _e( 'Shoe Size', 'textdomain' ); ?></label>
    <input type="text" name="family_member_shoe_size" id="family_member_shoe_size" value="<?php echo esc_attr( $shoe_size ); ?>">
    </div>

    <div class="misc-pub-section">
    <label><?php _e( 'Arts and crafts:', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_arts_and_crafts[]" value="arts-crafts" <?php checked( in_array( 'arts-crafts', $arts_and_crafts_array ) ); ?>> <?php _e( 'Arts and Crafts', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_arts_and_crafts[]" value="dancing" <?php checked( in_array( 'dancing', $arts_and_crafts_array ) ); ?>> <?php _e( 'Dancing', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_arts_and_crafts[]" value="design" <?php checked( in_array( 'design', $arts_and_crafts_array ) ); ?>> <?php _e( 'Design', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_arts_and_crafts[]" value="make-up" <?php checked( in_array( 'make-up', $arts_and_crafts_array ) ); ?>> <?php _e( 'Make-up', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_arts_and_crafts[]" value="photography" <?php checked( in_array( 'photography', $arts_and_crafts_array ) ); ?>> <?php _e( 'Photography', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_arts_and_crafts[]" value="singing" <?php checked( in_array( 'singing', $arts_and_crafts_array ) ); ?>> <?php _e( 'Singing', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_arts_and_crafts[]" value="writing" <?php checked( in_array( 'writing', $arts_and_crafts_array ) ); ?>> <?php _e( 'Writing', 'textdomain' ); ?></label><br>
</div>

<div class="misc-pub-section">
    <label><?php _e( 'Going out:', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_going_out[]" value="concerts" <?php checked( in_array( 'concerts', $going_out_array ) ); ?>> <?php _e( 'Concerts', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_going_out[]" value="stand-up" <?php checked( in_array( 'stand-up', $going_out_array ) ); ?>> <?php _e( 'Stand up', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_going_out[]" value="theater" <?php checked( in_array( 'theater', $going_out_array ) ); ?>> <?php _e( 'Theater', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_going_out[]" value="bars" <?php checked( in_array( 'bars', $going_out_array ) ); ?>> <?php _e( 'Bars', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_going_out[]" value="cafe-hopping" <?php checked( in_array( 'cafe-hopping', $going_out_array ) ); ?>> <?php _e( 'Cafe hopping', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_going_out[]" value="festivals" <?php checked( in_array( 'festivals', $going_out_array ) ); ?>> <?php _e( 'Festivals', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_going_out[]" value="karaoke" <?php checked( in_array( 'karaoke', $going_out_array ) ); ?>> <?php _e( 'Karaoke', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_going_out[]" value="museums" <?php checked( in_array( 'museums', $going_out_array ) ); ?>> <?php _e( 'Museums', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_going_out[]" value="art-galleries" <?php checked( in_array( 'art-galleries', $going_out_array ) ); ?>> <?php _e( 'Art galleries', 'textdomain' ); ?></label><br>
    
</div>

<div class="misc-pub-section">
    <label><?php _e( 'sports:', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="badminton" <?php checked( in_array( 'badminton', $sports_array ) ); ?>> <?php _e( 'Badminton', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="baseball" <?php checked( in_array( 'baseball', $sports_array ) ); ?>> <?php _e( 'Baseball', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="basketball" <?php checked( in_array( 'basketball', $sports_array ) ); ?>> <?php _e( 'Basketball', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="bowling" <?php checked( in_array( 'bowling', $sports_array ) ); ?>> <?php _e( 'Bowling', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="crew" <?php checked( in_array( 'crew', $sports_array ) ); ?>> <?php _e( 'Crew', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="tennis" <?php checked( in_array( 'tennis', $sports_array ) ); ?>> <?php _e( 'Tennis', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="football" <?php checked( in_array( 'football', $sports_array ) ); ?>> <?php _e( 'Football', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="pickleBall" <?php checked( in_array( 'pickleBall', $sports_array ) ); ?>> <?php _e( 'PickleBall', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="go-karting" <?php checked( in_array( 'go-karting', $sports_array ) ); ?>> <?php _e( 'Go karting', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="gymnastics" <?php checked( in_array( 'gymnastics', $sports_array ) ); ?>> <?php _e( 'Gymnastics', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="horseback-riding" <?php checked( in_array( 'horseback-riding', $sports_array ) ); ?>> <?php _e( 'Horseback Riding', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="mountain-biking" <?php checked( in_array( 'mountain-biking', $sports_array ) ); ?>> <?php _e( 'Mountain Biking', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="cycling" <?php checked( in_array( 'cycling', $sports_array ) ); ?>> <?php _e( 'Cycling', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="golf" <?php checked( in_array( 'golf', $sports_array ) ); ?>> <?php _e( 'Golf', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="pilates-yoga" <?php checked( in_array( 'pilates-yoga', $sports_array ) ); ?>> <?php _e( 'Pilates Yoga', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="skiing" <?php checked( in_array( 'skiing', $sports_array ) ); ?>> <?php _e( 'Skiing', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="soccer" <?php checked( in_array( 'soccer', $sports_array ) ); ?>> <?php _e( 'Soccer', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="skateboarding" <?php checked( in_array( 'skateboarding', $sports_array ) ); ?>> <?php _e( 'Skateboarding', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="surfing" <?php checked( in_array( 'surfing', $sports_array ) ); ?>> <?php _e( 'Surfing', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="swimming" <?php checked( in_array( 'swimming', $sports_array ) ); ?>> <?php _e( 'Swimming', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="track" <?php checked( in_array( 'track', $sports_array ) ); ?>> <?php _e( 'Track', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="volleyball" <?php checked( in_array( 'volleyball', $sports_array ) ); ?>> <?php _e( 'Volleyball', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_sports[]" value="running" <?php checked( in_array( 'running', $sports_array ) ); ?>> <?php _e( 'Running', 'textdomain' ); ?></label><br>

</div>


<div class="misc-pub-section">
    <label><?php _e( 'Staying in:', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_staying_in[]" value="board-games" <?php checked( in_array( 'board-games', $staying_in_array ) ); ?>> <?php _e( 'board games', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_staying_in[]" value="gardening" <?php checked( in_array( 'gardening', $staying_in_array ) ); ?>> <?php _e( 'Gardening', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_staying_in[]" value="baking" <?php checked( in_array( 'baking', $staying_in_array ) ); ?>> <?php _e( 'Baking', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_staying_in[]" value="cooking" <?php checked( in_array( 'cooking', $staying_in_array ) ); ?>> <?php _e( 'Cooking', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_staying_in[]" value="takeout" <?php checked( in_array( 'takeout', $staying_in_array ) ); ?>> <?php _e( 'Takeout', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_staying_in[]" value="video-games" <?php checked( in_array( 'video-games', $staying_in_array ) ); ?>> <?php _e( 'video games', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_staying_in[]" value="movies" <?php checked( in_array( 'movies', $staying_in_array ) ); ?>> <?php _e( 'Movies', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_staying_in[]" value="reading" <?php checked( in_array( 'reading', $staying_in_array ) ); ?>> <?php _e( 'Reading', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_staying_in[]" value="meditation" <?php checked( in_array( 'meditation', $staying_in_array ) ); ?>> <?php _e( 'Meditation', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_staying_in[]" value="music" <?php checked( in_array( 'music', $staying_in_array ) ); ?>> <?php _e( 'Music', 'textdomain' ); ?></label><br> 
</div>

<div class="misc-pub-section">
    <label><?php _e( 'Food and drink:', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_food_and_drink[]" value="beer" <?php checked( in_array( 'beer', $food_and_drink_array ) ); ?>> <?php _e( 'beer', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_food_and_drink[]" value="coffee" <?php checked( in_array( 'coffee', $food_and_drink_array ) ); ?>> <?php _e( 'coffee', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_food_and_drink[]" value="cocktails" <?php checked( in_array( 'cocktails', $food_and_drink_array ) ); ?>> <?php _e( 'cocktails', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_food_and_drink[]" value="tea" <?php checked( in_array( 'tea', $food_and_drink_array ) ); ?>> <?php _e( 'tea', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_food_and_drink[]" value="sushi" <?php checked( in_array( 'sushi', $food_and_drink_array ) ); ?>> <?php _e( 'sushi', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_food_and_drink[]" value="sweet-tooth" <?php checked( in_array( 'sweet-tooth', $food_and_drink_array ) ); ?>> <?php _e( 'sweet-tooth', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_food_and_drink[]" value="tacos" <?php checked( in_array( 'tacos', $food_and_drink_array ) ); ?>> <?php _e( 'tacos', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_food_and_drink[]" value="vegan" <?php checked( in_array( 'vegan', $food_and_drink_array ) ); ?>> <?php _e( 'vegan', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_food_and_drink[]" value="vegetarian" <?php checked( in_array( 'vegetarian', $food_and_drink_array ) ); ?>> <?php _e( 'vegetarian', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_food_and_drink[]" value="Wine" <?php checked( in_array( 'Wine', $food_and_drink_array ) ); ?>> <?php _e( 'Wine', 'textdomain' ); ?></label><br> 
</div>

<div class="misc-pub-section">
    <label><?php _e( 'Traveling:', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_traveling[]" value="backpacking" <?php checked( in_array( 'backpacking', $traveling_array ) ); ?>> <?php _e( 'Backpacking', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_traveling[]" value="beaches" <?php checked( in_array( 'beaches', $traveling_array ) ); ?>> <?php _e( 'Beaches', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_traveling[]" value="camping" <?php checked( in_array( 'camping', $traveling_array ) ); ?>> <?php _e( 'Camping', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_traveling[]" value="big-cities" <?php checked( in_array( 'big-cities', $traveling_array ) ); ?>> <?php _e( 'Big cities', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_traveling[]" value="fishing" <?php checked( in_array( 'fishing', $traveling_array ) ); ?>> <?php _e( 'Fishing', 'Textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_traveling[]" value="hiking" <?php checked( in_array( 'hiking', $traveling_array ) ); ?>> <?php _e( 'Hiking', 'Textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_traveling[]" value="road-trips" <?php checked( in_array( 'road-trips', $traveling_array ) ); ?>> <?php _e( 'Road Trips', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_traveling[]" value="spa-weekends" <?php checked( in_array( 'spa-weekends', $traveling_array ) ); ?>> <?php _e( 'Spa weekends', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_traveling[]" value="staycations" <?php checked( in_array( 'staycations', $traveling_array ) ); ?>> <?php _e( 'Ataycations', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_traveling[]" value="winter-sports-destinations" <?php checked( in_array( 'winter-sports-destinations', $traveling_array ) ); ?>> <?php _e( 'Winter sports destinations', 'textdomain' ); ?></label><br> 
</div>

<div class="misc-pub-section">
    <label><?php _e( 'Pets:', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_pets[]" value="birds" <?php checked( in_array( 'birds', $pets_array ) ); ?>> <?php _e( 'birds', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_pets[]" value="cats" <?php checked( in_array( 'cats', $pets_array ) ); ?>> <?php _e( 'cats', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_pets[]" value="dogs" <?php checked( in_array( 'dogs', $pets_array ) ); ?>> <?php _e( 'dogs', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_pets[]" value="fishing" <?php checked( in_array( 'fishing', $pets_array ) ); ?>> <?php _e( 'fishing', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_pets[]" value="lizards" <?php checked( in_array( 'lizards', $pets_array ) ); ?>> <?php _e( 'lizards', 'Textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_pets[]" value="snakes" <?php checked( in_array( 'snakes', $pets_array ) ); ?>> <?php _e( 'snakes', 'Textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_pets[]" value="rabbits" <?php checked( in_array( 'rabbits', $pets_array ) ); ?>> <?php _e( 'rabbits', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_pets[]" value="turtles" <?php checked( in_array( 'turtles', $pets_array ) ); ?>> <?php _e( 'turtles', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_pets[]" value="hampsters" <?php checked( in_array( 'hampsters', $pets_array ) ); ?>> <?php _e( 'hampsters', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_pets[]" value="horses" <?php checked( in_array( 'horses', $pets_array ) ); ?>> <?php _e( 'horses' ); ?></label><br> 
</div>
<div class="misc-pub-section">
    <label><?php _e( 'Values and Traits:', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_values_and_traits[]" value="ambition" <?php checked( in_array( 'ambition', $values_and_traits_array ) ); ?>> <?php _e( 'Ambition', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_values_and_traits[]" value="being-active" <?php checked( in_array( 'being-active', $values_and_traits_array ) ); ?>> <?php _e( 'Being-active', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_values_and_traits[]" value="family-oriented" <?php checked( in_array( 'family-oriented', $values_and_traits_array ) ); ?>> <?php _e( 'Family-oriented', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_values_and_traits[]" value="confidence" <?php checked( in_array( 'confidence', $values_and_traits_array ) ); ?>> <?php _e( 'Confidence', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_values_and_traits[]" value="creativity" <?php checked( in_array( 'creativity', $values_and_traits_array ) ); ?>> <?php _e( 'Creativity', 'Textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_values_and_traits[]" value="empathy" <?php checked( in_array( 'empathy', $values_and_traits_array ) ); ?>> <?php _e( 'Empathy', 'Textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_values_and_traits[]" value="intelligence" <?php checked( in_array( 'intelligence', $values_and_traits_array ) ); ?>> <?php _e( 'Intelligence', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_values_and_traits[]" value="positivity" <?php checked( in_array( 'positivity', $values_and_traits_array ) ); ?>> <?php _e( 'Positivity', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_values_and_traits[]" value="sense-of-adventure" <?php checked( in_array( 'sense-of-adventure', $values_and_traits_array ) ); ?>> <?php _e( 'Sense of adventure', 'textdomain' ); ?></label><br>
    <label><input type="checkbox" name="family_member_values_and_traits[]" value="sense-of-humor" <?php checked( in_array( 'sense-of-humor', $values_and_traits_array ) ); ?>> <?php _e( 'sense of humor' ); ?></label><br>
    <label><input type="checkbox" name="family_member_values_and_traits[]" value="religious" <?php checked( in_array( 'religious', $values_and_traits_array ) ); ?>> <?php _e( 'Religious' ); ?></label><br> 
    <label><input type="checkbox" name="family_member_values_and_traits[]" value="politically-active" <?php checked( in_array( 'politically-active', $values_and_traits_array ) ); ?>> <?php _e( 'Politically active' ); ?></label><br>  
</div>



    
    <div class="misc-pub-section">
        <label for="family_member_bio"><?php _e( 'Bio', 'textdomain' ); ?></label>
        <textarea name="family_member_bio" id="family_member_bio" rows="5" style="width: 100%;"><?php echo esc_textarea( $bio ); ?></textarea>
    </div>
 

<?php
}
// Save the data entered by the user in the custom meta box
function save_custom_meta_box_data($post_id) {
    // Check if the nonce is set
    if (!isset($_POST['custom_meta_box_nonce'])) {
        return;
    }
 
    // Verify that the nonce is valid
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], 'custom_meta_box_nonce')) {
        return;
    }
 
    // Check if the current user has permission to save the post
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
 
    // Save the data entered by the user in the custom meta box
    if (isset($_POST['custom_meta_box_field'])) {
        update_post_meta($post_id, '_custom_meta_box_field', sanitize_text_field($_POST['custom_meta_box_field']));
    }
}
add_action( 'save_post', 'custom_family_member_save_meta' );

function custom_family_member_save_meta( $post_id ) {

    // Verify nonce
    if ( ! isset( $_POST['custom_family_member_nonce'] ) || ! wp_verify_nonce( $_POST['custom_family_member_nonce'], basename( __FILE__ ) ) ) {
        return;
    }

    // Check if autosaving
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check user permissions
    if ( isset( $_POST['post_type'] ) && 'family_member' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

    }

    // Update custom meta fields
    if ( isset( $_POST['family_member_name'] ) ) {
        update_post_meta( $post_id, '_family_member_name', sanitize_text_field( $_POST['family_member_name'] ) );
    }
    if ( isset( $_POST['family_member_age'] ) ) {
        update_post_meta( $post_id, '_family_member_age', sanitize_text_field( $_POST['family_member_age'] ) );
    }
    if ( isset( $_POST['family_member_gender'] ) ) {
        update_post_meta( $post_id, '_family_member_gender', sanitize_text_field( $_POST['family_member_gender'] ) );
    }
    if ( isset( $_POST['family_member_grade'] ) ) {
        update_post_meta( $post_id, '_family_member_grade', sanitize_text_field( $_POST['family_member_grade'] ) );
    }
    if ( isset( $_POST['family_member_relationship'] ) ) {
        update_post_meta( $post_id, '_family_member_relationship', sanitize_text_field( $_POST['family_member_relationship'] ) );
    }
    if ( isset( $_POST['family_member_clothing_size'] ) ) {
        update_post_meta( $post_id, '_family_member_clothing_size', sanitize_text_field( $_POST['family_member_clothing_size'] ) );
    }
    if ( isset( $_POST['family_member_shoe_size'] ) ) {
        update_post_meta( $post_id, '_family_member_shoe_size', sanitize_text_field( $_POST['family_member_shoe_size'] ) );
    }
    if ( isset( $_POST['family_member_arts_and_crafts'] ) ) {
        // Convert the checkbox array into a comma-separated string
        $arts_and_crafts_array = implode(',', $_POST['family_member_arts_and_crafts']);

        // Update the meta value with the comma-separated string
        update_post_meta( $post_id, '_family_member_arts_and_crafts', sanitize_text_field( $arts_and_crafts_array ) );
    }

    if ( isset( $_POST['family_member_sports'] ) ) {
        // Convert the checkbox array into a comma-separated string
        $sports_array = implode(',', $_POST['family_member_sports']);

        // Update the meta value with the comma-separated string
        update_post_meta( $post_id, '_family_member_sports', sanitize_text_field( $sports_array ) );
    }

    if ( isset( $_POST['family_member_going_out'] ) ) {
        // Convert the checkbox array into a comma-separated string
        $going_out_array = implode(',', $_POST['family_member_going_out']);

        // Update the meta value with the comma-separated string
        update_post_meta( $post_id, '_family_member_going_out', sanitize_text_field( $going_out_array ) );
    }
    
    if ( isset( $_POST['family_member_staying_in'] ) ) {
        $staying_in_array = implode(',', $_POST['family_member_staying_in']);
        update_post_meta( $post_id, '_family_member_staying_in', sanitize_text_field( $staying_in_array ) );
    }

    if ( isset( $_POST['family_member_food_and_drink'] ) ) {
        $food_and_drink_array = implode(',', $_POST['family_member_food_and_drink']);
        update_post_meta( $post_id, '_family_member_food_and_drink', sanitize_text_field( $food_and_drink_array ) );
    }
    
    if ( isset( $_POST['family_member_traveling'] ) ) {
        $traveling_array = implode(',', $_POST['family_member_traveling']);
        update_post_meta( $post_id, '_family_member_traveling', sanitize_text_field( $traveling_array ) );
    }

    if ( isset( $_POST['family_member_pets'] ) ) {
        $pets_array = implode(',', $_POST['family_member_pets']);
        update_post_meta( $post_id, '_family_member_pets', sanitize_text_field( $pets_array ) );
    }

    
    if ( isset( $_POST['family_member_values_and_traits'] ) ) {
        $values_and_traits_array = implode(',', $_POST['family_member_values_and_traits']);
        update_post_meta( $post_id, '_family_member_values_and_traits', sanitize_text_field( $values_and_traits_array ) );
    }


    if ( isset( $_POST['family_member_bio'] ) ) {
        update_post_meta( $post_id, '_family_member_bio', sanitize_textarea_field( $_POST['family_member_bio'] ) );
    }

    /* Picture in Progress
    if( isset( $_FILES['family_member_image'] ) && $_FILES['family_member_image']['error'] == 0 ) {

        $attachment_id = media_handle_upload( 'family_member_image', $post->ID );
        if ( is_wp_error( $attachment_id ) ) {
            // There was an error uploading the image.
        } else {
            update_post_meta( $post->ID, '_thumbnail_id', $attachment_id );
        }
    }*/

}
 
add_action('save_post', 'save_custom_meta_box_data');

// Add a custom column to the family member post type table
add_filter( 'manage_family_member_posts_columns', 'custom_family_member_columns' );

// Define the custom column for the family member post type table
function custom_family_member_columns( $columns ) {
    $columns['family_member_bio'] = __( 'Bio', 'textdomain' );
    return $columns;
}
// Populate the custom column in the family member post type table
add_action( 'manage_family_member_posts_custom_column', 'custom_family_member_bio_column', 10, 2 );

// Define the callback for populating the custom column in the family member post type table
function custom_family_member_bio_column( $column, $post_id ) {
	switch ( $column ) {
    case 'family_member_bio':
        echo get_post_meta( $post_id, '_family_member_bio', true );
        break;
}}

function create_family_member_form_shortcode() {
    ob_start();
    ?>
    <form method="post" action="">
        <label for="family_member_name">Name</label>
            <input type="text" name="family_member_name" id="family_member_name" required>
        <br>
        <label for="family_member_age">Family member age</label>
            <input type="text" name="family_member_age" id="family_member_age" required> 
        <br>
        <label for="family_member_gender">Gender</label>
            <select name="family_member_gender" id="family_member_gender">
                <option value="">-- Select --</option>
                <option value="male">male</option>
                <option value="female" >female</option>
                <option value="other">other</option>
            </select>
        <br>    
        <label for="family_member_grade">family member grade</label>
            <input type="text" name="family_member_grade" id="family_member_grade">
        <br>
        <label for="family_member_relationship">Relationship to you</label>
            <input type="text" name="family_member_relationship" id="family_member_relationship" required>       
        <br>
        <label for="family_member_clothing_size">Clothing size</label>
            <select name="family_member_clothing_size" id="family_member_clothing_size">
                <option value="">-- Select --</option>
                <option value="XS">XS</option>
                <option value="S" >S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
                <option value="XXXL">XXXL</option>
            </select>
        <br>
        <label for="family_member_shoe_size">Shoe Size</label>
            <input type="text" name="family_member_shoe_size" id="family_member_shoe_size"> 
        <br>
<div class="interests-container">
	<div>Arts and Crafts</div>
<label>
<input type="checkbox" name="family_member_arts_and_crafts[]" value="arts-crafts" style="display:none;" id ="family_member_arts_and_crafts">
<span class="checkbox"><i class="fa fa-paint-brush"></i> Arts & Crafts</span>
</label>
<label>
<input type="checkbox" name="family_member_arts_and_crafts[]" value="dancing" style="display:none;" id ="family_member_dancing">
<span class="checkbox"><i class="fa fa-music"> Dancing</i></span>
</label>
<label>
<input type="checkbox" name="family_member_arts_and_crafts[]" value="design" style="display:none;" id ="family_member_design">
<span class="checkbox"><i class="fa fa-paint-brush"> Design</i></span>
</label>
<label>
<input type="checkbox" name="family_member_arts_and_crafts[]" value="make-up" style="display:none;" id ="family_member_makeup">
<span class="checkbox"><i class="fa fa-lipstick"> Make up</i></span>
</label>
<label>
<input type="checkbox" name="family_member_arts_and_crafts[]" value="photography" style="display:none;" id ="family_member_photography">
<span class="checkbox"><i class="fa fa-camera"> Photography</i></span>
</label>
<label>
<input type="checkbox" name="family_member_arts_and_crafts[]" value="singing" style="display:none;" id ="family_member_singing">
<span class="checkbox"><i class="fa fa-microphone"> Singing</i></span>
</label>
<label>
<input type="checkbox" name="family_member_arts_and_crafts[]" value="writing" style="display:none;" id ="family_member_writing">
<span class="checkbox"><i class="fa fa-pencil">Writing</i></span>
</div>
<div class="interests-container">
  <div> Sports </div>
  <label>
    <input type="checkbox" name="family_member_sports[]" value="badminton" style="display:none;" id ="family_member_badminton">
    <span class="checkbox"><i class="fa fa-shuttlecock"> Badminton</i></span>
  </label>
  <label>
  <label>
    <input type="checkbox" name="family_member_sports[]" value="baseball" style="display:none;" id ="family_member_baseball">
    <span class="checkbox"><i class="fa fa-baseball-ball"> Baseball </i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_sports[]" value="basketball" style="display:none;" id ="family_member_basketball">
    <span class="checkbox"><i class="fa fa-basketball-ball"> Basketball </i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_sports[]" value="bowling" style="display:none;" id ="family_member_bowling">
    <span class="checkbox"><i class="fa fa-bowling-ball"> Bowling</i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_sports[]" value="crew" style="display:none;" id ="family_member_crew">
    <span class="checkbox"><i class="fa fa-rowing"> Crew</i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_sports[]" value="tennis" style="display:none;" id ="family_member_tennis">
    <span class="checkbox"><i class="fa fa-tennis-ball"> Tennis</i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_sports[]" value="rock-Climbing" style="display:none;" id ="family_member_rock_climbing">
    <span class="checkbox"><i class="fa fa-mountain"> Rock Climbing</i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_sports[]" value="football" style="display:none;" id ="family_member_football">
    <span class="checkbox"><i class="fa fa-football-ball"> Football</i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_sports[]" value="pickleBall" style="display:none;" id ="family_member_pickleball">
    <span class="checkbox"><i class="fa fa-volleyball-ball"> PickleBall</i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_sports[]" value="go-karting" style="display:none;" id ="family_member_go_karting">
    <span class="checkbox"><i class="fa fa-kart-racing"> Go karting</i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_sports[]" value="gymnastics" style="display:none;" id ="family_member_gymnastics">
    <span class="checkbox"><i class="fa fa-running"> Gymnastics</i></span>
  </label> 
  <label>
  <label>
  <input type="checkbox" name="family_member_sports[]" value="horseback-riding" style="display:none;" id ="family_member_horseback-riding">
  <span class="checkbox"><i class="fa fa-horse"> Horseback riding</i></span>
</label>
<label>
  <input type="checkbox" name="family_member_sports[]" value="martial-arts" style="display:none;" id ="family_member_martial-arts">
  <span class="checkbox"><i class="fa fa-kiwi-bird"> Martial arts</i></span>
</label>
<label>
  <input type="checkbox" name="family_member_sports[]" value="mountain-biking" style="display:none;" id ="family_member_mountain-biking">
  <span class="checkbox"><i class="fa fa-mountain"> Mountain Biking</i></span>
</label>
<label>
  <input type="checkbox" name="family_member_sports[]" value="cycling" style="display:none;" id ="family_member_cycling">
  <span class="checkbox"><i class="fa fa-bicycle"> Cycling</i></span>
</label>
<label>
  <input type="checkbox" name="family_member_sports[]" value="golf" style="display:none;" id ="family_member_golf">
  <span class="checkbox"><i class="fa fa-golf-ball"> Golf</i></span>
</label>
<label>
  <input type="checkbox" name="family_member_sports[]" value="pilates-yoga" style="display:none;" id ="family_member_pilates-yoga">
  <span class="checkbox"><i class="fa fa-yoga"> Pilates or Yoga</i></span>
</label>
<label>
  <input type="checkbox" name="family_member_sports[]" value="skiing" style="display:none;" id ="family_member_skiing">
  <span class="checkbox"><i class="fa fa-skiing"> Skiing</i></span>
</label>
<label>
  <input type="checkbox" name="family_member_sports[]" value="soccer" style="display:none;" id ="family_member_soccer">
  <span class="checkbox"><i class="fa fa-fútbol"> Soccer</i></span>
</label>
<label>
  <input type="checkbox" name="family_member_sports[]" value="skateboarding" style="display:none;" id ="family_member_skateboarding">
  <span class="checkbox"><i class="fa fa-skateboard"> Skateboarding</i></span>
</label>
<label>
  <input type="checkbox" name="family_member_sports[]" value="surfing" style="display:none;" id ="family_member_surfing">
  <span class="checkbox"><i class="fa fa-surfing"> Surfing</i></span>
</label>
<label>
  <input type="checkbox" name="family_member_sports[]" value="swimming" style="display:none;" id ="family_member_swimming">
  <span class="checkbox"><i class="fa fa-swimming-pool"> Swimming</i></span>
</label>
<label>
  <input type="checkbox" name="family_member_sports[]" value="track" style="display:none;" id ="family_member_track">
  <span class="checkbox"><i class="fa fa-running"> Track</i></span>
</label>
  <label>
    <input type="checkbox" name="family_member_sports[]" value="volleyball" style="display:none;" id ="family_member_track_voleyball">
    <span class="checkbox"><i class="fa fa-volleyball-ball"> Volleyball</i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_sports[]" value="running" style="display:none;" id ="family_member_running">
    <span class="checkbox"><i class="fa fa-running"> Running</i></span>
  </label>
</div>
<div class="interests-container">
  <div> Going out </div>
  <label>
    <input type="checkbox" name="family_member_going_out[]" value="concerts" style="display:none;" id ="family_member_concert">
    <span class="checkbox"><i class="fa fa-music"></i> Concerts</span>
  </label>
  <label>
    <input type="checkbox" name="family_member_going_out[]" value="stand-up" style="display:none;" id ="family_member_stand_up">
    <span class="checkbox"><i class="fa fa-microphone-alt"> Stand up</i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_going_out[]" value="theater" style="display:none;" id ="family_member_theater">
    <span class="checkbox"><i class="fa fa-theater-masks"> Theater</i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_going_out[]" value="bars" style="display:none;" id ="family_member_bars">
    <span class="checkbox"><i class="fa fa-glass-martini-alt"> Bars</i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_going_out[]" value="cafe-hopping" style="display:none;" id ="family_member_cafe_hopping">
    <span class="checkbox"><i class="fa fa-coffee"> Café-hopping</i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_going_out[]" value="festivals" style="display:none;" id ="family_member_festivals">
    <span class="checkbox"><i class="fa fa-music"> Festivals</i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_going_out[]" value="karaoke" style="display:none;" id ="family_member_karaoke">
    <span class="checkbox"><i class="fa fa-microphone-alt"> Karaoke</i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_going_out[]" value="museums" style="display:none;" id ="family_member_museums">
    <span class="checkbox"><i class="fa fa-museum"> Museums</i></span>
  </label>
  <label>
    <input type="checkbox" name="family_member_going_out[]" value="art-galleries" style="display:none;" id ="family_member_art_galleries">
    <span class="checkbox"><i class="fa fa-palette"> Art Galleries</i></span>
  </label>
</div>


<div class="interests-container">
  <div> Staying In </div>
  <label>
    <input type="checkbox" name="family_member_staying_in[]" value="board-games" style="display:none;" id ="family_member_art_board_games">
    <span class="checkbox"><i class="fa fa-game-board-alt"></i> Board Games</span>
  </label>
  <label>
    <input type="checkbox" name="family_member_staying_in[]" value="gardening" style="display:none;" id ="family_member_gardening">
    <span class="checkbox"><i class="fa fa-seedling"></i> Gardening</span>
</label>
<label>
    <input type="checkbox" name="family_member_staying_in[]" value="baking" style="display:none;" id ="family_member_baking">
    <span class="checkbox"><i class="fa fa-cookie-bite"></i> Baking</span>
</label>
<label>
    <input type="checkbox" name="family_member_staying_in[]" value="Cooking" style="display:none;" id ="family_member_cooking">
    <span class="checkbox"><i class="fa fa-utensils"></i> cooking</span>
</label>
<label>
    <input type="checkbox" name="family_member_staying_in[]" value="Takeout" style="display:none;" id ="family_member_takeout">
    <span class="checkbox"><i class="fa fa-pizza-slice"></i> takeout</span>
</label>
<label>
    <input type="checkbox" name="family_member_staying_in[]" value="video-games" style="display:none;" id ="family_member_video_games">
    <span class="checkbox"><i class="fa fa-gamepad"></i> Video games</span>
</label>
<label>
    <input type="checkbox" name="family_member_staying_in[]" value="movies" style="display:none;" id ="family_member_movies">
    <span class="checkbox"><i class="fa fa-film"></i> Movies</span>
</label>
<label>
    <input type="checkbox" name="family_member_staying_in[]" value="reading" style="display:none;" id ="family_member_reading">
    <span class="checkbox"><i class="fa fa-book-open"></i> Reading</span>
</label>
<label>
    <input type="checkbox" name="family_member_staying_in[]" value="meditation" style="display:none;" id ="family_member_meditation">
    <span class="checkbox"><i class="fa fa-om"></i> Meditation</span>
</label>
<label>
    <input type="checkbox" name="family_member_staying_in[]" value="music" style="display:none;" id ="family_member_music">
    <span class="checkbox"><i class="fa fa-music"></i> Music</span>
</label>
</div>

<div class="interests-container">
  <div> Food & Drink </div>
  <label>
    <input type="checkbox" name="family_member_food_and_drink[]" value="beer" style="display:none;" id ="family_member_beer">
    <span class="checkbox"><i class="fa fa-beer"> Beer</i> </span>
  </label>
  <label>
    <input type="checkbox" name="family_member_food_and_drink[]" value="coffee" style="display:none;" id ="family_member_coffee">
    <span class="checkbox"><i class="fa fa-coffee"> Coffee</i> </span>
</label>
<label>
    <input type="checkbox" name="family_member_food_and_drink[]" value="cocktails" style="display:none;" id ="family_member_cocktails">
    <span class="checkbox"><i class="fa fa-cocktail"> Cocktails</i> </span>
</label>
<label>
    <input type="checkbox" name="family_member_food_and_drink[]" value="tea" style="display:none;" id ="family_member_tea">
    <span class="checkbox"><i class="fa fa-tea"></i> Tea</span>
</label>
<label>
    <input type="checkbox" name="family_member_food_and_drink[]" value="sushi" style="display:none;" id ="family_member_sushi">
    <span class="checkbox"><i class="fa fa-sushi"></i> Sushi</span>
</label>
<label>
    <input type="checkbox" name="family_member_food_and_drink[]" value="sweet-tooth" style="display:none;" id ="family_member_sweet-tooth">
    <span class="checkbox"><i class="fa fa-candy-cane"></i> Sweet tooth</span>
</label>
<label>
    <input type="checkbox" name="family_member_food_and_drink[]" value="tacos" style="display:none;" id ="family_member_tacos">
    <span class="checkbox"><i class="fa fa-taco"></i> Tacos</span>
</label>
<label>
    <input type="checkbox" name="family_member_food_and_drink[]" value="vegan" style="display:none;" id ="family_member_vegan">
    <span class="checkbox"><i class="fa fa-leaf"></i> Vegan</span>
</label>
<label>
    <input type="checkbox" name="family_member_food_and_drink[]" value="vegetarian" style="display:none;" id ="family_member_vegetarian">
    <span class="checkbox"><i class="fa fa-carrot"></i> Vegetarian</span>
</label>
<label>
    <input type="checkbox" name="family_member_food_and_drink[]" value="wine" style="display:none;" id ="family_member_wine">
    <span class="checkbox"><i class="fa fa-bottle"></i> Wine</span>
</label>

</div>

<div class="interests-container">
  <div> Traveling </div>
  <label>
    <input type="checkbox" name="family_member_traveling[]" value="backpacking" style="display:none;" id ="family_member_backpacking">
    <span class="checkbox"><i class="fa fa-backpack"> </i> Backpacking</span>
  </label>
  <label>
    <input type="checkbox" name="family_member_traveling[]" value="beaches" style="display:none;" id ="family_member_beaches">
    <span class="checkbox"><i class="fa fa-umbrella-beach"> </i> Beaches</span>
  </label>
  <label>
    <input type="checkbox" name="family_member_traveling[]" value="camping" style="display:none;" id ="family_member_camping">
    <span class="checkbox"><i class="fa fa-camping"> </i> Camping</span>
  </label>
  <label>
    <input type="checkbox" name="family_member_traveling[]" value="big-cities" style="display:none;" id ="family_member_big_cities">
    <span class="checkbox"><i class="fa fa-city"> </i> Big cities</span>
  </label>
  <label>
    <input type="checkbox" name="family_member_traveling[]" value="fishing" style="display:none;" id ="family_member_fishing">
    <span class="checkbox"><i class="fa fa-fish"> Fishing</i> </span>
  </label>
  <label>
    <input type="checkbox" name="family_member_traveling[]" value="hiking" style="display:none;" id ="family_member_hiking">
    <span class="checkbox"><i class="fa fa-hiking"> Hiking</i> </span>
  </label>
  <label>
    <input type="checkbox" name="family_member_traveling[]" value="road-trips" style="display:none;" id ="family_member_road_trips">
    <span class="checkbox"><i class="fa fa-route"> Road trips</i> </span>
  </label>
  <label>
    <input type="checkbox" name="family_member_traveling[]" value="spa-weekends" style="display:none;" id ="family_member_spa_weekends">
    <span class="checkbox"><i class="fa fa-spa"> </i> Spa weekends</span>
  </label>
  <label>
    <input type="checkbox" name="family_member_traveling[]" value="staycations" style="display:none;" id ="family_member_staycations">
    <span class="checkbox"><i class="fa fa-home"> </i> Staycations</span>
  </label>
  <label>
    <input type="checkbox" name="family_member_traveling[]" value="winter-sports-destinations" style="display:none;" id ="family_member_winter_sports_destinations">
    <span class="checkbox"><i class="fa fa-snowflake"> </i> Winter Sports Destinations</span>
  </label>
</div>
<div class="interests-container">
  <div> Pets </div>
  <label>
    <input type="checkbox" name="family_member_pets[]" value="birds" style="display:none;" id ="family_member_birds">
    <span class="checkbox"><i class="fa fa-dove"> </i> Birds</span>
  </label>
  <label>
    <input type="checkbox" name="family_member_pets[]" value="cats" style="display:none;" id ="family_member_cats">
    <span class="checkbox"><i class="fa fa-cat"> </i> Cats</span>
</label>
<label>
    <input type="checkbox" name="family_member_pets[]" value="dogs" style="display:none;" id ="family_member_dogs">
    <span class="checkbox"><i class="fa fa-dog"> </i> Dogs</span>
</label>
<label>
    <input type="checkbox" name="family_member_pets[]" value="fishing" style="display:none;" id ="family_member_fishing">
    <span class="checkbox"><i class="fa fa-fish"> </i> Fishing</span>
</label>
<label>
    <input type="checkbox" name="family_member_pets[]" value="lizards" style="display:none;" id ="family_member_lizards">
    <span class="checkbox"><i class="fa fa-dragon"> </i> Lizards</span>
</label>
<label>
    <input type="checkbox" name="family_member_pets[]" value="snakes" style="display:none;" id ="family_member_snakes">
    <span class="checkbox"><i class="fa fa-snake"> </i> Snakes</span>
</label>
<label>
    <input type="checkbox" name="family_member_pets[]" value="rabbits" style="display:none;" id ="family_member_rabbits">
    <span class="checkbox"><i class="fa fa-rabbit"> </i> Rabbits</span>
</label>
<label>
    <input type="checkbox" name="family_member_pets[]" value="turtles" style="display:none;" id ="family_member_turtles">
    <span class="checkbox"><i class="fa fa-turtle"> </i> Turtles</span>
</label>
<label>
    <input type="checkbox" name="family_member_pets[]" value="hampsters" style="display:none;" id ="family_member_hamsters">
    <span class="checkbox"><i class="fa fa-hamster"> </i> Hamsters</span>
</label>
<label>
    <input type="checkbox" name="family_member_pets[]" value="horses" style="display:none;" id ="family_member_horses">
    <span class="checkbox"><i class="fa fa-horse"> </i> Horses</span>
</label>
</div>
<div class="interests-container">
  <div> Values & traits </div>
  <label>
    <input type="checkbox" name="family_member_values_and_traits[]" value="ambition" style="display:none;" id ="family_member_ambition">
    <span class="checkbox"><i class="fa fa-star"> </i> Ambition</span>
  </label>
  <label>
    <input type="checkbox" name="family_member_values_and_traits[]" value="being-active" style="display:none;" id ="family_member_being_active">
    <span class="checkbox"><i class="fa fa-running"> </i> Being active</span>
  </label>  
  <label>
    <input type="checkbox" name="family_member_values_and_traits[]" value="family-oriented" style="display:none;" id ="family_member_family_oriented">
    <span class="checkbox"><i class="fa fa-users"> </i> Family oriented</span>
  </label>  
  <label>
    <input type="checkbox" name="family_member_values_and_traits[]" value="confidence" style="display:none;" id ="family_member_confidence">
    <span class="checkbox"><i class="fa fa-trophy"> </i> Confidence</span>
  </label>  
  <label>
    <input type="checkbox" name="family_member_values_and_traits[]" value="Creativity" style="display:none;" id ="family_member_Creativity">
    <span class="checkbox"><i class="fa fa-pencil-ruler"> </i> Creativity</span>
  </label>  
  <label>
    <input type="checkbox" name="family_member_values_and_traits[]" value="empathy" style="display:none;" id ="family_member_empathy">
    <span class="checkbox"><i class="fa fa-hands-helping"> </i> Empathy</span>
  </label>  
  <label>
    <input type="checkbox" name="family_member_values_and_traits[]" value="intelligence" style="display:none;" id ="family_member_intelligence">
    <span class="checkbox"><i class="fa fa-brain"> </i> Intelligence</span>
  </label>  
  <label>
    <input type="checkbox" name="family_member_values_and_traits[]" value="positivity" style="display:none;" id ="family_member_positivity">
    <span class="checkbox"><i class="fa fa-smile-beam"> </i> Positivity</span>
  </label>  
  <label>
    <input type="checkbox" name="family_member_values_and_traits[]" value="sense-of-adventure" style="display:none;" id ="family_member_sense_of_adventure">
    <span class="checkbox"><i class="fa fa-compass"> </i> Sense of adventure</span>
  </label>  
  <label>
    <input type="checkbox" name="family_member_values_and_traits[]" value="sense-of-humor" style="display:none;" id ="family_member_sense-of_humor">
    <span class="checkbox"><i class="fa fa-grin-squint-tears"> </i> Sense of humor</span>
  </label>  
  <label>
    <input type="checkbox" name="family_member_values_and_traits[]" value="religious" style="display:none;" id ="family_member_religious">
    <span class="checkbox"><i class="fa fa-cross"> </i> Religious</span>
  </label>  
  <label>
    <input type="checkbox" name="family_member_values_and_traits[]" value="politically-active" style="display:none;" id ="family_member_politically-active">
    <span class="checkbox"><i class="fa fa-vote-yea"> </i> Politically Active</span>
  </label>
    </div>
</label>

        <label for="family_member_bio">Bio</label>
            <textarea name="family_member_bio" id="family_member_bio" required></textarea>
        
            
        <!--<br>
        <label for="family_member_image" enctype="multipart/form-data">Featured Image</label>
        <input type="file" name="family_member_image" id="family_member_image">-->
        
            <?php wp_nonce_field( 'create_family_member_nonce', 'create_family_member_nonce' ); ?>
        <input type="submit" value="Create Family Member">
    </form>
    <?php
    $output = ob_get_clean();

    if ( isset( $_POST['create_family_member_nonce'] ) && wp_verify_nonce( $_POST['create_family_member_nonce'], 'create_family_member_nonce' ) ) {
        $name = sanitize_text_field( $_POST['family_member_name'] );
        $bio = sanitize_textarea_field( $_POST['family_member_bio'] );
        $age = sanitize_textarea_field( $_POST['family_member_age'] );
        $gender = sanitize_textarea_field( $_POST['family_member_gender']);
        $grade = sanitize_textarea_field( $_POST['family_member_grade'] );
        $relationship =sanitize_textarea_field( $_POST['family_member_relationship'] );
        $clothing_size = sanitize_textarea_field($_POST['family_member_clothing_size'] );
        $shoe_size = sanitize_textarea_field( $_POST['family_member_shoe_size'] );
       $arts_and_crafts = isset( $_POST['family_member_arts_and_crafts'] ) ? array_map( 'sanitize_text_field', $_POST['family_member_arts_and_crafts'] ) : array();
       $sports = isset( $_POST['family_member_sports'] ) ? array_map( 'sanitize_text_field', $_POST['family_member_sports'] ) : array();
       $going_out = isset( $_POST['family_member_going_out'] ) ? array_map( 'sanitize_text_field', $_POST['family_member_going_out'] ) : array();
       $staying_in = isset( $_POST['family_member_staying_in'] ) ? array_map( 'sanitize_text_field', $_POST['family_member_staying_in'] ) : array();
       $food_and_drink = isset( $_POST['family_member_food_and_drink'] ) ? array_map( 'sanitize_text_field', $_POST['family_member_food_and_drink'] ) : array();
       $traveling = isset( $_POST['family_member_traveling'] ) ? array_map( 'sanitize_text_field', $_POST['family_member_traveling'] ) : array();
       $pets = isset( $_POST['family_member_pets'] ) ? array_map( 'sanitize_text_field', $_POST['family_member_pets'] ) : array();
		$values_and_traits = isset( $_POST['family_member_values_and_traits'] ) ? array_map( 'sanitize_text_field', $_POST['family_member_values_and_traits'] ) : array();

        $new_post = array(
            'post_title'   => $name,
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'family_member',
            'meta_input'   => array(
                '_family_member_bio' => $bio,
                '_family_member_age' => $age,
                '_family_member_gender' => $gender,
                '_family_member_grade'=>$grade,
                '_family_member_relationship'=>$relationship,
                '_family_member_clothing_size'=>$clothing_size,
                '_family_member_shoe_size'=>$shoe_size,
                '_family_member_arts_and_crafts'=>$arts_and_crafts,
                '_family_member_sports'=>$sports,
                '_family_member_going_out'=>$going_out,
                '_family_member_staying_in'=>$staying_in,
                '_family_member_food_and_drink'=>$food_and_drink,
                '_family_member_traveling'=>$traveling,
                '_family_member_pets'=>$pets,
				'_family_member_values_and_traits'=>$values_and_traits,
                

            ),
        );
        
        $post_id = wp_insert_post( $new_post );
        if ( $post_id ) {
            $output .= '<p class="success">Family Member created successfully!</p>';
        } else {
            $output .= '<p class="error">There was an error creating the Family Member.</p>';
        }
    }

    return $output;
}
add_shortcode( 'create_family_member_form', 'create_family_member_form_shortcode' );

function display_family_members_shortcode() {
  $args = array(
      'post_type' => 'family_member',
      'author' => get_current_user_id(),
      'posts_per_page' => -1
  );
  $family_members = new WP_Query( $args );
  
  if ( $family_members->have_posts() ) {
      echo '<div class="family-members">';
      while ( $family_members->have_posts() ) {
          $family_members->the_post();
          $post_title = get_the_title();
          $post_link = get_permalink();
          $relationship = get_post_meta( get_the_ID(), '_family_member_relationship', true );
          $age = get_post_meta( get_the_ID(), '_family_member_age', true );
          $thumbnail = get_the_post_thumbnail( get_the_ID(), 'medium' ); // Get the post thumbnail (medium size)
          
          echo '<div class="family-member">';
          echo '<a href="' . $post_link . '">' . $thumbnail . $post_title . '</a>'; // Display the thumbnail and the post title inside the link
          echo '<p class="relationship">' . $relationship . '</p>';
          echo '<p class="age">' . $age . '</p>';
          echo '</div>';
      }
      echo '</div>';
      wp_reset_postdata();
  } else {
      echo 'No family members found.';
  }
}

add_shortcode( 'display_family_members', 'display_family_members_shortcode' );
function display_family_member_interest_shortcode() {
  $args = array(
      'post_type' => 'family_member',
      'author' => get_current_user_id(),
      'posts_per_page' => 1
  );
  $family_members = new WP_Query( $args );

  if ( $family_members->have_posts() ) {
    $family_members->the_post();
    $interests = array(
      array('category' => 'Arts and Crafts', 'value' => get_post_meta( get_the_ID(), '_family_member_arts_and_crafts', true )),
      array('category' => 'Sports', 'value' => get_post_meta( get_the_ID(), '_family_member_sports', true )),
      array('category' => 'Going Out', 'value' => get_post_meta( get_the_ID(), '_family_member_going_out', true )),
      array('category' => 'Staying In', 'value' => get_post_meta( get_the_ID(), '_family_member_staying_in', true )),
      array('category' => 'Food and Drink', 'value' => get_post_meta( get_the_ID(), '_family_member_food_and_drink', true )),
      array('category' => 'Traveling', 'value' => get_post_meta( get_the_ID(), '_family_member_traveling', true )),
      array('category' => 'Pets', 'value' => get_post_meta( get_the_ID(), '_family_member_pets', true ))
    );
    echo '<ul>';
    foreach ($interests as $interest) {
      if (is_array($interest['value'])) {
        $value = implode(', ', $interest['value']);
      } else {
        $value = $interest['value'];
      }
      echo '<li><strong>' . $interest['category'] . ': </strong>' . $value . '</li>';
    }
    echo '</ul>';
    wp_reset_postdata();
  } else {
      echo 'No family members found.';
  }
}
add_shortcode( 'display_family_member_interest', 'display_family_member_interest_shortcode' );
function family_members_featured_image_form_shortcode() {
  $post_id = get_the_ID(); // Get the current post ID

  // Handle form submission
  if ( isset( $_POST['set_featured_image'] ) ) {
    $featured_image = $_FILES['featured_image'];

    // Check if image was uploaded
    if ( ! empty( $featured_image['tmp_name'] ) ) {
      // Upload the image and set it as the post's featured image
      $attachment_id = media_handle_upload( 'featured_image', $post_id );
      set_post_thumbnail( $post_id, $attachment_id );

      // Show success message
      echo '<p class="success">Featured image set successfully!</p>';
    } else {
      // Show error message
      echo '<p class="error">Please select an image to set as the featured image.</p>';
    }
  }

  ob_start();
?>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">

    <label for="featured_image">Featured Image:</label>
    <input type="file" id="featured_image" name="featured_image" accept="image/*" required>

    <input type="submit" name="set_featured_image" value="Set Featured Image">
  </form>
<?php
  return ob_get_clean();
}
add_shortcode( 'family_members_featured_image_form', 'family_members_featured_image_form_shortcode' );
function check_post_featured_image() {
    global $post;
    if (has_post_thumbnail($post->ID)) {
        return;
    } else {
        return '[family_members_featured_image_form]';
    }
}
add_shortcode('check_featured_image', 'check_post_featured_image');