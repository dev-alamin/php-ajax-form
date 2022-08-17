<?php

$database = new mysqli( 'localhost', 'root', '', 'form');

if( isset( $_POST["email"] ) ){

    /**
     * User Input Validation
     *
     * @param string $data
     * @return void
     */

    function validate_input($data){
        $data = stripslashes( $data );
        $data = trim( $data );
        $data = htmlspecialchars( $data );
        return $data;
    }

    // Validate unser input
    $name = validate_input( $_POST['name'] );
    $email = validate_input( $_POST['email'] );
    $email = filter_var( $email, FILTER_VALIDATE_EMAIL ); // Validate email
    $website = validate_input( $_POST['website'] );
    $website = filter_var( $website, FILTER_VALIDATE_URL ); // Validate url
    $comment = validate_input( $_POST['comment'] );
    $gender = validate_input( $_POST['gender'] );
    $url = validate_input( $_POST['url'] );


    // If error or empty field

    // Take initial variable for error
    $name_err = $email_err = $website_err = $comment_err = $gender_err = $success = "";

    if( empty( $name ) ) {
        $name_err = 'Please input your name';
    }

    
    if( empty( $email ) && $email == false ) {
        $email_err = 'Please input your email and input a valid email';
    }

    
    if( empty( $website ) ) {
        $website_err = 'Please input your website and input a valid url';
    }

    
    if( empty( $comment ) ) {
        $comment_err = 'Please input your comment';
    }

    
    if( empty( $gender ) ) {
        $gender_err = 'Please input your gender';
    }

    // If everything goes well then insert into db
    if( empty( $name_err ) && empty( $email_err ) && empty( $website_err ) && empty( $comment_err ) && empty( $gender_err ) ) {
       
        // SQL query
            $sql = "
            INSERT INTO data_sample 
            (name, email, website, comment, gender, url) 
            VALUES('$name', '$email', '$website', '$comment', '$gender', '$url')
            ";
        

        $insert = $database->query( $sql );

        if( $insert ) {
            $success = '<div class="success alert-success p-10"> Your input is saved! </div>';
        }else{
            $success = '<div class="success alert-success p-10"> Sorry! Internal error, please comeback! </div>';
        }
    }
// Send back js response 
$output = [
    'success' => $success,
    'name' => $name_err,
    'email' => $email_err,
    'website' => $website_err,
    'comment' => $comment_err,
    'gender' => $gender_err,
];

echo json_encode( $output );

}

