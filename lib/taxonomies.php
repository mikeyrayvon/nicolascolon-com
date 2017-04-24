<?php
add_action( 'init', 'create_expo_cat_tax' );

function create_expo_cat_tax() {
    register_taxonomy(
        'exhibition_type',
        'exhibition',
        array(
            'label' => __( 'Type' ),
            'rewrite' => array( 'slug' => 'type' ),
            'hierarchical' => true,
        )
    );
}
