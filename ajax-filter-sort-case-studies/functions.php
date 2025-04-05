<?php



/*Case Studies Filtering*/

// Enqueue JavaScript for AJAX
function enqueue_case_studies_scripts() {
    wp_enqueue_script('custom-case-studies-ajax', 'https://www.zdfirm.com/wp-content/themes/zinda-theme/assets/app/js/case-study.js', array('jquery'), null, true);

    // Localize script to pass AJAX URL
    wp_localize_script('custom-case-studies-ajax', 'caseStudiesData', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax_filter_nonce')
    ]);
}

add_action('wp_enqueue_scripts', 'enqueue_case_studies_scripts');


function handle_case_studies_filter() {
    $category = isset($_GET['category']) ? $_GET['category'] : 'all';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'recent';

    $args = array(
        'post_type' => 'case-study',
        'posts_per_page' => -1,
    );

    if ($category !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'case-study-category',
                'field'    => 'term_id',
                'terms'    => $category,
                'operator' => 'IN',
            ),
        );
    }

    if ($sort === 'settlement') {
        $args['meta_key'] = 'price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
    } else {
        $args['meta_key'] = 'custom_date';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
    }

    $query = new WP_Query($args);
    $case_studies = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // Get all categories for the current post
            $categories = wp_get_post_terms(get_the_ID(), 'case-study-category', array('fields' => 'names'));

            // Exclude the "All" category by checking its name or slug
            $filtered_categories = array_filter($categories, function($category) {
                return strtolower($category) !== 'all'; // Replace 'all' with the actual name or slug of the "All" category
            });
            $case_studies[] = array(
                'title' => get_the_title(),
                'link' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url() ?: 'https://via.placeholder.com/150',
                'date' => get_field('custom_date'),
                'categories' => implode(', ', $filtered_categories),
                'excerpt' => get_field('short_summary_'),
            );
        }
        wp_send_json($case_studies);
    } else {
        wp_send_json([]);
    }

    wp_die();
}
add_action('wp_ajax_filter_case_studies', 'handle_case_studies_filter');
add_action('wp_ajax_nopriv_filter_case_studies', 'handle_case_studies_filter');

/* Case Studies Taxonomy */

add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy_resource_type');
function tsm_filter_post_type_by_taxonomy_resource_type() {
	global $typenow;
	$post_type = 'case-study'; // change to your post type
	$taxonomy  = 'case-study-category'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
				'show_option_all' => sprintf( __( 'Show all %s', 'textdomain' ), $info_taxonomy->label ),
				'taxonomy'        => $taxonomy,
				'name'            => $taxonomy,
				'orderby'         => 'name',
				'selected'        => $selected,
				'show_count'      => true,
				'hide_empty'      => true,
		));
	};
}

add_filter('parse_query', 'tsm_convert_id_to_term_in_query_resource_type');
function tsm_convert_id_to_term_in_query_resource_type($query) {
	global $pagenow;
	$post_type = 'case-study'; // change to your post type
	$taxonomy  = 'case-study-category'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}

