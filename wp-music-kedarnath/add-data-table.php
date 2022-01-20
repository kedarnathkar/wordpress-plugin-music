<?php
    // add_action('admin_menu', 'add_music_settings');
    
    // function add_music_settings(){
    //     add_menu_page( 'Add Music Settings', 'Add Music Settings', 'manage_options', 'add_music_settings', 'add_data_to_custom_table' );
    // }
    function add_data_to_custom_table($post_id, $post){
        //get post details
        $post_id = $post->ID;
        $post_title = $post->post_title;
        $post_content = $post->post_content;
        $post_link = get_permalink($post_id);

        //get custom fields
        $composer_name = get_field('composer_name',$post_id);
        $publisher = get_field('publisher',$post_id);
        $year_of_recording = get_field('year_of_recording',$post_id);
        $additional_contributors = get_field('additional_contributors',$post_id);
        $url = get_field('url',$post_id);
        $price = get_field('price',$post_id);

        global $wpdb;
        $query = "INSERT INTO wp_music_post (music_post_id, wp_music_post_title, wp_music_post_description, composer_name, publisher, release_year, additional_contributors, album_url, price) VALUES ($post_id, '$post_title', '$post_content', '$composer_name', '$publisher', '$year_of_recording', '$additional_contributors', '$url', '$price')";
        $result = $wpdb->query($query);
    }
    // echo "ran after function";
    add_action('publish_music', 'add_data_to_custom_table', 10, 2);
