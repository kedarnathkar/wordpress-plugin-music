<?php

function music_shortcode() {
    global $wpdb;
    $attributes = array();
    $attributes = shortcode_atts(
        array(
            'year' => '',
            'genre' => '',
        ), 
        $attributes, 'music'
    );
    $year = $attributes['year'];
    $genre = $attributes['genre'];

    if(!empty($year)) {
        $year_query = "SELECT music_post_id from wp_music_post WHERE release_year = $year";
        $year_result = $wpdb->query($year_query);
        
        $year_posts = get_posts( array(
            'post_type' => 'music',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'post__in' =>$year_result
        ) );
        
        //display in front end wrt to design given
    } elseif(!empty($genre)) {
        $genre_posts = get_posts( array(
            'post_type' => 'music',
            'posts_per_page' => 1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'tax_query' => 
                array(
                  'taxonomy' => 'genre',
                )
        ) );
        //display in front end wrt to design given
    } elseif(!empty($year) && !empty($genre)) {
        //get year
        $year_query = "SELECT music_post_id from wp_music_post WHERE release_year = $year";
        $year_result = $wpdb->query($year_query);

        $genre_posts = get_posts( array(
            'post_type' => 'music',
            'posts_per_page' => 1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'post__in' => $year_result,
            'tax_query' =>  array(
                  'taxonomy' => 'genre',
            ),
        ) );
        //display in front end wrt to design given
    } else {
        //to display all music posts
        $year_posts = get_posts( array(
            'post_type' => 'music',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ) );
    }
}

add_shortcode('music', 'music_shortcode');