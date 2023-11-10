<?php
/**
 * Plugin Name:         My Wordpress Widget
 * Description:         Custom Worpress widget to learn developing wordpress plugins.
 * Plugin URI:          https://wordpress.com/plugins/
 * Version:             1.0.0
 * Requires at least:   5.2
 * Requires PHP:        7.2
 * Author:              Prosanto Deb
 * Author URI:          https://developers.wordpress.com/
 * License:             GPLv3
 * License URI:         https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:         mywpwidget
 */

 /**
  * Including css
  */
  function mywpwidget_enqueue_style() {
    wp_enqueue_style( 'mywpwidget-style', plugins_url( 'css/mywpwidget-style.css', __FILE__ ) );
  }
  add_action( "wp_enqueue_scripts", "mywpwidget_enqueue_style" );


  /**
   * Including Javascript
   */
  function mywpwidget_enqueue_script() {
    // wp_enqueue_script( 'jquery' );
    // wp_enqueue_script( 'mywpwidget-plugin', plugins_url( 'js/mywpwidget-plugin.js', __FILE__ ) );
    wp_enqueue_script( 'mywpwidget-plugin', plugins_url( 'js/mywpwidget-plugin.js', __FILE__ ), array( 'jquery' ), '1.0', true );
  }
  add_action( "wp_enqueue_scripts", "mywpwidget_enqueue_script" );


  // Plugin Activation
  function mywpwidget_scroll_script () {
    ?>
    <script>
      jQuery(document).ready(function () {
        jQuery.scrollUp();
      });
    </script>
    <?php
  }

  add_action( "wp_footer", "mywpwidget_scroll_script" );


  // Plugin Customisation Settings
  function mywpwidget_customize_register ( $wp_customize ) {

    $wp_customize-> add_section('mywpwidget_scroll_top_section', array(
      'title' => __('Scroll To Top', 'mywpwidget'),
      'description' => 'Custom Worpress widget to learn developing wordpress plugins.'
    ));


    $wp_customize-> add_setting('mywpwidget_default_color', array(
      'default' => '#000000'
    ));

    $wp_customize-> add_control(new WP_Customize_Color_Control ( $wp_customize, 'mywpwidget_default_color', array(
      'label' => 'Background Color',
      'section' => 'mywpwidget_scroll_top_section'
    )));


    // Adding Border Radius
    $wp_customize-> add_setting('mywpwidget_border_radius', array(
      'default' => '5px',
      'description' => 'If you need fully rounded or circular then use 25px here'
    ));


    $wp_customize-> add_control('mywpwidget_border_radius', array(
      'label' => 'Rounded Corner',
      'section' => 'mywpwidget_scroll_top_section',
      'type' => 'text'
    ));
   
  }

  add_action( "customize_register", "mywpwidget_customize_register" );
  

  // Theme Css Customization
  function mywpwidget_color_customization() {
    ?> 
      <style>
        #scrollUp {
          background-color: <?php print get_theme_mod("mywpwidget_default_color") ?>;
          border-radius: <?php print get_theme_mod("mywpwidget_border_radius") ?>;
        }
      </style>
    <?php
  }

  add_action( "wp_head", "mywpwidget_color_customization" );
  
?>
