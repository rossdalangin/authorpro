<?php
/**
 * Custom Fields (Meta Boxes)
 *
 * @package AuthorPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register meta boxes for custom post types.
 */
function authorpro_add_custom_meta_boxes() {
    add_meta_box(
        'authorpro_book_details',
        __( 'Book Details', 'authorpro' ),
        'authorpro_render_book_meta_box',
        'book',
        'normal',
        'high'
    );
    add_meta_box(
        'authorpro_event_details',
        __( 'Event Details', 'authorpro' ),
        'authorpro_render_event_meta_box',
        'event',
        'normal',
        'high'
    );
    add_meta_box(
        'authorpro_testimonial_details',
        __( 'Testimonial Details', 'authorpro' ),
        'authorpro_render_testimonial_meta_box',
        'testimonial',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'authorpro_add_custom_meta_boxes' );

/**
 * Render the meta box for Book details.
 *
 * @param WP_Post $post The post object.
 */
function authorpro_render_book_meta_box( $post ) {
    wp_nonce_field( 'authorpro_save_book_details', 'authorpro_book_details_nonce' );

    $publication_date = get_post_meta( $post->ID, '_publication_date', true );
    $publisher = get_post_meta( $post->ID, '_publisher', true );

    ?>
    <p>
        <label for="publication_date"><?php esc_html_e( 'Publication Date:', 'authorpro' ); ?></label>
        <input type="date" id="publication_date" name="publication_date" value="<?php echo esc_attr( $publication_date ); ?>" class="widefat">
    </p>
    <p>
        <label for="publisher"><?php esc_html_e( 'Publisher:', 'authorpro' ); ?></label>
        <input type="text" id="publisher" name="publisher" value="<?php echo esc_attr( $publisher ); ?>" class="widefat">
    </p>
    <hr>
    <h4><?php esc_html_e( 'Reader\'s Guide / Excerpt', 'authorpro' ); ?></h4>
    <?php
    $readers_guide = get_post_meta( $post->ID, '_readers_guide', true );
    wp_editor( $readers_guide, 'readers_guide', array( 'textarea_name' => 'readers_guide' ) );
    ?>
    <hr>
    <h4><?php esc_html_e( 'Purchase Links', 'authorpro' ); ?></h4>
    <?php for ( $i = 1; $i <= 3; $i++ ) :
        $store_name = get_post_meta( $post->ID, '_purchase_store_' . $i, true );
        $store_url  = get_post_meta( $post->ID, '_purchase_url_' . $i, true );
    ?>
    <p>
        <label for="purchase_store_<?php echo $i; ?>"><?php printf( esc_html__( 'Store Name %d:', 'authorpro' ), $i ); ?></label>
        <input type="text" id="purchase_store_<?php echo $i; ?>" name="purchase_store_<?php echo $i; ?>" value="<?php echo esc_attr( $store_name ); ?>" class="widefat">
    </p>
    <p>
        <label for="purchase_url_<?php echo $i; ?>"><?php printf( esc_html__( 'Store URL %d:', 'authorpro' ), $i ); ?></label>
        <input type="url" id="purchase_url_<?php echo $i; ?>" name="purchase_url_<?php echo $i; ?>" value="<?php echo esc_url( $store_url ); ?>" class="widefat">
    </p>
    <?php endfor; ?>
    <?php
}

/**
 * Render the meta box for Event details.
 *
 * @param WP_Post $post The post object.
 */
function authorpro_render_event_meta_box( $post ) {
    wp_nonce_field( 'authorpro_save_event_details', 'authorpro_event_details_nonce' );

    $event_datetime = get_post_meta( $post->ID, '_event_datetime', true );
    $event_location = get_post_meta( $post->ID, '_event_location', true );
    $event_url      = get_post_meta( $post->ID, '_event_url', true );

    ?>
    <p>
        <label for="event_datetime"><?php esc_html_e( 'Event Date & Time:', 'authorpro' ); ?></label>
        <input type="datetime-local" id="event_datetime" name="event_datetime" value="<?php echo esc_attr( $event_datetime ); ?>" class="widefat">
    </p>
    <p>
        <label for="event_location"><?php esc_html_e( 'Location:', 'authorpro' ); ?></label>
        <input type="text" id="event_location" name="event_location" value="<?php echo esc_attr( $event_location ); ?>" class="widefat">
    </p>
    <p>
        <label for="event_url"><?php esc_html_e( 'Info / Ticket URL:', 'authorpro' ); ?></label>
        <input type="url" id="event_url" name="event_url" value="<?php echo esc_url( $event_url ); ?>" class="widefat">
    </p>
    <?php
}

/**
 * Render the meta box for Testimonial details.
 *
 * @param WP_Post $post The post object.
 */
function authorpro_render_testimonial_meta_box( $post ) {
    wp_nonce_field( 'authorpro_save_testimonial_details', 'authorpro_testimonial_details_nonce' );

    $designation = get_post_meta( $post->ID, '_designation', true );

    ?>
    <p>
        <label for="designation"><?php esc_html_e( 'Author Designation:', 'authorpro' ); ?></label>
        <input type="text" id="designation" name="designation" value="<?php echo esc_attr( $designation ); ?>" class="widefat">
    </p>
    <?php
}

/**
 * Save meta box data when a post is saved.
 *
 * @param int $post_id The ID of the post being saved.
 */
function authorpro_save_meta_data( $post_id ) {
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // --- Save Book Details ---
    if ( isset( $_POST['authorpro_book_details_nonce'] ) && wp_verify_nonce( $_POST['authorpro_book_details_nonce'], 'authorpro_save_book_details' ) ) {
        if ( isset( $_POST['publication_date'] ) ) {
            update_post_meta( $post_id, '_publication_date', sanitize_text_field( $_POST['publication_date'] ) );
        }
        if ( isset( $_POST['publisher'] ) ) {
            update_post_meta( $post_id, '_publisher', sanitize_text_field( $_POST['publisher'] ) );
        }
        if ( isset( $_POST['readers_guide'] ) ) {
            update_post_meta( $post_id, '_readers_guide', wp_kses_post( $_POST['readers_guide'] ) );
        }
        for ( $i = 1; $i <= 3; $i++ ) {
            if ( isset( $_POST['purchase_store_' . $i] ) ) {
                update_post_meta( $post_id, '_purchase_store_' . $i, sanitize_text_field( $_POST['purchase_store_' . $i] ) );
            }
            if ( isset( $_POST['purchase_url_' . $i] ) ) {
                update_post_meta( $post_id, '_purchase_url_' . $i, esc_url_raw( $_POST['purchase_url_' . $i] ) );
            }
        }
    }

    // --- Save Event Details ---
    if ( isset( $_POST['authorpro_event_details_nonce'] ) && wp_verify_nonce( $_POST['authorpro_event_details_nonce'], 'authorpro_save_event_details' ) ) {
        if ( isset( $_POST['event_datetime'] ) ) {
            update_post_meta( $post_id, '_event_datetime', sanitize_text_field( $_POST['event_datetime'] ) );
        }
        if ( isset( $_POST['event_location'] ) ) {
            update_post_meta( $post_id, '_event_location', sanitize_text_field( $_POST['event_location'] ) );
        }
        if ( isset( $_POST['event_url'] ) ) {
            update_post_meta( $post_id, '_event_url', esc_url_raw( $_POST['event_url'] ) );
        }
    }

    // --- Save Testimonial Details ---
    if ( isset( $_POST['authorpro_testimonial_details_nonce'] ) && wp_verify_nonce( $_POST['authorpro_testimonial_details_nonce'], 'authorpro_save_testimonial_details' ) ) {
        if ( isset( $_POST['designation'] ) ) {
            update_post_meta( $post_id, '_designation', sanitize_text_field( $_POST['designation'] ) );
        }
    }
}
add_action( 'save_post', 'authorpro_save_meta_data' );
