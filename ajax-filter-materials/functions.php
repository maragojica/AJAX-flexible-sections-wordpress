<?php
/**
 * Verb Studios functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Verb_Studios
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', time() );
}



  /**
  * Displaying Custom Taxonomies
  */
  /* Materials Prices*/
 add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy_material_price');
 function tsm_filter_post_type_by_taxonomy_material_price() {
	 global $typenow;
	 $post_type = 'material'; // change to your post type
	 $taxonomy  = 'price'; // change to your taxonomy
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
 
 add_filter('parse_query', 'tsm_convert_id_to_term_in_query_material_price');
 function tsm_convert_id_to_term_in_query_material_price($query) {
	 global $pagenow;
	 $post_type = 'material'; // change to your post type
	 $taxonomy  = 'price'; // change to your taxonomy
	 $q_vars    = &$query->query_vars;
	 if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		 $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		 $q_vars[$taxonomy] = $term->slug;
	 }
 }
 
  /* Materials Wood Species*/
  add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy_material_species');
  function tsm_filter_post_type_by_taxonomy_material_species() {
	  global $typenow;
	  $post_type = 'material'; // change to your post type
	  $taxonomy  = 'wood-species'; // change to your taxonomy
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
  
  add_filter('parse_query', 'tsm_convert_id_to_term_in_query_material_species');
  function tsm_convert_id_to_term_in_query_material_species($query) {
	  global $pagenow;
	  $post_type = 'material'; // change to your post type
	  $taxonomy  = 'wood-species'; // change to your taxonomy
	  $q_vars    = &$query->query_vars;
	  if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		  $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		  $q_vars[$taxonomy] = $term->slug;
	  }
  }

    /* Materials Length*/
	add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy_material_length');
	function tsm_filter_post_type_by_taxonomy_material_length() {
		global $typenow;
		$post_type = 'material'; // change to your post type
		$taxonomy  = 'length'; // change to your taxonomy
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
	
	add_filter('parse_query', 'tsm_convert_id_to_term_in_query_material_length');
	function tsm_convert_id_to_term_in_query_material_length($query) {
		global $pagenow;
		$post_type = 'material'; // change to your post type
		$taxonomy  = 'length'; // change to your taxonomy
		$q_vars    = &$query->query_vars;
		if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
			$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
			$q_vars[$taxonomy] = $term->slug;
		}
	}

	 /* Materials Thickness*/
	 add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy_material_thickness');
	 function tsm_filter_post_type_by_taxonomy_material_thickness() {
		 global $typenow;
		 $post_type = 'material'; // change to your post type
		 $taxonomy  = 'thickness'; // change to your taxonomy
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
	 
	 add_filter('parse_query', 'tsm_convert_id_to_term_in_query_material_thickness');
	 function tsm_convert_id_to_term_in_query_material_thickness($query) {
		 global $pagenow;
		 $post_type = 'material'; // change to your post type
		 $taxonomy  = 'thickness'; // change to your taxonomy
		 $q_vars    = &$query->query_vars;
		 if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
			 $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
			 $q_vars[$taxonomy] = $term->slug;
		 }
	 }

