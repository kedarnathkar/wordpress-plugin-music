<?php
    /*
    Plugin Name: WP Music Kedarnath
    Description: Plugin to create Music Album
    Author: Kedarnath
    Version: 0.1
    */

    if(!defined('ABSPATH')) {
        
    }
    include('music-settings.php');
    include('add-data-table.php');
    include('shortcode.php');
    function create_music_cpt(){
        $labels = array(
            'name' => __('Music', 'Post Name', 'music'),
            'singuar_name' => __('music', 'Post Name', 'music'),
            'menu_name' => __('Music','music'),
            'name_admin_bar' => __('Music','music'),
            'all_items' => __('All Music', 'music'),
            'add_new_item' => __('Add New Music', 'music'),
            'add_new' => __('Add New Music', 'music'),
            'new_item' => __('New Music', 'music'),
            'edit_item' => __('Edit Music', 'music'),
            'update_item' => __('update Music', 'music'),
            'view_item' => __('view', 'music'),
            'view_items' => __('view', 'music'),
            'search_item' => __('Search', 'music'),
            'not_found' => __('Not Found', 'music'),
            'not_found_in_trash' => __('Not Found In Trash', 'music'),
            'featured_image' => __('Featured Image', 'music'),
            'set_featured_image' => __('Set Featured Image', 'music'),
            'remove_featured_image' => __('Remove Featured Image', 'music'),
            'use_featured_image' => __('Use Featured Image', 'music'),
            'insert_into_item' => __('Insert Into Tutorial', 'music'),
            'uploaded_to_this_item' => __('Uploaded to This Item', 'music'),
            'items_list' => __('Music List', 'music'),
        );

        $args = array(
            'label' => __('Music', 'music'),
            'description' => __('Music Album', 'music'),
            'labels' => $labels,
            'supports' => array(
                'title',
                'editor',
                'author',
                'thumbnail',
                'excerpt',
                'comments',
                'revisions',
                'custom-fields',
                'page-attributes'
            ),
            'taxonomies'  => array( 'genre', 'music_tag' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'show_in_rest' => true,
            'publicly_queryable' => true,
            'capability_type' => 'post',
            'rewrite' => array('slug' => 'music')
        );
        register_post_type( 'music', $args);

        $args_taxonomies = array(
            'hierarchical' => true,
            'label' => 'Genre',
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'genre' )
        );
        register_taxonomy('genre', 'music', $args_taxonomies);
        //music tag non hierarchical
        $args_taxonomies_music_tag = array(
            'hierarchical' => false,
            'label' => 'Music Tag',
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'genre' )
        );
        register_taxonomy('music_tag', 'music', $args_taxonomies_music_tag);

    }
    add_action('init', 'create_music_cpt');


    // function wporg_add_custom_box() {
    //     $screens = [ 'music' ];
    //     foreach ( $screens as $screen ) {
    //         add_meta_box(
    //             'composer',                 // Unique ID
    //             'Add Composer Name',      // Box title
    //             'wporg_custom_box_html',  // Content callback, must be of type callable
    //             $screen                            // Post type
    //         );
    //     }
    // }
    // add_action( 'add_meta_boxes', 'wporg_add_custom_box' );

    ?>

