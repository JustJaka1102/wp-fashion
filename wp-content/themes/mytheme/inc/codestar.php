<?php
// csf
if (class_exists('CSF')) {
    // Set unique slug-like
    $siteOption = 'site_theme_option';
    $footerOption = 'footer_theme_option';
    //print_r( $terms );
    // Create options
    CSF::createOptions($siteOption, array(
        'framework_title' => 'Site setting',
        'framework_class' => '',
        'menu_title' => 'Site option',
        'menu_slug' => 'site',
    ));
    CSF::createSection($siteOption, array(
        'title' => 'Header Settings',
        'fields' => array(

            // Field logo
            array(
                'id' => 'site_logo',
                'type' => 'media',
                'title' => 'Logo',
                'library' => 'image',
                'desc' => 'update your logo.',
            ),

            // Field favicon
            array(
                'id' => 'site_favicon',
                'type' => 'media',
                'title' => 'Favicon',
                'library' => 'image',
                'desc' => 'update your favicon.',
            ),
        )
    ));
    CSF::createSection($siteOption, array(
        'title' => 'Banner Setting',
        'fields' => array(
            array(
                'id' => 'opt-gallery',
                'type' => 'gallery',
                'title' => 'Slider image gallery',
                'add_title' => 'Add Images',
                'edit_title' => 'Edit Images',
                'clear_title' => 'Remove Images',
            ),
        )
    ));
    CSF::createSection($siteOption, array(
        'title' => 'Categories list setting',
        'fields' => array(
            array(
                'id' => 'opt-select-1',
                'type' => 'select',
                'title' => 'Select first catagory to display',
                'options' => 'categories',
                'query_args' => array(
                    'taxonomy' => 'product-category',
                ),
                'defaut' => '',
            ),
            array(
                'id' => 'opt-img-1',
                'type' => 'media',
                'title' => 'Update your first image to display',
                'library' => 'image',
            ),
            array(
                'id' => 'opt-select-2',
                'type' => 'select',
                'title' => 'Select second catagory to display',
                'options' => 'categories',
                'query_args' => array(
                    'taxonomy' => 'product-category',
                ),
                'defaut' => '',
            ),
            array(
                'id' => 'opt-img-2',
                'type' => 'media',
                'title' => 'Update your second image to display',
                'library' => 'image',
            ),
            array(
                'id' => 'opt-select-3',
                'type' => 'select',
                'title' => 'Select third catagory to display',
                'options' => 'categories',
                'query_args' => array(
                    'taxonomy' => 'product-category',
                ),
                'defaut' => '',
            ),
            array(
                'id' => 'opt-img-3',
                'type' => 'media',
                'title' => 'Update your third image to display',
                'library' => 'image',
            ),
            array(
                'id' => 'opt-select-4',
                'type' => 'select',
                'title' => 'Select fourth catagory to display',
                'options' => 'categories',
                'query_args' => array(
                    'taxonomy' => 'product-category',
                ),
                'defaut' => '',
            ),
            array(
                'id' => 'opt-img-4',
                'type' => 'media',
                'title' => 'Update your fourth image to display',
                'library' => 'image',
            ),
        )
    ));
    CSF::createSection($siteOption, array(
        'title' => 'Avone Styles banner setting',
        'fields' => array(
            array(
                'id' => 'avone-banner-img-1',
                'type' => 'media',
                'title' => 'Update your first image to display',
                'library' => 'image',
            ),
            array(
                'id' => 'avone-banner-img-2',
                'type' => 'media',
                'title' => 'Update your second image to display',
                'library' => 'image',
            ),
            array(
                'id' => 'avone-banner-img-3',
                'type' => 'media',
                'title' => 'Update your third image to display',
                'library' => 'image',
            )
        )
    ));
    CSF::createSection($siteOption, array(
        'title' => 'Under banner setting',
        'fields' => array(
            array(
                'id' => 'under-banner-img',
                'type' => 'media',
                'title' => 'Update your image to display',
                'library' => 'image',
            ),
        )
    ));
    // Create options
    CSF::createOptions($footerOption, array(
        'framework_title' => 'Footer setting',
        'framework_class' => '',
        'menu_title' => 'Footer',
        'menu_slug' => 'footer',
    ));
    //
    // Create a section
    CSF::createSection($footerOption, array(
        'title' => 'Footer copyright',
        'fields' => array(
            //
            // A textarea field
            array(
                'id' => 'copyright_text',
                'type' => 'textarea',
                'title' => 'copyright Text',
                'desc' => 'Chỉnh copyright của bạn',
            ),
        )
    ));
}