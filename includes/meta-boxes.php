<?php 
add_action( 'admin_init', 'custom_meta_boxes' ); 
function custom_meta_boxes() { 
    $my_meta_box = array( 'id' => 'my_ot_meta_box',
    'title'       => __( 'Product Options', 'theme-text-domain' ),
    'desc'        => '',
    'pages'       => array( 'product' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      
      array(
        'label'       => __( 'Delivery & Returns', 'theme-text-domain' ),
        'id'          => 'delivery_returns',
        'type'        => 'textarea',
        'desc'        => __( '', 'theme-text-domain' )
      )
    )
  );
  if ( function_exists( 'ot_register_meta_box' ) )
    ot_register_meta_box( $my_meta_box );
 
}