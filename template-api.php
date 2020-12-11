<?php
/**
 * Template name: API  Template
 * 
 */

$email=isset($_REQUEST['email'])?$_REQUEST['email']:'';
if ( ! function_exists( 'post_exists' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/post.php' );
}

    $email_address= $email;
    if(!empty($email_address)){

        $postexist=post_exists( $email_address,'','','');
    if($postexist){

    }else{
        $id = wp_insert_post(array('post_title'=>$email_address, 'post_type'=>'email_subscribe',  'post_status'   => 'publish'    ));

    }

 
    $return['status']='1';
    $return['exist']=$postexist;
    $return['message']='Thank you, you are on the list!';
}else{
    $return['status']='0';
    $return['message']='Please enter a email';
}
    

 echo json_encode($return);

