<?php

if( ! class_exists( 'MC_financSimulator_Shortcode') ){  
    class MC_financSimulator_Shortcode{
        public function __construct()
        {
            add_shortcode( 'mc_financSimulator', array( $this, 'add_shortcode' ) );
        }

        public function add_shortcode( $atts = array(), $content = null, $tag = '' ){
            //all caracters must be lowercase
            $atts = array_change_key_case( (array) $atts, CASE_LOWER );
            extract(shortcode_atts(
                //array with all possible parameters for this shortcode
                array(
                    'id' => '',
                    'orderby' => 'date',
                ),
                $atts,
                $tag
            ));

            if( !empty( $id )){
                $id = array_map( 'absint', explode( ',', $id ) );
            }

            //build HTML of shortcode on buffer and return
            ob_start();
            require( MC_financSimulator_PATH . 'views/mc-financSimulator-shortcode.php' );
            //enqueue all necessary scripts - register in class construct
            wp_enqueue_script( 'mc-financSimulator-main-jp' );
            wp_enqueue_style( 'mc-financSimulator-main-css' );
            wp_enqueue_style( 'mc-financSimulator-style-css' );
            //Ativa a função que interfere em um arquivo JAVASCRIPT
            mc_financSimulator_options();
            return ob_get_clean();
        }

    }
}