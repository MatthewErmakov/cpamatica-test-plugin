<?php 
/**
 * Template for outputing the posts
 * 
 * @author Matthew Ermakov <mazdaraser.91@gmail.com>
 */
?>

<div class="posts">
    <div class="posts-heading">
        <h2><?php print esc_html( $title ) ?></h2>
    </div>

    <div class="posts-inner">
        <?php 
        foreach ( $posts as $post ) { ?>
        <div class="post">
            <div class="post-inner">
                <div class="post-image">
                    <div class="post-image-inner">
                        <img src="<?php print esc_attr( $post['image_url'] ) ?>" alt="">
                    </div>
                </div>

                <div class="post-excerpts">
                    <div class="post-excerpts-inner">
                        <div class="post-category-name">
                            <span>
                                <?php 
                                foreach ( $post['category'] as $category ){
                                    print esc_html( $category->cat_name );

                                    if ( $key == (count( $post['category'] ) - 1) ){
                                        print esc_html( ", " );
                                    }
                                }
                                ?>
                            </span>
                        </div>

                        <div class="post-title">
                            <h3><?php print esc_html( $post['title'] ) ?></h3>
                        </div>

                        <div class="post-readmore">
                            <a href="<?php print esc_attr( $post['url'] ) ?>"><?php print esc_html( 'Read More' ) ?></a>
                        </div>
                        <?php if ( ! is_null( $post['rating'] ) &&
                                   ! is_null( $post['site_link'] ) ) { ?>
                        
                        <div class="etc">
                            <?php if ( ! is_null( $post['rating'] ) ) { ?>
                            <div class="post-rating">
                                <span><?php print esc_html( $post['rating'] ) ?></span>
                            </div>
                            <?php } ?>
                            
                            <?php if ( ! is_null( $post['site_link'] ) ) { ?>
                            <div class="post-site_link">
                                <a href="<?php print esc_attr( $post['site_link'] ) ?>">
                                    <?php print esc_html( 'Visit Site' ) ?>
                                </a>
                            </div>
                            <?php } ?>
                        </div>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>