<?php
/*
    Plugin Name: Tuile
    Plugin URI: https://laminedelaurent.dev/plugins/tuile
    Description: L'extention <strong>Tuile</strong> ajoute à votre wordpress une façon d'ajouter un résumé de 5 articles sous forme de tuiles totalement responsive. 
    Version: 0.0.1
    Author: Laurent Grimaldi
    Author URI: https://laminedelaurent.dev/
    License: GPLv2 or later
    Text Domain: tuile
*/

/**
 * @package WordPress
 * @version 0.0.1
 * @author Laurent Grimaldi
 */

define( 'GNOME_VERSION', '5.2.1' );
define( 'GNOME__MINIMUM_WP_VERSION', '5.0' );



function load_all_assets_tuile_lg() {
    if(!is_admin()) {
        wp_enqueue_style( 'tuile_laurent_css', plugin_dir_url( __FILE__ ) .'assets/css/style.css', array(), NULL, NULL);
    }
}
add_action('wp_enqueue_scripts', 'load_all_assets_tuile_lg', 101);


function generate_tile_area() {

    register_widget( 'blog_resume_widget' );
}
add_action( 'widgets_init', 'generate_tile_area' );

class blog_resume_widget extends WP_Widget {
    function __construct() {
        
        parent::__construct(
            'blog_resume_widget', //id
            __('TROLL - Tuile', 'blog_resume_domain'), //name
            array( 'description' => __( 'Ajout de 5 tuiles résumé pour vos articles en page d\'accueil', 'blog_resume_domain' ), ) //description
        );
    }

    public function widget( $args, $instance ) {

        $name = $instance['name'];
        $url = $instance['url'];
        $target = $instance['target'];
        $title_widget = $instance['title_widget'];

        //affichage côté front-office 
            echo $args['before_widget'];
            echo "<div class='text-center'>";
            echo "<h2 class='title'>". $title_widget ."</h2>";
            echo "</div>";
            include_once "module.php";
            echo "<div class='text-center'>";
            echo "<a href='". $url ."' target='". $target ."' rel='noopener noreferrer' class='btn'>". $name ."</a>";
            echo "</div>";
        echo $args['after_widget'];
    }

    public function form( $instance ) {

        if ( isset( $instance[ 'title_widget' ] ) )
            $title_widget = $instance[ 'title_widget' ];
        else
        $title_widget = __( 'Titre', 'blog_resume_domain' );
        if ( isset( $instance[ 'name' ] ) )
            $name = $instance[ 'name' ];
        else
        $name = __( 'Nom du bouton', 'blog_resume_domain' );

        if ( isset( $instance[ 'url' ] ) )
            $url = $instance[ 'url' ];
        else
        $url = __( '#', 'blog_resume_domain' );

        if ( isset( $instance[ 'target' ] ) )
            $target = $instance[ 'target' ];
        else
        $target = __( '', 'blog_resume_domain' );

        $target_list = [
            [
                "title" => "Ouverture dans l'onglet actif",
                "target" => "", 
            ],
            [
                "title" => "Ouverture dans un nouvel onglet",
                "target" => "_blank", 
            ],
            [
                "title" => "Ouverture dans l'onglet sélectionné",
                "target" => "_self", 
            ],
            [
                "title" => "Ouverture dans l'onglet parent",
                "target" => "_parent", 
            ],
            [
                "title" => "Ouverture en premier plan de la fenêtre",
                "target" => "_top", 
            ],
        ];
    ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title_widget' ); ?>"><?php _e( 'Titre:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title_widget' ); ?>" name="<?php echo $this->get_field_name( 'title_widget' ); ?>" type="text" value="<?php echo esc_attr( $title_widget ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Nom du bouton:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL :' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'target' ); ?>"><?php _e( 'Type d\'ouverture :' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'target' ); ?>">
                <option value="<?php echo esc_attr( $target ); ?>"><?php echo esc_attr( $target ); ?></option>
                <?php foreach ($target_list as $select_target) {  // new subarray keys
                        echo '<option value=\'' . $select_target['target'] . '\'>' . $select_target['title'] .' - ('.  $select_target['target'] .')</option>';
                    };
                ?>
            </select>
        </p>
        <p style="text-align: right;">
            <span>version 0.0.1</span>
        </p>
    <?php
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array();
                $instance['name'] = ( ! empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : '';
                $instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
                $instance['target'] = ( ! empty( $new_instance['target'] ) ) ? strip_tags( $new_instance['target'] ) : '';
                $instance['title_widget'] = ( ! empty( $new_instance['title_widget'] ) ) ? strip_tags( $new_instance['title_widget'] ) : '';
            return $instance;
        }
}