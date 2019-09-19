<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.greentreelabs.net
 * @since      1.0.0
 *
 * @package    Photoblocks
 * @subpackage Photoblocks/admin
 */
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Photoblocks
 * @subpackage Photoblocks/admin
 * @author     Diego Imbriani <diego@greentreelabs.net>
 */
class Photoblocks_Admin
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private  $plugin_name ;
    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private  $version ;
    /**
     * Gallery settings
     *
     * @since    1.0.0
     * @access   private
     * @var      array    $settings    Gallery settings
     */
    private  $settings ;
    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version, $settings )
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->settings = $settings;
        $this->ajax_actions();
    }
    
    /**
     * Retrieve available image sizes
     *
     * @since    1.0.0
     */
    function list_image_sizes()
    {
        global  $_wp_additional_image_sizes ;
        $sizes = array();
        foreach ( get_intermediate_image_sizes() as $_size ) {
            
            if ( in_array( $_size, array(
                'thumbnail',
                'medium',
                'medium_large',
                'large'
            ) ) ) {
                $sizes[$_size]['width'] = get_option( "{$_size}_size_w" );
                $sizes[$_size]['height'] = get_option( "{$_size}_size_h" );
                $sizes[$_size]['crop'] = (bool) get_option( "{$_size}_crop" );
            } elseif ( isset( $_wp_additional_image_sizes[$_size] ) ) {
                $sizes[$_size] = array(
                    'width'  => $_wp_additional_image_sizes[$_size]['width'],
                    'height' => $_wp_additional_image_sizes[$_size]['height'],
                    'crop'   => $_wp_additional_image_sizes[$_size]['crop'],
                );
            }
        
        }
        return $sizes;
    }
    
    /**
     * Check if cache dir is writable
     *
     * @since    1.1.9
     */
    public function is_cache_dir_writable()
    {
        $file = PHOTOBLOCKS_DIR . "/public/cache/" . time() . '.txt';
        $stream = @fopen( $file, 'w' );
        
        if ( $stream ) {
            fclose( $stream );
            unlink( $file );
            return true;
        } else {
            return false;
        }
    
    }
    
    /**
     * Check permissions on cache folder and try to fix it
     *
     * @since    1.1.9
     */
    public function check_cache_permissions()
    {
        $fixed = false;
        
        if ( !$this->is_cache_dir_writable() ) {
            $plugin_chmod = @chmod( PHOTOBLOCKS_DIR . "/public", 0755 );
            $timthumb_chmod = @chmod( PHOTOBLOCKS_DIR . "/public/timthumb.php", 0755 );
            $cache_chmod = @chmod( PHOTOBLOCKS_DIR . "/public/cache", 0755 );
            $index_chmod = @chmod( PHOTOBLOCKS_DIR . "/public/cache/index.html", 0755 );
            if ( $plugin_chmod && $cache_chmod && $index_chmod && $timthumb_chmod ) {
                $fixed = true;
            }
        }
        
        
        if ( !$this->is_cache_dir_writable() ) {
            
            if ( $fixed ) {
                function timthumb_big_problem()
                {
                    echo  "<div class='error fade'><p>" . __( 'The thumbnails cache folder is not writable! <a href="?page=photoblocks-troubleshooting#cache">Click here to read how you can fix this.</a> Unless you do so your images might not appear and the plugin could only generate whitespace!', 'photoblocks' ) . " " . __( 'The plugin was trying to fix it but the 0755 permission was not enough.', 'photoblocks' ) . "</p></div>" ;
                }
                
                add_action( 'admin_notices', 'timthumb_big_problem' );
            } else {
                function timthumb_problem()
                {
                    echo  "<div class='error fade'><p> " . __( 'The thumbnails cache folder is not writable! <a href="?page=photoblocks-troubleshooting#cache">Click here to read how you can fix this.</a> Unless you do so your images might not appear and the plugin could only generate whitespace!', 'photoblocks' ) . "</p></div>" ;
                }
                
                add_action( 'admin_notices', 'timthumb_problem' );
            }
        
        } else {
            
            if ( $fixed ) {
                function timthumb_fixed()
                {
                    echo  "<div class='updated fade'><p> " . __( 'The thumbnails cache folder was not writable! This was automatically fixed for you.', 'photoblocks' ) . "</p></div>" ;
                }
                
                add_action( 'admin_notices', 'timthumb_fixed' );
            }
        
        }
    
    }
    
    /**
     * Register ajax actions
     *
     * @since    1.0.0
     */
    private function ajax_actions()
    {
        add_action( 'wp_ajax_pb_save_gallery', array( $this, 'save_gallery' ) );
        add_action( 'wp_ajax_pb_load_gallery', array( $this, 'load_gallery' ) );
        add_action( 'wp_ajax_photoblocks_dismiss_review', array( $this, 'dismiss_review' ) );
    }
    
    /**
     * Save gallery
     *
     * @since    1.0.0
     */
    public function save_gallery()
    {
        global  $wpdb ;
        //error_reporting(E_ALL);
        //ini_set('display_errors', 'On');
        
        if ( check_admin_referer( 'photoblocks', 'photoblocks' ) ) {
            header( "Content-type: application/json" );
            $id = intval( $_POST['id'] );
            unset( $_POST['action'] );
            unset( $_POST['id'] );
            unset( $_POST['photoblocks'] );
            $data = json_decode( stripslashes( $_POST['settings'] ), true );
            foreach ( $data as $k => $v ) {
                if ( $k == 'blocks' ) {
                    continue;
                }
                $data[$k] = $v;
            }
            $r = array(
                'success' => false,
                'id'      => $id,
            );
            $wpdb->show_errors = true;
            
            if ( $id > 0 ) {
                $r['success'] = $wpdb->update( $wpdb->photoblocks, array(
                    'updated' => date( "Y-m-d H:i:s" ),
                    'name'    => $data['name'],
                    'data'    => stripslashes( $_POST['settings'] ),
                    'blocks'  => stripslashes( $_POST['blocks'] ),
                ), array(
                    'id' => $id,
                ) );
            } else {
                $r['success'] = $wpdb->insert( $wpdb->photoblocks, array(
                    'created' => date( 'Y-m-d H:i:s' ),
                    'updated' => date( 'Y-m-d H:i:s' ),
                    'name'    => $data['name'],
                    'data'    => json_encode( $data ),
                    'blocks'  => stripslashes( $_POST['blocks'] ),
                ) );
                $r['id'] = $wpdb->insert_id;
            }
            
            if ( $r['id'] == 0 ) {
                //$wpdb->print_error();
                
                if ( $wpdb->last_error == '' ) {
                    $str = htmlspecialchars( $wpdb->last_result, ENT_QUOTES );
                    $query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );
                    $r['message'] = $str . "<br>" . $query;
                } else {
                    $r['message'] = $wpdb->last_error;
                }
            
            }
            header( "Content-type: application/json" );
            echo  json_encode( $r ) ;
            wp_die();
        }
    
    }
    
    /**
     * Init admin area
     *
     * @since    1.0.0
     */
    public function init()
    {
        global  $wpdb ;
        
        if ( isset( $_GET['action'] ) ) {
            
            if ( $_GET['action'] == "delete" && isset( $_GET['id'] ) ) {
                $wpdb->delete( $wpdb->photoblocks, array(
                    "id" => $_GET['id'],
                ), array( '%d' ) );
                wp_redirect( admin_url( 'admin.php?page=' . $this->plugin_name ), 301 );
                exit;
            }
            
            
            if ( $_GET['action'] == "clone" && isset( $_GET['id'] ) ) {
                $wpdb->get_results( $wpdb->prepare( "insert into {$wpdb->photoblocks} (created, updated, name, data, blocks) select now(), now(), concat(name, ' (cloned)'), data, blocks from {$wpdb->photoblocks} where id=%d", $_GET['id'] ) );
                wp_redirect( admin_url( 'admin.php?page=' . $this->plugin_name ), 301 );
                exit;
            }
        
        }
        
        $this->check_cache_permissions();
        register_setting( $this->plugin_name, $this->plugin_name );
        //$this->check_default_values();
    }
    
    public function review()
    {
        global  $wpdb ;
        // Verify that we can do a check for reviews.
        $review = get_option( 'photoblocks_review' );
        $time = time();
        $load = false;
        $there_was_review = false;
        
        if ( !$review ) {
            $review = array(
                'time'      => $time,
                'dismissed' => false,
            );
            $load = true;
            $there_was_review = false;
        } else {
            // Check if it has been dismissed or not.
            if ( isset( $review['dismissed'] ) && !$review['dismissed'] && (isset( $review['time'] ) && $review['time'] + DAY_IN_SECONDS <= $time) ) {
                $load = true;
            }
        }
        
        // If we cannot load, return early.
        if ( !$load ) {
            return;
        }
        // Update the review option now.
        update_option( 'photoblocks_review', $review );
        // Run through optins on the site to see if any have been loaded for more than a week.
        $valid = false;
        $galleries = $wpdb->get_results( 'SELECT id, name from ' . $wpdb->photoblocks . ' order by id' );
        if ( !$galleries ) {
            return;
        }
        $with_date = false;
        foreach ( $galleries as $gallery ) {
            if ( !isset( $gallery->created ) ) {
                continue;
            }
            $with_date = true;
            $data = $gallery->created;
            // Check the creation date of the local optin. It must be at least one week after.
            $created = ( isset( $data ) ? strtotime( $data ) + 7 * DAY_IN_SECONDS : false );
            if ( !$created ) {
                continue;
            }
            
            if ( $created <= $time ) {
                $valid = true;
                break;
            }
        
        }
        if ( !$with_date && count( $galleries ) > 0 && !$there_was_review ) {
            $valid = true;
        }
        // If we don't have a valid optin yet, return.
        if ( !$valid ) {
            return;
        }
        ?>
		<div class="notice notice-info is-dismissible photoblocks-review-notice">
			<p><?php 
        _e( 'Hey, I noticed you created a photo gallery with PhotoBlocks - that’s awesome! Would you mind give it a 5-star rating on WordPress to help us spread the word and boost our motivation for new features?', 'photoblocks' );
        ?>
</p>
			<p><strong><?php 
        _e( 'Diego Imbriani<br>Founder of GreenTreeLabs', 'photoblocks' );
        ?>
</strong></p>
			<p>
				<a href="https://wordpress.org/support/plugin/photoblocks-grid-gallery/reviews/?filter=5#new-post" class="photoblocks-dismiss-review-notice photoblocks-review-out" target="_blank" rel="noopener"><?php 
        _e( 'Ok, you deserve it', 'photoblocks' );
        ?>
</a><br>
				<a href="#" class="photoblocks-dismiss-review-notice" rel="noopener"><?php 
        _e( 'Nope, maybe later', 'photoblocks' );
        ?>
</a><br>
				<a href="#" class="photoblocks-dismiss-review-notice" rel="noopener"><?php 
        _e( 'I already did', 'photoblocks' );
        ?>
</a><br>
			</p>
		</div>
		<script type="text/javascript">
			jQuery(document).ready( function($) {
				$(document).on('click', '.photoblocks-dismiss-review-notice, .photoblocks-review-notice button', function( event ) {
					if ( ! $(this).hasClass('photoblocks-review-out') ) {
						event.preventDefault();
					}

					$.post( ajaxurl, {
						action: 'photoblocks_dismiss_review'
					});

					$('.photoblocks-review-notice').remove();
				});
			});
		</script>
		<?php 
    }
    
    public function dismiss_review()
    {
        $review = get_option( 'photoblocks_review' );
        if ( !$review ) {
            $review = array();
        }
        $review['time'] = time();
        $review['dismissed'] = true;
        update_option( 'photoblocks_review', $review );
        die;
    }
    
    public function admin_footer( $text )
    {
        global  $current_screen ;
        
        if ( !empty($current_screen->id) && strpos( $current_screen->id, 'ftg' ) !== false ) {
            $url = 'https://wordpress.org/support/plugin/photoblocks-grid-gallery/reviews/?filter=5#new-post';
            $text = sprintf( __( 'Please rate <strong>PhotoBlocks</strong> <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> on <a href="%s" target="_blank">WordPress.org</a> to help us spread the word. Thank you from the PhotoBlocks team!', 'wpforms' ), $url, $url );
        }
        
        return $text;
    }
    
    /**
     * Add menu
     *
     * @since    1.0.0
     */
    public function menu()
    {
        $this->dashboard_page = add_menu_page(
            'Dashboard - PhotoBlocks',
            'PhotoBlocks',
            'edit_posts',
            $this->plugin_name,
            array( $this, 'dashboard' ),
            plugin_dir_url( __FILE__ ) . '/icon.png'
        );
        $this->add_page = add_submenu_page(
            $this->plugin_name,
            __( 'Add new' ) . " - PhotoBlocks",
            __( 'Add new' ),
            'edit_posts',
            $this->plugin_name . '-edit',
            array( $this, 'edit' )
        );
        $this->troubleshooting_page = add_submenu_page(
            $this->plugin_name,
            __( 'Troubleshooting' ) . " - PhotoBlocks",
            __( 'Troubleshooting' ),
            'edit_posts',
            $this->plugin_name . '-troubleshooting',
            array( $this, 'troubleshooting' )
        );
    }
    
    /**
     * Dashboard page
     *
     * @since    1.0.0
     */
    public function dashboard()
    {
        global  $wpdb ;
        $_bag = array();
        $_bag["galleries"] = $wpdb->get_results( 'SELECT id, name from ' . $wpdb->photoblocks . ' order by id' );
        include "partials/photoblocks-dashboard.php";
    }
    
    /**
     * Add new gallery page
     *
     * @since    1.0.0
     */
    public function edit()
    {
        $path = plugin_dir_path( __FILE__ );
        include "partials/photoblocks-edit.php";
    }
    
    /**
     * Troubleshooting page
     *
     * @since    1.0.14
     */
    public function troubleshooting()
    {
        include "partials/photoblocks-troubleshooting.php";
    }
    
    public function load_gallery()
    {
        global  $wpdb ;
        $data = null;
        
        if ( isset( $_POST['id'] ) && !empty($_POST['id']) ) {
            $data = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->photoblocks . ' WHERE id=%d', intval( $_POST['id'] ) ), ARRAY_A );
            $data["blocks"] = json_decode( $data["blocks"], true );
            if ( !photob_fs()->is_plan_or_trial( "ultimate" ) ) {
                foreach ( $data["blocks"] as &$blocks ) {
                    if ( isset( $blocks["blocks"] ) && is_array( $blocks["blocks"] ) ) {
                        foreach ( $blocks["blocks"] as &$block ) {
                            if ( $block["type"] == "text" ) {
                                $block["type"] = "empty";
                            }
                        }
                    }
                }
            }
            $values = array_merge( $this->settings->default_values(), json_decode( $data["data"], true ) );
            $data["data"] = $values;
        } else {
            $data = array(
                "data"   => $this->settings->default_values(),
                "blocks" => array(),
            );
        }
        
        header( "Content-type: application/json" );
        echo  json_encode( $data ) ;
        wp_die();
    }
    
    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style(
            'minicolor',
            plugin_dir_url( __FILE__ ) . 'css/jquery.minicolors.css',
            array(),
            $this->version,
            'all'
        );
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'css/photoblocks-admin.css',
            array( 'minicolor' ),
            $this->version,
            'all'
        );
    }
    
    /**
     * Add body classes
     *
     * @since    1.0.0
     */
    public function body_class( $classes )
    {
        if ( isset( $_GET['page'] ) && $_GET['page'] == $this->plugin_name . '-edit' ) {
            $classes = "{$classes} photoblocks-app";
        }
        return $classes;
    }
    
    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        if ( function_exists( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery-ui-resizable' );
        wp_enqueue_script( 'jquery-ui-draggable' );
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_script( 'thickbox' );
        wp_enqueue_script(
            'minicolors',
            plugin_dir_url( __FILE__ ) . 'js/jquery.minicolors.min.js',
            array( 'jquery' ),
            $this->version,
            false
        );
        wp_enqueue_script(
            'packery',
            plugin_dir_url( __FILE__ ) . '../public/js/packery.pkgd.js',
            array( 'jquery' ),
            $this->version,
            false
        );
        wp_enqueue_script(
            $this->plugin_name . '-toast',
            plugin_dir_url( __FILE__ ) . 'js/photoblocks.toast.js',
            array( 'jquery' ),
            $this->version,
            false
        );
        wp_enqueue_script(
            $this->plugin_name . '-grid',
            plugin_dir_url( __FILE__ ) . 'js/photoblocks.grid.js',
            array( 'jquery' ),
            $this->version,
            false
        );
        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'js/photoblocks.admin.js',
            array(
            'jquery',
            'minicolors',
            'packery',
            $this->plugin_name . '-grid'
        ),
            $this->version,
            false
        );
    }

}