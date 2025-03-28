<?php 
    $section_id = get_field('section_id_material');   
    $headline = get_field('heading_material');  
    $subheadline = get_field('subheading_material'); 
    $description = get_field('description_material');
    $padding_size = get_field('padding_size_material'); 
    $padding_top_desktop = get_field('padding_top_desktop_material'); 
    $padding_bottom_desktop = get_field('padding_bottom_desktop_material');
    $padding_top_mobile = get_field('padding_top_mobile_material'); 
    $padding_bottom_mobile = get_field('padding_bottom_mobile_material');  ?>
    <section <?php if($section_id): ?> id="<?php echo $section_id;?>" <?php endif; ?> class="section-filter-materials <?php if($padding_size): echo $padding_size['value']; endif; ?> <?php if(!$padding_top_desktop): echo ' p-lg-t0'; endif; if(!$padding_bottom_desktop): echo ' p-lg-b0'; endif; if(!$padding_top_mobile): echo ' p-mv-t0'; endif; if(!$padding_bottom_mobile): echo ' p-mv-b0'; endif; ?>">
         <div class="container">        
            <div class="row justify-center"> 
                <div class="col-xs-12 col-lg-8 col-xl-6 text-center">
                <?php if ($subheadline) : ?>
                        <div class="subheadline cl-l-orange pb-17px text-uppercase wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.2s"><?php echo $subheadline; ?></div>
                    <?php endif; ?>      
                    <?php if ($headline) : ?>
                        <h2 class="cl-black mt-0 mb-10px wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.2s"><?php echo $headline; ?></h2>
                    <?php endif; ?>
                    <?php if ($description) : ?>
                        <div class="dp-1 cl-black wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.2s"><?php echo wp_kses_post($description); ?></div>
                    <?php endif; ?>      
                    <?php if (have_rows('button_list')) {  ?> 
                        <div class="button-list-info center-xs mt-20px mt-lg-2 wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.2s">  
                        <?php while (have_rows('button_list')) { 
                            the_row(); $cta = get_sub_field('button_cta'); $button_color = get_sub_field('button_color'); ?>
                        <?php if( $cta ):
                            $link_url = $cta['url'];
                            $link_title = $cta['title'];
                            $link_target = $cta['target'] ? $cta['target'] : '_self'; 
                            ?>     
                                <div class="cta-btn">                               
                                <a tabindex="0" class="button <?php echo $button_color;?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" aria-label="<?php echo esc_html( $link_title ); ?>" title="<?php echo esc_html( $link_title ); ?>"><span class="text"><?php echo esc_html( $link_title ); ?></span></a>                             
                                </div>
                                <?php endif; ?>
                        <?php } ?>
                        </div>
                        <?php } ?>    
                </div> 
            </div>      
   <?php
        $price_filter = get_field('price_filter'); 
        $wood_species_filter = get_field('wood_species_filter');
        $length_filter = get_field('length_filter'); ?>
    
        <div class="tab-container">
            <div class="row bottom-xs">               
                <div class="col-xs-12 col-lg-12 col-filter p-sm-t3">   
                <?php if($price_filter): ?>
                    <div class="info-filter">
                    <label class="dp-1">Price</label>
                        <div class="select-dropdown">                       
                                <button href="#" role="button" data-value="" class="select-dropdown__button dropdown__button__price"><span>All </span> <i class="chevron-down"></i>
                                </button>
                            <div class="select-category select-category-price">                     
                                <?php $i = 1; foreach( $price_filter as $price_filter_option ): ?>
                                    <div class="filter-category <?php if($i == 1) echo ' active'; ?>">
                                    <a href="#" tabindex="0" aria-label="<?php echo esc_html( $price_filter_option->name ); ?>" title="<?php echo esc_html( $price_filter_option->name ); ?>" class="material-link select-dropdown__list-item" data-term-id="<?php echo $price_filter_option->term_id; ?>" data-taxonomy="<?php echo $price_filter_option->taxonomy; ?>" value="<?php echo $price_filter_option->term_id; ?>"><?php echo esc_html( $price_filter_option->name ); ?></a>                                                 
                                    </div>	
                                    <?php $i++; endforeach; ?>  
                            </div> 
                     </div>
                      </div>
                <?php endif; ?>   
                <?php if($wood_species_filter): ?>
                    <div class="info-filter">
                    <label class="dp-1">Wood Species</label>
                        <div class="select-dropdown">                       
                                <button href="#" role="button" data-value="" class="select-dropdown__button dropdown__button__species"><span>All </span> <i class="chevron-down"></i>
                                </button>
                            <div class="select-category select-category-species">                     
                                <?php $i = 1; foreach( $wood_species_filter as $wood_species_filter_option ): ?>
                                    <div class="filter-category <?php if($i == 1) echo ' active'; ?>">
                                    <a href="#" tabindex="0" aria-label="<?php echo esc_html( $wood_species_filter_option->name ); ?>" title="<?php echo esc_html( $wood_species_filter_option->name ); ?>" class="material-link select-dropdown__list-item" data-term-id="<?php echo $wood_species_filter_option->term_id; ?>" data-taxonomy="<?php echo $wood_species_filter_option->taxonomy; ?>" value="<?php echo $wood_species_filter_option->term_id; ?>"><?php echo esc_html( $wood_species_filter_option->name ); ?></a>                                                 
                                    </div>	
                                    <?php $i++; endforeach; ?>  
                            </div> 
                     </div>
                      </div>
                <?php endif; ?>
                <?php if($length_filter): ?>
                    <div class="info-filter">
                    <label class="dp-1">Length</label>
                        <div class="select-dropdown">                       
                                <button href="#" role="button" data-value="" class="select-dropdown__button dropdown__button__length"><span>All </span> <i class="chevron-down"></i>
                                </button>
                            <div class="select-category select-category-length">                     
                                <?php $i = 1; foreach( $length_filter as $length_filter_option ): ?>
                                    <div class="filter-category <?php if($i == 1) echo ' active'; ?>">
                                    <a href="#" tabindex="0" aria-label="<?php echo esc_html( $length_filter_option->name ); ?>" title="<?php echo esc_html( $length_filter_option->name ); ?>" class="material-link select-dropdown__list-item" data-term-id="<?php echo $length_filter_option->term_id; ?>" data-taxonomy="<?php echo $length_filter_option->taxonomy; ?>" value="<?php echo $length_filter_option->term_id; ?>"><?php echo esc_html( $length_filter_option->name ); ?></a>                                                 
                                    </div>	
                                    <?php $i++; endforeach; ?>  
                            </div> 
                     </div>
                      </div>
                <?php endif; ?>
                </div>                  
            </div> 
            <div class="filter-content p-t1" id="materials">  
                <?php 
                $query = array(
                    'post_type' => array( 'material' ),     //Materials CPT
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'desc',
                    'posts_per_page' => 8
                );
                $allpost = new WP_Query($query);
                $total = $allpost->found_posts; 
                if ( $allpost->have_posts() ) {   ?>
                    <div class="row materials-row materials-filters center-xs">
                        <?php while($allpost->have_posts()) : $allpost->the_post();                        
                        $post_thumbnail_id = get_post_meta( get_the_id(), '_thumbnail_id', true );
                        $srcset = wp_get_attachment_image_srcset($post_thumbnail_id);
                        $sizes = wp_get_attachment_image_sizes($post_thumbnail_id, 'full');
                        $id = get_the_id();
                        $price = get_field('price');  
                        $terms_list = array(); 
                        $terms_list_imp = ""; ?>                
                        <div class="col-xs-12 col-md-6 col-lg-4 col-xl-3 col-materials m-t2">
                            <div class="box-card h-100">
                                <div class="card-media">
                                    <a class="w-100 h-100" tab-index="0" href="<?php the_post_thumbnail_url('full'); ?>" data-fancybox="gallery" aria-label="<?php the_title(); ?>" title="<?php the_title(); ?>">
                                      <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>" height="241" srcset="<?php echo esc_attr($srcset); ?>" sizes="<?php echo esc_attr($sizes); ?>">
                                    </a>
                                </div>
                                <div class="card-footer text-center bg-black">
                                    <?php if ($price) : ?>
                                        <div class="subheadline cl-l-orange pb-10px text-uppercase wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.2s">$<?php echo $price; ?></div>
                                    <?php endif; ?>  
                                    <h4 class="cl-white"><?php the_title(); ?></h4>
                                   
                                    <?php $terms_wood_species = get_the_terms( $id , 'wood-species' ); 
                                    if(!empty($terms_wood_species)):
                                        foreach ( $terms_wood_species as $term ) {    
                                            if($term->name != "All"):                                   
                                            $terms_list[] =  $term->name;
                                            endif;
                                        }   
                                    endif;   
                                    $terms_length = get_the_terms( $id , 'length' ); 
                                        if(!empty($terms_length)):
                                        foreach ( $terms_length as $term ) {    
                                            if($term->name != "All"):                                    
                                            $terms_list[] =  $term->name;
                                            endif;
                                        }  
                                     endif;   
                                     $terms_thickness = get_the_terms( $id , 'thickness' ); 
                                     if(!empty($terms_thickness)):
                                     foreach ( $terms_thickness as $term ) {    
                                         if($term->name != "All"):                                    
                                         $terms_list[] =  $term->name;
                                         endif;
                                     }  
                                  endif;                                 
                                    ?>
                                    <?php if(!empty($terms_list)): ?>
                                     <div class="dp-1 cl-white">
                                        <?php if(sizeof($terms_list) > 1){ 
                                            $terms_list_imp = implode(', ', $terms_list); 
                                            echo $terms_list_imp; 
                                        }else{  echo implode($terms_list); }  ?>  
                                    </div>
                                    <?php endif; ?>
                                </div>                               
                             </div>
                         </div>
                        <?php endwhile; ?>
                    </div>
                <?php  wp_reset_postdata(); 
                } else {
                    echo '<p class="cl-black text-center">No materials items found.</p>';
                }?>  
            </div> 
			<?php if($total > 8): ?>
            <div class="row center-xs">
                <div class="col-md-12">
                    <div class="button-list-info center-xs wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.2s">  
                        <div class="btn__wrapper button-wrapper cta-btn">
                            <a href="#!" class="button black m-t3" id="load-more" tabindex="0" aria-label="Load More" title="Load More"><span class="text">Load more</span></a>
                        </div>    
                    </div>   
                </div>
            </div> 
			<?php endif; ?>
    </div>                                
       </div>             
</section>