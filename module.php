<?php
/**
 * TUILE GNOME
 * 
 * Module d'affichage en tuile RWD des actualités de votre blog pour une front-page.
 * Le nombre maximum d'article est de 5 tuiles
 *  - 1 grande
 *  - 4 petites
 * 
 * @package GNOME
 * @version 2.3.4
 * 
 * @author Laurent Grimaldi
 */

$args = array( 'numberposts' => '5' );

$recent_posts = wp_get_recent_posts( $args );

$i = 1;

echo '<div id="tile">';
    foreach($recent_posts as $recent) {

        if($i === 1 ){
            
            echo '<div class="col one">';
                echo '<div id="tile-one">';
                    echo '<a href="'. get_permalink($recent["ID"]) .'" class="inner">';
                    echo get_the_post_thumbnail($recent["ID"]);
                        echo '<footer>';

                            echo '<aside class="inside">';
                                echo '<h3>Blog</h3>';
                            echo '</aside>';

                            echo '<aside class="outside">';
                                echo '<h3>'. $recent["post_title"] .'</h3>';
                                echo '<div class="enter-section">Entrez dans mon blog</div>';
                            echo '</aside>';
                                
                        echo '</footer>';
                    echo '</a>';
                echo '</div>';
            echo '</div>';
            wp_reset_query();
        }elseif($i === 2) {

            echo '<div class="col two">';
                echo '<div id="tile-two">';
                
                echo '<a href="'. get_permalink($recent["ID"]) .'" class="inner">';
                    echo get_the_post_thumbnail($recent["ID"]);
                    echo '<footer>';

                        echo '<figcaption>';
                            echo '<h4>'. $recent["post_title"] .'</h4>';
                        echo '</figcaption>';
                        
                    echo '</footer>';
                echo '</a>';

                echo '</div>';
            wp_reset_query();
        }elseif($i === 3) {

                echo '<div id="tile-three">';

                    echo '<a href="'. get_permalink($recent["ID"]) .'" class="inner">';
                        echo get_the_post_thumbnail($recent["ID"]);
                        echo '<footer>';

                            echo '<figcaption>';
                                echo '<h4>'. $recent["post_title"] .'</h4>';
                            echo '</figcaption>';
                            
                        echo '</footer>';
                    echo '</a>';

                echo '</div>';
            echo '</div>';
            wp_reset_query();

        }elseif($i === 4) {

            echo '<div class="col three">';
                echo '<div id="tile-four">';

                    echo '<a href="'. get_permalink($recent["ID"]) .'" class="inner">';
                        echo get_the_post_thumbnail($recent["ID"]);
                        echo '<footer>';

                            echo '<figcaption>';
                                echo '<h4>'. $recent["post_title"] .'</h4>';
                            echo '</figcaption>';
                            
                        echo '</footer>';
                    echo '</a>';

                echo '</div>';

            wp_reset_query();

        }elseif($i === 5) {

                echo '<div id="tile-five">';

                    echo '<a href="'. get_permalink($recent["ID"]) .'" class="inner">';
                        echo get_the_post_thumbnail($recent["ID"]);
                        echo '<footer>';

                            echo '<figcaption>';
                                echo '<h4>'. $recent["post_title"] .'</h4>';
                            echo '</figcaption>';
                        
                        echo '</footer>';
                    echo '</a>';

                echo '</div>';
            echo '</div>';

            wp_reset_query();
        }
        
        $i++;

    }
echo '</div>';