                                                                                                                         <?php

add_action('admin_init', 'custom_theme_options', 1);

function custom_theme_options()
{



    $saved_settings = get_option('option_tree_settings', array());





    $custom_settings = array(
        'sections' => array(
            array(
                'id' => 'init',
                'title' => 'General Settings '
            ),  array(
                'id' => 'contentpanel',
                'title' => 'Content Panel'
            )

        ),
        'settings' => array(

            array(
                'id' => 'logo',
                'label' => 'Logo',
                'desc' => '',
                'type' => 'upload',
                'section' => 'init'
            ), array(
                'id' => 'logo_gray',
                'label' => 'Logo Grayscale',
                'desc' => '',
                'type' => 'upload',
                'section' => 'init'
            ) ,array(
                'id' => 'footer_logo',
                'label' => 'Footer Logo',
                'desc' => '',
                'type' => 'upload',
                'section' => 'init'
            ), array(
                'id' => 'footer_logo_gray',
                'label' => 'Footer Logo Grayscale',
                'desc' => '',
                'type' => 'upload',
                'section' => 'init'
            ), array(
                'id' => 'home_slider',
                'label' => 'Home Slider',
                'desc' => '',
                'section' => 'init',
                'type' => 'list-item',
                'class' => '',
                'settings' => array(
                    array(
                        'label' => 'Description',
                        'id' => 'desc',

                        'type' => 'text',

                    ), array(
                        'label' => 'Image',
                        'id' => 'image',

                        'type' => 'upload',

                    ), array(
                        'label' => 'Image Mobile',
                        'id' => 'image-mobile',

                        'type' => 'upload',

                    ), array(
                        'label' => 'Button Text',
                        'id' => 'btn-txt',

                        'type' => 'text',

                    ), array(
                        'label' => 'Button Link',
                        'id' => 'link',

                        'type' => 'text',

                    )
                )
            ), array(
                'id' => 'home_about_title',
                'label' => 'Home About Title ',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ), array(
                'id' => 'home_about_sub_title',
                'label' => 'Home About Sub Title ',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ), array(
                'id' => 'home_about_desc',
                'label' => 'Home About Description ',
                'desc' => '',
                'type' => 'textarea',
                'section' => 'init'
            ), array(
                'id' => 'home_about_link_text',
                'label' => 'Home About Read More Button Text ',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ), array(
                'id' => 'home_about_link',
                'label' => 'Home About Read More Button Link',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ), array(
                'id' => 'home_cat_title',
                'label' => 'Home Shop Category Title',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ), array(
                'id' => 'home_cat_list',
                'label' => 'Home Catgory Order and Count',
                'desc' => '',
                'section' => 'init',
                'type' => 'list-item',
                'class' => '',
                'settings' => array(
                    array(
                        'id'          => 'category',
                        'label'       => __('Select Product Category', 'text-domain'),
                        'desc'        => __('', 'text-domain'),
                        'type'        => 'taxonomy-select',
                        'taxonomy'    => 'product_cat', // Defaults to Categories and Tags
                    ),
                    array(
                        'label' => 'Number of Post',
                        'id' => 'number',

                        'type' => 'text',

                    )
                )
            ), array(
                'id' => 'home_newsletter_img',
                'label' => 'Home Newsletter Image ',
                'desc' => '',
                'type' => 'upload',
                'section' => 'init'
            ), array(
                'id' => 'home_newsletter_txt',
                'label' => 'Home Newsletter Text ',
                'desc' => '',
                'type' => 'upload',
                'section' => 'init'
            ), array(
                'id' => 'promotion',
                'label' => 'Promotion',
                'desc' => '',
                'section' => 'init',
                'type' => 'list-item',
                'class' => '',
                'settings' => array(
                    array(
                        'label' => 'Description',
                        'id' => 'desc',

                        'type' => 'text',

                    ), array(
                        'label' => 'Image',
                        'id' => 'image',

                        'type' => 'upload',

                    ), array(
                        'label' => 'Link',
                        'id' => 'link',

                        'type' => 'text',

                    )
                )
            ),
            array(
                'id' => 'janio_api_url',
                'label' => 'Janio API URL',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ),
            array(
                'id' => 'janio_secret_key',
                'label' => 'Janio Secret Key',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ),
            array(
                'id' => 'pickup_contact_name',
                'label' => 'Pickup Contact Name',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ),array(
                'id' => 'pickup_contact_number',
                'label' => 'Pickup Contact Number',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ),array(
                'id' => 'pickup_address',
                'label' => 'Pickup Address',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ),array(
                'id' => 'pickup_postal',
                'label' => 'Pickup Postal Code',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ),array(
                'id' => 'pickup_city',
                'label' => 'Pickup City',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ), array(
                'id' => 'phone',
                'label' => 'Phone Number Header ',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ), array(
                'id' => 'footer_address',
                'label' => 'Footer address',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ), array(
                'id' => 'footer_emails',
                'label' => 'Footer Email',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ), array(
                'id' => 'footer_phone',
                'label' => 'Footer Phone ',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ), array(
                'id' => 'email',
                'label' => 'Email',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ), array(
                'id' => 'phone',
                'label' => 'Phone',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ), array(
                'id' => 'facebook',
                'label' => 'Facebook',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ), array(
                'id' => 'linkedin',
                'label' => 'Linkedin',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ), array(
                'id' => 'instragram',
                'label' => 'Instragram',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            ), array(
                'id' => 'youtube',
                'label' => 'Youtube',
                'desc' => '',
                'type' => 'text',
                'section' => 'init'
            )


        )
    );



    if ($saved_settings !== $custom_settings) {

        update_option('option_tree_settings', $custom_settings);
    }
}
