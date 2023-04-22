<?php 
add_action( 'elementor_pro/forms/new_record',  'thewpchannel_elementor_form_create_new_user' , 10, 2 );
add_action( 'after_setup_theme', 'hide_admin_bar_for_subscriber' );
add_action( 'template_redirect', 'redirect_subscriber_from_signup' );
add_shortcode( 'happygifter_user_info', 'happygifter_user_info_shortcode' );
function thewpchannel_elementor_form_create_new_user($record,$ajax_handler)
{
    $form_name = $record->get_form_settings('form_name');
    //Check that the form is the "create new user form" if not - stop and return;
    if ('sign up' !== $form_name) {
        return;
    }
    $form_data = $record->get_formatted_data();
    $username=$form_data['Username']; //Get tne value of the input with the label "User Name"
    $password = $form_data['Password']; //Get tne value of the input with the label "Password"
    $email=$form_data['Email'];  //Get tne value of the input with the label "Email"
    $user = wp_create_user($username,$password,$email); // Create a new user, on success return the user_id no failure return an error object
    if (is_wp_error($user)){ // if there was an error creating a new user
        $ajax_handler->add_error_message("Failed to create new user: ".$user->get_error_message()); //add the message
        $ajax_handler->is_success = false;
        return;
    }
    $first_name=$form_data["First name"]; //Get tne value of the input with the label "First Name"
    $last_name=$form_data["Last name"]; //Get tne value of the input with the label "Last Name"
    $date_of_birth=$form_data["Date of birth"];
    $gender=$form_data["Gender"];
    $education_level=$form_data["Education level"];
    $biography=$form_data["My Bio"];
    $userdata = array(
        'ID' => $user,
        'first_name' => $first_name ,
        'last_name' => $last_name,
        'user_email' => $email,
    );
    $user_id = wp_update_user($userdata);
    
    // Store the additional user meta data
    if ($user_id) {
        update_user_meta($user_id, 'date_of_birth', $date_of_birth);
        update_user_meta($user_id, 'gender', $gender);
        update_user_meta($user_id, 'education_level', $education_level);
        update_user_meta($user_id, 'biography', $biography);
    }


    /* Automatically log in the user and redirect the user to the home page */
    $creds= array( // credientials for newley created user
        "user_login"=>$username,
        "user_password"=>$password,
        "remember"=>true
    );
    $signon = wp_signon($creds); //sign in the new user
    if ($signon)
        $ajax_handler->add_response_data( 'redirect_url', get_home_url() ); // optinal - if sign on succsfully - redierct the user to the home page
}
function happygifter_user_info_shortcode( $atts ) {
    $current_user = wp_get_current_user();
    $date_of_birth = get_user_meta( $current_user->ID, 'date_of_birth', true );
    $gender = get_user_meta( $current_user->ID, 'gender', true );
    $education_level = get_user_meta( $current_user->ID, 'education_level', true );
    $biography = get_user_meta( $current_user->ID, 'biography', true );
    $output = '<div class="Your profile">';
    $output .= '<ul>';
    $output .= '<li>Username: ' . $current_user->user_login . '</li>';
    $output .= '<li>Email: ' . $current_user->user_email . '</li>';
    $output .= '<li>Date of Birth: ' . $date_of_birth . '</li>';
    $output .= '<li>Gender: ' . $gender . '</li>';
    $output .= '<li>Education Level: ' . $education_level . '</li>';
    $output .= '</ul>';
    $output .= '<p>'.$biography.'</p>';
   
    
    $output .= '</div>';
    return $output;
}


function hide_admin_bar_for_subscriber() {
    if ( current_user_can( 'subscriber' ) ) {
      add_filter( 'show_admin_bar', '__return_false' );
    }
  }


function redirect_subscriber_from_signup() {
    $current_user = wp_get_current_user();
    if ( $current_user->exists() && in_array( 'subscriber', (array) $current_user->roles ) ) {
        if ( is_page( 'sign-up' ) ) {
            wp_redirect( home_url( '/my-profile/' ) );
            exit;
        }
    }
}
function elementor_form_register_validate_user_shortcode($record) {
    $form_name = $record->get_form_settings('form_name');
    // Check that the form is the "create new user form" if not - stop and return;
    if ('register' !== $form_name) {
        return;
    }
    $form_data = $record->get_formatted_data();

    $fname = isset($form_data['First name']) ? $form_data['firstname'] : '';
    $lname = isset($form_data['Last name']) ? $form_data['last_name'] : '';
    $email = isset($form_data['Email']) ? $form_data['email'] : '';
    $username = isset($form_data['Username']) ? $form_data['username'] : '';

    $url = 'https://happygifter.com/sign-up/?fname=[field id=\'firstname\'][field id=\'last_name\']&lname=[field id=\'last_name\']&email=[field id=\'email\']&username=[field id=\'username\']';

    $url = str_replace('[field id=\'firstname\'][field id=\'last_name\']', $fname . ' ' . $lname, $url);
    $url = str_replace('[field id=\'last_name\']', $lname, $url);
    $url = str_replace('[field id=\'email\']', $email, $url);
    $url = str_replace('[field id=\'username\']', $username, $url);

    return $url;
}
add_shortcode( 'elementor_form_register_validate_user', 'elementor_form_register_validate_user_shortcode' );