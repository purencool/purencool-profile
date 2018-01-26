<?php

use Drupal\Core\Form\FormStateInterface;

use Drupal\file\Entity\File;

use Drupal\Core\Ajax\CommandInterface;



function purencool_vision_form_system_theme_settings_alter(&$form, \Drupal\Core\Form\FormStateInterface &$form_state, $form_id = NULL) {

    // Work-around for a core bug affecting admin themes. See issue #943212.

    $theme_file = drupal_get_path('theme', 'purencool_vision') . '/theme-settings.php';

    $build_info = $form_state->getBuildInfo();

    if (!in_array($theme_file, $build_info['files'])) {

        $build_info['files'][] = $theme_file;

    }

    $form_state->setBuildInfo($build_info);



    $form['#submit'][] = 'purencool_vision_theme_settings_form_submit';

    $form['#attached']['library'][] = 'purencool_vision/theme-settings';

    $form['advanced'] = array(

        '#type' => 'vertical_tabs',

        '#default_tab' => 'general_setting',

    );

    $form['general_setting'] = array(

        '#type' => 'details',

        '#title' => t('General Settings'),

        '#group' => 'advanced',

    );

/*
    if (!\Drupal::moduleHandler()->moduleExists('yaml_editor')) {

        $message = t('<strong>It is recommended to install the</strong> <a href="@yaml-editor">YAML Editor</a> module for easier editing.', [

            '@yaml-editor' => 'https://www.drupal.org/project/yaml_editor',

        ]);



        //drupal_set_message($message, 'warning');

        $form['general_setting']['status_messages'] = [

           '#markup' => $message

        ];

    }
*/
/*
    $form['general_setting']['tracking_code'] = array(

        '#type'          => 'textarea',

        '#title'         => t('Tracking Code'),

        '#default_value' => theme_get_setting('tracking_code', 'purencool_vision'),

        '#description'   => t("Add custom script on your site."),

    );

    $form['general_setting']['custom_css'] = array(

        '#type'          => 'textarea',

        '#title'         => t('Custom CSS'),

        '#default_value' => theme_get_setting('custom_css', 'purencool_vision'),

        '#description'   => t('<strong>Example:</strong><br/>h1 { font-family: \'Metrophobic\', Arial, serif; font-weight: 400; }'),

    );

    $form['header_settings'] = array(

        '#type' => 'details',

        '#title' => t('Header Settings'),

        '#group' => 'advanced',

    );



    //Header settings

    $form['header_settings']['menu_style'] = array(

        '#type'          => 'select',

        '#title'         => t('Menu style'),

        '#options' => array(

            'default' => t('Default Menu'),

            'transparent' => t('Transparent Menu'),

            'fullwidth' => t('Full width'),

            'fullwidth_trans' => t('Transparent Full width'),

        ),

        '#default_value' => theme_get_setting('menu_style', 'purencool_vision'),

    );





    //Footer settings

    $form['footer_settings'] = array(

        '#type' => 'details',

        '#title' => t('Footer Settings'),

        '#group' => 'advanced',

    );

    $form['footer_settings']['footer_style'] = array(

        '#type'          => 'select',

        '#title'         => t('Footer Style'),

        '#options' => array(

            'footer1' => t('Footer Style 1'),

            'footer2' => t('Footer Style 2'),

        ),

        '#default_value' => theme_get_setting('footer_style', 'purencool_vision'),

    );

    $form['footer_settings']['footer_copyright_message'] = array(

        '#type'          => 'textarea',

        '#title'         => t('Footer copyright message'),

        '#default_value' => theme_get_setting('footer_copyright_message', 'purencool_vision'),

    );





    //Portfolio settings

    $form['portfolio_settings'] = array(

        '#type' => 'details',

        '#title' => t('Portfolio Settings'),

        '#group' => 'advanced',

    );

    $form['portfolio_settings']['portfolio_layout'] = array(

        '#type'          => 'select',

        '#title'         => t('Portfolio layout'),

        '#options' => array(

            'boxed' => t('Boxed'),

            'wide' => t('Wide'),

        ),

        '#default_value' => theme_get_setting('portfolio_layout', 'purencool_vision'),

    );

    $form['portfolio_settings']['portfolio_style'] = array(

        '#type'          => 'select',

        '#title'         => t('Portfolio style'),

        '#options' => array(

            'gutter2cols' => t('Gutter 2 Columns'),

            'gutter3cols' => t('Gutter 3 Columns'),

            'gutter4cols' => t('Gutter 4 Columns'),

            'gutter5cols' => t('Gutter 5 Columns'),

            'gutter6cols' => t('Gutter 6 Columns'),

            'gutterless2cols' => t('Gutter Less 2 Columns'),

            'gutterless3cols' => t('Gutter Less 3 Columns'),

            'gutterless4cols' => t('Gutter Less 4 Columns'),

            'gutterless5cols' => t('Gutter Less 5 Columns'),

            'gutterless6cols' => t('Gutter Less 6 Columns'),

            'titlegutter2cols' => t('Title Gutter 2 Columns'),

            'titlegutter3cols' => t('Title Gutter 3 Columns'),

            'titlegutter4cols' => t('Title Gutter 4 Columns'),

            'titlegutter5cols' => t('Title Gutter 5 Columns'),

            'titlegutter6cols' => t('Title Gutter 6 Columns'),

            'titlegutterless2cols' => t('Title Gutter Less 2 Columns'),

            'titlegutterless3cols' => t('Title Gutter Less 3 Columns'),

            'titlegutterless4cols' => t('Title Gutter Less 4 Columns'),

            'titlegutterless5cols' => t('Title Gutter Less 5 Columns'),

            'titlegutterless6cols' => t('Title Gutter Less 6 Columns'),

            'masonrygutter2cols' => t('Masonry Gutter 2 Columns'),

            'masonrygutter3cols' => t('Masonry Gutter 3 Columns'),

            'masonrygutter4cols' => t('Masonry Gutter 4 Columns'),

            'masonrygutter5cols' => t('Masonry Gutter 5 Columns'),

            'masonrygutter6cols' => t('Masonry Gutter 6 Columns'),

            'masonrygutterless2cols' => t('Masonry Gutter Less 2 Columns'),

            'masonrygutterless3cols' => t('Masonry Gutter Less 3 Columns'),

            'masonrygutterless4cols' => t('Masonry Gutter Less 4 Columns'),

            'masonrygutterless5cols' => t('Masonry Gutter Less 5 Columns'),

            'masonrygutterless6cols' => t('Masonry Gutter Less 6 Columns'),

            'masonrytitlegutter2cols' => t('Masonry Title Gutter 2 Columns'),

            'masonrytitlegutter3cols' => t('Masonry Title Gutter 3 Columns'),

            'masonrytitlegutter4cols' => t('Masonry Title Gutter 4 Columns'),

            'masonrytitlegutter5cols' => t('Masonry Title Gutter 5 Columns'),

            'masonrytitlegutter6cols' => t('Masonry Title Gutter 6 Columns'),

            'masonrytitlegutterless2cols' => t('Masonry Title Gutter Less 2 Columns'),

            'masonrytitlegutterless3cols' => t('Masonry Title Gutter Less 3 Columns'),

            'masonrytitlegutterless4cols' => t('Masonry Title Gutter Less 4 Columns'),

            'masonrytitlegutterless5cols' => t('Masonry Title Gutter Less 5 Columns'),

            'masonrytitlegutterless6cols' => t('Masonry Title Gutter Less 6 Columns'),

        ),

        '#default_value' => theme_get_setting('portfolio_style', 'purencool_vision'),

    );

    $form['portfolio_settings']['portfolio_menu_style'] = array(

        '#type'          => 'select',

        '#title'         => t('Menu style'),

        '#options' => array(

            'default' => t('Default Menu'),

            'transparent' => t('Transparent Menu'),

            'fullwidth' => t('Full width'),

            'fullwidth_trans' => t('Transparent Full width'),

        ),

        '#default_value' => theme_get_setting('portfolio_menu_style', 'purencool_vision'),

    );

     $form['portfolio_settings']['portfolio_page_header_class'] = array(

        '#type'          => 'textfield',

        '#title'         => t('Page header class'),

        '#default_value' => theme_get_setting('portfolio_page_header_class', 'purencool_vision'),

    );

    $form['portfolio_settings']['portfolio_page_header_bgcolor'] = array(

        '#type'          => 'textfield',

        '#title'         => t('Page header background color'),

        '#placeholder'   => 'f8f8f8',

        '#size'          => 6,

        '#attributes'    => array (

            'class' => array('colorpickerField'),

        ),

        '#default_value' => theme_get_setting('portfolio_page_header_bgcolor', 'purencool_vision'),

    );

    $form['portfolio_settings']['portfolio_page_title_bgimage'] = array(

        '#type'     => 'managed_file',

        '#title'    => t('Page title background image upload'),

        '#required' => FALSE,

        '#upload_location' => 'public://background/',

        '#default_value' => theme_get_setting('portfolio_page_title_bgimage','purencool_vision'),

        '#upload_validators' => array(

            'file_validate_extensions' => array('gif png jpg jpeg'),

            '#progress_message' => 'Uploading ...',

            '#required' => FALSE,

        ),

    );

    $form['portfolio_settings']['portfolio_slogan'] = array(

        '#type'          => 'textfield',

        '#title'         => t('Portfolio slogan'),

        '#default_value' => theme_get_setting('portfolio_slogan', 'purencool_vision'),

    );

    $form['portfolio_settings']['portfolio_footer_layout'] = array(

        '#type'          => 'select',

        '#title'         => t('Footer layout'),

        '#options' => array(

            'layout1' => t('Layout 1'),

            'layout2' => t('Layout 2'),

        ),

        '#default_value' => theme_get_setting('portfolio_footer_layout', 'purencool_vision'),

    );

    //Blog settting

    $form['blog_settings'] = array(

        '#type' => 'details',

        '#title' => t('Blog Settings'),

        '#group' => 'advanced',

    );

    $form['blog_settings']['blog_menu_style'] = array(

        '#type'          => 'select',

        '#title'         => t('Menu Style'),

        '#options' => array(

            'default' => t('Default Menu'),

            'transparent' => t('Transparent Menu'),

            'fullwidth' => t('Full width'),

            'fullwidth_trans' => t('Transparent Full width'),

        ),

        '#default_value' => theme_get_setting('blog_menu_style', 'purencool_vision'),

    );

    $form['blog_settings']['blog_layout'] = array(

        '#type'          => 'select',

        '#title'         => t('Blog layout'),

        '#options' => array(

            'fullwidth' => t('Full Width'),

            'right' => t('Right Sidebar'),

            'left' => t('Left Sidebar'),

        ),

        '#default_value' => theme_get_setting('blog_layout', 'purencool_vision'),

    );

    $form['blog_settings']['blog_style'] = array(

        '#type'          => 'select',

        '#title'         => t('Blog Style'),

        '#options' => array(

            'grid2cols' => t('Grid 2 Columns'),

            'grid3cols' => t('Grid 3 Columns'),

            'grid4cols' => t('Grid 4 Columns'),

            'masonry2cols' => t('Masonry 2 Columns'),

            'masonry3cols' => t('Masonry 3 Columns'),

            'masonry4cols' => t('Masonry 4 Columns'),

            'classic' => t('Blog Classic'),

        ),

        '#default_value' => theme_get_setting('blog_style', 'purencool_vision'),

    );

    $form['blog_settings']['blog_page_header_class'] = array(

        '#type'          => 'textfield',

        '#title'         => t('Page header class'),

        '#default_value' => theme_get_setting('blog_page_header_class', 'purencool_vision'),

    );

    $form['blog_settings']['blog_page_header_bgcolor'] = array(

        '#type'          => 'textfield',

        '#title'         => t('Page header background color'),

        '#placeholder'   => 'f8f8f8',

        '#size'          => 6,

        '#attributes'    => array (

            'class' => array('colorpickerField'),

        ),

        '#default_value' => theme_get_setting('blog_page_header_bgcolor', 'purencool_vision'),

    );

    $form['blog_settings']['blog_page_title_bgimage'] = array(

        '#type'     => 'managed_file',

        '#title'    => t('Page title background image upload'),

        '#required' => FALSE,

        '#upload_location' => 'public://background/',

        '#default_value' => theme_get_setting('blog_page_title_bgimage','purencool_vision'),

        '#upload_validators' => array(

            'file_validate_extensions' => array('gif png jpg jpeg'),

            '#progress_message' => 'Uploading ...',

            '#required' => FALSE,

        ),

    );

    $form['blog_settings']['blog_slogan'] = array(

        '#type'          => 'textfield',

        '#title'         => t('Blog slogan'),

        '#default_value' => theme_get_setting('blog_slogan', 'purencool_vision'),

    );

    $form['blog_settings']['blog_footer_layout'] = array(

        '#type'          => 'select',

        '#title'         => t('Footer layout'),

        '#options' => array(

            'layout1' => t('Layout 1'),

            'layout2' => t('Layout 2'),

        ),

        '#default_value' => theme_get_setting('blog_footer_layout', 'purencool_vision'),

    );


    //Product detail settings

    $form['product_settings'] = array(

        '#type' => 'details',

        '#title' => t('Shop Settings'),

        '#group' => 'advanced',

    );

    $form['product_settings']['shop_layout'] = array(

        '#type'          => 'select',

        '#title'         => t('Shop layout'),

        '#options' => array(

            'grid2col' => t('Grid 2 Columns'),

            'grid3col' => t('Grid 3 Columns'),

            'left' => t('Grid Left Sidebar'),

            'right' => t('Grid Right Sidebar'),

        ),

        '#default_value' => theme_get_setting('shop_layout', 'purencool_vision'),

    );

    $form['product_settings']['shop_menu_style'] = array(

        '#type'          => 'select',

        '#title'         => t('Menu style'),

        '#options' => array(

            'default' => t('Default Menu'),

            'transparent' => t('Transparent Menu'),

            'fullwidth' => t('Full width'),

            'fullwidth_trans' => t('Transparent Full width'),

        ),

        '#default_value' => theme_get_setting('shop_menu_style', 'purencool_vision'),

    );

    $form['product_settings']['shop_header_class'] = array(

        '#type'          => 'textfield',

        '#title'         => t('Page header class'),

        '#default_value' => theme_get_setting('shop_header_class', 'purencool_vision'),

    );

    $form['product_settings']['shop_slogan'] = array(

        '#type'          => 'textfield',

        '#title'         => t('Page slogan'),

        '#default_value' => theme_get_setting('shop_slogan', 'purencool_vision'),

    );

    $form['product_settings']['shop_header_bgcolor'] = array(

        '#type'          => 'textfield',

        '#title'         => t('Page header background color'),

        '#placeholder'   => 'f8f8f8',

        '#size'          => 6,

        '#attributes'    => array (

            'class' => array('colorpickerField'),

        ),

        '#default_value' => theme_get_setting('shop_header_bgcolor', 'purencool_vision'),

    );

    $form['product_settings']['shop_page_title_bgimage'] = array(

        '#type'     => 'managed_file',

        '#title'    => t('Page title background image upload'),

        '#required' => FALSE,

        '#upload_location' => 'public://background/',

        '#default_value' => theme_get_setting('shop_page_title_bgimage','purencool_vision'),

        '#upload_validators' => array(

            'file_validate_extensions' => array('gif png jpg jpeg'),

            '#progress_message' => 'Uploading ...',

            '#required' => FALSE,

        ),

    );

    $form['product_settings']['shop_footer_layout'] = array(

        '#type'          => 'select',

        '#title'         => t('Footer layout'),

        '#options' => array(

            'layout1' => t('Layout 1'),

            'layout2' => t('Layout 2'),

        ),

        '#default_value' => theme_get_setting('shop_footer_layout', 'purencool_vision'),

    );



    //Page settings

    $form['page_settings'] = array(

        '#type' => 'details',

        '#title' => t('Pages Settings'),

        '#group' => 'advanced',

    );

    $form['page_settings']['page_menu_style'] = array(

        '#type'          => 'select',

        '#title'         => t('Menu style'),

        '#options' => array(

            'default' => t('Default Menu'),

            'transparent' => t('Transparent Menu'),

            'fullwidth' => t('Full width'),

            'fullwidth_trans' => t('Transparent Full width'),

        ),

        '#default_value' => theme_get_setting('page_menu_style', 'purencool_vision'),

    );

    $form['page_settings']['page_header_class'] = array(

        '#type'          => 'textfield',

        '#title'         => t('Page header class'),

        '#default_value' => theme_get_setting('page_header_class', 'purencool_vision'),

    );

    $form['page_settings']['page_slogan'] = array(

        '#type'          => 'textfield',

        '#title'         => t('Page slogan'),

        '#default_value' => theme_get_setting('page_slogan', 'purencool_vision'),

    );

    $form['page_settings']['page_header_bgcolor'] = array(

        '#type'          => 'textfield',

        '#title'         => t('Page header background color'),

        '#placeholder'   => 'f8f8f8',

        '#size'          => 6,

        '#attributes'    => array (

            'class' => array('colorpickerField'),

        ),

        '#default_value' => theme_get_setting('page_header_bgcolor', 'purencool_vision'),

    );

    $form['page_settings']['system_page_title_bgimage'] = array(

        '#type'     => 'managed_file',

        '#title'    => t('Page title background image upload'),

        '#required' => FALSE,

        '#upload_location' => 'public://background/',

        '#default_value' => theme_get_setting('system_page_title_bgimage','purencool_vision'),

        '#upload_validators' => array(

            'file_validate_extensions' => array('gif png jpg jpeg'),

            '#progress_message' => 'Uploading ...',

            '#required' => FALSE,

        ),

    );

    $form['page_settings']['page_footer_layout'] = array(

        '#type'          => 'select',

        '#title'         => t('Footer layout'),

        '#options' => array(

            'layout1' => t('Layout 1'),

            'layout2' => t('Layout 2'),

        ),

        '#default_value' => theme_get_setting('page_footer_layout', 'purencool_vision'),

    );

    //Page 404 settings

    $form['page404_settings'] = array(

        '#type' => 'details',

        '#title' => t('Page 404'),

        '#group' => 'advanced',

    );

    $form['page404_settings']['page404_menu_style'] = array(

        '#type'          => 'select',

        '#title'         => t('Menu style'),

        '#options' => array(

            'default' => t('Default Menu'),

            'transparent' => t('Transparent Menu'),

            'fullwidth' => t('Full width'),

            'fullwidth_trans' => t('Transparent Full width'),

        ),

        '#default_value' => theme_get_setting('page404_menu_style', 'purencool_vision'),

    );

    $form['page404_settings']['page404_logo'] = array(

            '#type'     => 'managed_file',

            '#title'    => t('Page 404 Logo'),

            '#required' => FALSE,

            '#upload_location' => 'public://background/',

            '#default_value' => theme_get_setting('page404_logo','purencool_vision'),

            '#upload_validators' => array(

            'file_validate_extensions' => array('gif png jpg jpeg'),

            '#progress_message' => 'Uploading ...',

            '#required' => FALSE,

        ),

    );

    $form['page404_settings']['page404_footer_style'] = array(

        '#type'          => 'select',

        '#title'         => t('Footer Style'),

        '#options' => array(

            'footer1' => t('Style 1'),

            'footer2' => t('Style 2'),

        ),

        '#default_value' => theme_get_setting('page404_footer_style', 'purencool_vision'),

    );

    $form['page404_settings']['page404_background_image'] = array(

            '#type'     => 'managed_file',

            '#title'    => t('Page 404 background image'),

            '#required' => FALSE,

            '#upload_location' => 'public://background/',

            '#default_value' => theme_get_setting('page404_background_image','purencool_vision'),

            '#upload_validators' => array(

            'file_validate_extensions' => array('gif png jpg jpeg'),

            '#progress_message' => 'Uploading ...',

            '#required' => FALSE,

        ),

    );

    $form['page404_settings']['page404_messages'] = array(

        '#type'          => 'textarea',

        '#title'         => t('Messages'),

        '#default_value' => theme_get_setting('page404_messages', 'purencool_vision'),

        '#description'   => t("Add a messages on your site."),

    );


*/


}



function purencool_vision_theme_settings_form_submit(&$form, FormStateInterface $form_state) {

    $image_fid[0] = $form_state->getValue('system_page_title_bgimage');

    $image_fid[1] = $form_state->getValue('blog_page_title_bgimage');

    $image_fid[2] = $form_state->getValue('portfolio_page_title_bgimage');

    $image_fid[3] = $form_state->getValue('page404_background_image');

    $image_fid[4] = $form_state->getValue('page404_logo');

    $image_fid[5] = $form_state->getValue('shop_page_title_bgimage');

    $count = count($image_fid);

    for ($i=0; $i < $count; $i++) {

        if( $image_fid[$i]) {

            $file = File::load($image_fid[$i][0]);

            $file_usage = \Drupal::service('file.usage');

            $file_usage->add($file, 'purencool_vision', 'theme', 1);

        }

    }



}
