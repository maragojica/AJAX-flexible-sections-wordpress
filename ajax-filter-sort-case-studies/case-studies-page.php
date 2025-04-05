<?php

/*
Template Name: Case Studies Template
*/

remove_action('genesis_loop', 'genesis_do_loop', 10);
add_action('genesis_loop', 'custom_content', 10);

function custom_content()
{
    global $post;
    if(isset($_GET['dev'])) {
    ?>
    
    <div class="case-studies-page">
    <div class="case-studies-hero">
        <h2>See how we’ve helped real clients achieve justice and compensation. Explore detailed case studies showcasing our legal expertise</h2>
    </div>
    <div id="case-studies-app" class="case-studies-container">

            <div class="filters">
            <!-- Case Type Dropdown -->
            <div class="dropdown" id="category-dropdown">
                <button class="dropdown-toggle" id="category-selected">Case Type</button>
                <ul class="dropdown-menu" id="category-list">                   
                    <?php
                    // Fetch all categories, including empty categories
                    $categories = get_terms(array(
                        'taxonomy' => 'case-study-category',
                        'orderby' => 'name',
                        'hide_empty' => false, // Show all categories, including those without case studies
                    ));
                    foreach ($categories as $category) : ?>
                        <li data-category="<?php echo $category->term_id; ?>" class="category-item"><?php echo $category->name; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Sort By Dropdown -->
            <div class="dropdown" id="sort-dropdown">
                <button class="dropdown-toggle" id="sort-selected">Sort By</button>
                <ul class="dropdown-menu" id="sort-list">
                    <li data-sort="recent" class="sort-item">Recent Cases</li>
                    <li data-sort="settlement" class="sort-item">Highest Settlements</li>
                </ul>
            </div>
        </div>

        <!-- The Case Studies List (initially loaded with all case studies) -->
        <div class="case-studies-list" id="case-studies-list">
            <?php
            // Query to fetch all case studies initially
            $args = array(
                'post_type' => 'case-study',
                'posts_per_page' => -1, // No pagination
                'meta_key' => 'custom_date', 
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
            );

            $case_studies = new WP_Query($args);

            if ($case_studies->have_posts()) :
                while ($case_studies->have_posts()) : $case_studies->the_post();
                    ?>
                    <div class="case-studies-card">
                        <div class="case-study-image">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                            </a>
                        </div>
                        <div class="case-study-content">
                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="entry-meta">
                                <span>
                                <?php 
                                // Get all categories for the current post
                                $categories = wp_get_post_terms(get_the_ID(), 'case-study-category');

                                // Exclude the "All" category by checking its name or slug
                                $filtered_categories = array_filter($categories, function($category) {
                                    return strtolower($category->slug) !== 'all'; // Use 'slug' instead of 'name' for better reliability
                                });

                                // Display the filtered categories
                                echo implode(', ', wp_list_pluck($filtered_categories, 'name'));
                                ?>
                                </span>
                                <time class="entry-time"><?php the_field('custom_date'); ?></time>
                            </p>
                            <div class="entry-content"><?php the_field('short_summary_'); ?></div>
                            <a href="<?php the_permalink(); ?>" class="case-study-more">Read More</a>
                        </div>
                    </div>
                    <?php
                endwhile;
            else :
                echo '<p>No Case Studies found.</p>';
            endif;

            wp_reset_postdata();
            ?>
        </div>

        <!-- No case studies message -->
        <p id="no-case-studies-message" style="display: none;">No Case Studies found.</p>
    </div>
</div>

    <?php }
}

genesis();
