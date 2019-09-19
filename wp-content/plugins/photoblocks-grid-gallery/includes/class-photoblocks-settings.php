<?php

/**
 * PhotoBlocks settings class
 *
 * @link       http://www.greentreelabs.net
 * @since      1.0.0
 *
 * @package    Photoblocks
 * @subpackage Photoblocks/includes
 */
class Photoblocks_Settings
{
    public  $fields ;
    public function __construct()
    {
        $this->setup_fields();
    }
    
    /**
     * List post types
     *
     * @since    1.0.14
     */
    public function get_post_types()
    {
        $types = array();
        foreach ( get_post_types( array(
            'publicly_queryable' => true,
        ), 'objects' ) as $t ) {
            $types[$t->label] = $t->name;
        }
        return $types;
    }
    
    /**
     * List taxonomies
     *
     * @since    1.0.14
     */
    public function get_taxonomies()
    {
        $types = array();
        if ( is_admin() ) {
            foreach ( get_taxonomies( array(
                'publicly_queryable' => true,
            ), 'objects' ) as $taxonomy => $t ) {
                foreach ( get_terms( $taxonomy, array(
                    "hide_empty" => false,
                ) ) as $c ) {
                    $types[$c->term_id] = $c->name;
                }
            }
        }
        return $types;
    }
    
    /**
     * List default values
     *
     * @since    1.0.0
     */
    public function default_values()
    {
        $values = array();
        foreach ( $this->fields as $section ) {
            foreach ( $section as $group ) {
                foreach ( $group["fields"] as $code => $data ) {
                    if ( array_key_exists( "default", $data ) ) {
                        $values[$code] = $data["default"];
                    }
                }
            }
        }
        return $values;
    }
    
    /**
     * Add field
     *
     * @since    1.0.0
     */
    private function add_field(
        $section,
        $group,
        $name,
        $code,
        $type,
        $extra
    )
    {
        if ( !isset( $this->fields[$section] ) ) {
            $this->fields[$section] = array();
        }
        if ( !isset( $this->fields[$section][$group] ) ) {
            $this->fields[$section][$group] = array(
                "name" => $group,
            );
        }
        if ( !isset( $this->fields[$section][$group]["fields"] ) ) {
            $this->fields[$section][$group]["fields"] = array();
        }
        $this->fields[$section][$group]["fields"][$code] = array(
            "name"         => $name,
            "code"         => $code,
            "type"         => $type,
            "description"  => "",
            "css_classes"  => "",
            "onchange"     => "",
            "show_if"      => "",
            "render"       => true,
            "premium"      => array(),
            "premium_only" => false,
            "min_plan"     => "free",
        );
        foreach ( $extra as $key => $value ) {
            $this->fields[$section][$group]["fields"][$code][$key] = $value;
        }
        //if (photob_fs()->is_not_paying())
        foreach ( $this->fields[$section][$group]["fields"][$code]["premium"] as $v => $min_plan ) {
            // $v -> fancybox
            // $plans -> array('ultimate')
            $show_premium = true;
            
            if ( photob_fs()->is_plan_or_trial( $min_plan ) ) {
                $show_premium = false;
                break;
            }
            
            
            if ( $show_premium ) {
                if ( $type == "select" ) {
                    $this->fields[$section][$group]["fields"][$code]["values"][$v] .= "  » premium";
                }
                if ( $type == "hover_effect" ) {
                    $this->fields[$section][$group]["fields"][$code]["values"][$v]["name"] .= "  » premium";
                }
            }
        
        }
        return $this->fields[$section][$group]["fields"][$code];
    }
    
    /**
     * Get a setting value from a gallery and check if the
     * gallery value is valid based on the current user plan
     *
     * @since    1.0.0
     */
    public function get( $gallery, $field )
    {
        $saved_value = null;
        if ( isset( $gallery[$field] ) ) {
            $saved_value = $gallery[$field];
        }
        //print "\n\nsaved $field $saved_value\n";
        foreach ( $this->fields as $section ) {
            foreach ( $section as $group ) {
                foreach ( $group["fields"] as $code => $data ) {
                    
                    if ( $code == $field ) {
                        // are there premium values for this field?
                        //print "check $code ($saved_value)\n";
                        if ( !array_key_exists( "premium", $data ) ) {
                            return $saved_value;
                        }
                        // is this a free feature?
                        if ( !$data["premium_only"] ) {
                            //print "return premium_only\n";
                            return $saved_value;
                        }
                        
                        if ( $data["premium_only"] ) {
                            $min_plan = $data["min_plan"];
                            //print "min plan is $min_plan\n";
                            
                            if ( photob_fs()->is_plan_or_trial( $min_plan ) ) {
                                //print "plan it's ok $saved_value\n";
                                return $saved_value;
                            } else {
                                //print "returning default value\n";
                                return ( isset( $data["default"] ) ? $data["default"] : "" );
                            }
                        
                        }
                        
                        // is the saved value a premium value?
                        
                        if ( array_key_exists( $saved_value, $data["premium"] ) ) {
                            //print "there's a premium value\n";
                            $min_plan = $data["premium"][$saved_value];
                            //print "min plan is $min_plan\n";
                            // is the current plan enough to use the saved value?
                            
                            if ( photob_fs()->is_plan_or_trial( $min_plan ) ) {
                                //print "value $saved_value can be used\n";
                                return $saved_value;
                            } else {
                                //print "value $saved_value can't be used\n";
                                return $data["default"];
                            }
                        
                        } else {
                            return $saved_value;
                        }
                        
                        break;
                    }
                
                }
            }
        }
        return $saved_value;
    }
    
    /**
     * Setup fields for options and features
     *
     * @since    1.0.0
     */
    private function setup_fields()
    {
        $this->fields = array();
        $this->fields["gallery"] = array();
        $this->fields["lightbox"] = array();
        $this->fields["captions"] = array();
        $this->fields["filters"] = array();
        $this->fields["customisations"] = array();
        /*
         * Gallery / Advanced
         */
        $this->add_field(
            "gallery",
            "General",
            "Gallery name",
            "name",
            "text",
            array(
            "description" => "Friendly name for this gallery, it won't be shown on your site",
            "default"     => "",
        )
        );
        $this->add_field(
            "gallery",
            "General",
            "Gallery width",
            "width",
            "text",
            array(
            "description" => "Enter a value in px or %",
            "default"     => "100%",
        )
        );
        $this->add_field(
            "gallery",
            "General",
            "Loading effect",
            "loading_effect",
            "select",
            array(
            "description"     => "Effect of the blocks for when they become visible",
            "values"          => array(
            "fade"            => "Fade in",
            "pop"             => "Pop",
            "slideFromTop"    => "Slide from top",
            "slideFromBottom" => "Slide from bottom",
            "slideFromLeft"   => "Slide from left",
            "elastic"         => "Elastic",
            "elastic2"        => "Elastic 2",
            "wobble"          => "Wobble",
            "deal"            => "Deal",
            "stretch"         => "Stretch",
        ),
            "premium"         => array(
            "pop"             => "ultimate",
            "slideFromTop"    => "ultimate",
            "slideFromBottom" => "ultimate",
            "slideFromLeft"   => "ultimate",
            "elastic"         => "ultimate",
            "elastic2"        => "ultimate",
            "wobble"          => "ultimate",
            "deal"            => "ultimate",
            "stretch"         => "ultimate",
        ),
            "default"         => "fade",
            "default_premium" => "pop",
        )
        );
        $this->add_field(
            "gallery",
            "General",
            "Shuffle",
            "shuffle",
            "toggle",
            array(
            "description" => "Shuffle images at every page reload",
            "default"     => "0",
        )
        );
        $this->add_field(
            "gallery",
            "General",
            "Padding",
            "padding",
            "number",
            array(
            "description" => "",
            "default"     => "10",
            "render"      => false,
        )
        );
        $this->add_field(
            "gallery",
            "General",
            "Columns",
            "columns",
            "number",
            array(
            "description" => "",
            "default"     => "4",
            "render"      => false,
        )
        );
        $this->add_field(
            "gallery",
            "General",
            "Mobile layout",
            "mobile_layout",
            "mobile_layout",
            array(
            "description"  => "",
            "premium_only" => true,
            "min_plan"     => "ultimate",
        )
        );
        $this->add_field(
            "gallery",
            "General",
            "Disable under browser width",
            "disable_below",
            "number",
            array(
            "mu"      => "px",
            "default" => 320,
        )
        );
        $this->add_field(
            "gallery",
            "Blocks",
            "Background color",
            "block_background_color",
            "color",
            array(
            "description" => "",
            "default"     => "transparent",
        )
        );
        $this->add_field(
            "gallery",
            "Blocks",
            "Blur",
            "hover_blur",
            "toggle",
            array(
            "description" => "Blur images on mouse hover",
            "default"     => "1",
        )
        );
        $this->add_field(
            "gallery",
            "Blocks",
            "Lift effect",
            "hover_lift",
            "toggle",
            array(
            "description" => "Lift up images on mouse hover",
            "default"     => "1",
        )
        );
        $this->add_field(
            "gallery",
            "Blocks",
            "Border size",
            "border_size",
            "number",
            array(
            "description" => "",
            "default"     => "0",
        )
        );
        $this->add_field(
            "gallery",
            "Blocks",
            "Border color",
            "border_color",
            "color",
            array(
            "description" => "",
            "default"     => "#333333",
        )
        );
        $this->add_field(
            "gallery",
            "Images",
            "Vertical alignment",
            "image_alignment_v",
            "select",
            array(
            "values"  => array(
            "top"    => "Top",
            "center" => "Middle",
            "bottom" => "Bottom",
        ),
            "default" => "center",
        )
        );
        $this->add_field(
            "gallery",
            "Images",
            "Horizontal alignment",
            "image_alignment_h",
            "select",
            array(
            "values"  => array(
            "left"   => "Left",
            "center" => "Center",
            "right"  => "Right",
        ),
            "default" => "center",
        )
        );
        $this->add_field(
            "gallery",
            "Images",
            "Round corners",
            "border_radius",
            "number",
            array(
            "description" => "Radius of the corners in pixels",
            "default"     => 0,
        )
        );
        $this->add_field(
            "gallery",
            "Advanced",
            "Resize images",
            "resize_images",
            "select",
            array(
            "description" => "PhotoBlocks can resize images on-the-fly in order to keep their size lower. Resized images are then cached. However, some hosting providers have strict security rules and this feature could not work as expected.<br><strong>Uncheck this option if you cannot see the images.</strong>",
            "values"      => array(
            "0" => "Do not resize images",
            "1" => "Resize images",
        ),
            "default"     => "0",
        )
        );
        $this->add_field(
            "gallery",
            "Advanced",
            "Image size",
            "image_size",
            "select",
            array(
            "description" => "Image size. <strong>Remember to regenerate thumbnails if needed.</strong>",
            "values"      => array(),
            "default"     => "large",
        )
        );
        foreach ( PhotoBlocks_Utils::list_thumbnail_sizes() as $s => $item ) {
            $this->fields["gallery"]["Advanced"]["fields"]["image_size"]["values"][$s] = $s . " (" . $item[0] . "x" . $item[1] . ")";
        }
        $this->add_field(
            "gallery",
            "Advanced",
            "Image quality",
            "image_quality",
            "number",
            array(
            "description" => "<strong>Only if resize is active</strong>: enter a value from 1 (worst quality) to 100 (best quality)",
            "default"     => "80",
        )
        );
        $this->add_field(
            "gallery",
            "Advanced",
            "Image scale factor",
            "image_factor",
            "number",
            array(
            "description" => "<strong>Only if resize is active</strong>: enter a float value equal or greater than 1. Example: 2 means that the images will be served at double size so that they'll be more crisp (but also larger in size).",
            "default"     => 1.5,
        )
        );
        $this->add_field(
            "gallery",
            "Advanced",
            "Lazy loading",
            "lazy",
            "toggle",
            array(
            "default"      => "0",
            "premium_only" => true,
            "min_plan"     => "ultimate",
        )
        );
        $this->add_field(
            "gallery",
            "Advanced",
            "Compress HTML",
            "compress_html",
            "toggle",
            array(
            "default" => "1",
        )
        );
        $this->add_field(
            "gallery",
            "Advanced",
            "Additional image CSS class",
            "image_class",
            "text",
            array(
            "default" => "",
        )
        );
        $this->add_field(
            "gallery",
            "Advanced",
            "Additional link CSS class",
            "link_class",
            "text",
            array(
            "default" => "",
        )
        );
        $this->add_field(
            "gallery",
            "Advanced",
            "Use image relative paths",
            "relative_path",
            "toggle",
            array(
            "default"     => "",
            "description" => "If images are not being loaded, try activating this setting",
        )
        );
        $this->add_field(
            "gallery",
            "Advanced",
            "Replace host name",
            "host_name",
            "text",
            array(
            "default"      => "",
            "description"  => "Enter the url of your CDN (e.g. cdn.yourdomain.com)",
            "premium_only" => true,
            "min_plan"     => "ultimate",
        )
        );
        /*
         * Gallery / Social
         */
        $this->add_field(
            "gallery",
            "Social",
            "",
            "social_help",
            "help_social",
            array()
        );
        $this->add_field(
            "gallery",
            "Social",
            "Facebook sharing",
            "sharing_facebook",
            "toggle",
            array(
            "default" => "0",
        )
        );
        $this->add_field(
            "gallery",
            "Social",
            "Pinterest sharing",
            "sharing_pinterest",
            "toggle",
            array(
            "default" => "0",
        )
        );
        $this->add_field(
            "gallery",
            "Social",
            "Twitter sharing",
            "sharing_twitter",
            "toggle",
            array(
            "default" => "0",
        )
        );
        $this->add_field(
            "gallery",
            "Social",
            "Houzz sharing",
            "sharing_houzz",
            "toggle",
            array(
            "default" => "0",
        )
        );
        $this->add_field(
            "gallery",
            "Social",
            "Google+ sharing",
            "sharing_google",
            "toggle",
            array(
            "default" => "0",
        )
        );
        $this->add_field(
            "gallery",
            "Social",
            "Vertical alignment",
            "social_position_v",
            "select",
            array(
            "values"  => array(
            "top"    => "Top",
            "middle" => "Middle",
            "bottom" => "Bottom",
        ),
            "default" => "bottom",
        )
        );
        $this->add_field(
            "gallery",
            "Social",
            "Horizontal alignment",
            "social_position_h",
            "select",
            array(
            "values"  => array(
            "left"   => "Left",
            "center" => "Center",
            "right"  => "Right",
        ),
            "default" => "center",
        )
        );
        $this->add_field(
            "gallery",
            "Social",
            "Icon size",
            "social_icon_size",
            "number",
            array(
            "default" => "14",
        )
        );
        /*
         * Lightbox / Aspect
         */
        $lightbox = $this->add_field(
            "lightbox",
            "General",
            "Lightbox",
            "lightbox",
            "select",
            array(
            "values"          => array(
            "magnific"      => "Enable Magnific Popup lightbox",
            "fancybox"      => "Enable FancyBox lightbox",
            "link_to_image" => "Link images (use this for external lightboxes)",
            "none"          => "Don't use a lightbox and don't link the images",
        ),
            "premium"         => array(
            "fancybox" => "basic",
        ),
            "default"         => "magnific",
            "default_premium" => "fancybox",
            "description"     => "Choose whether to show a larger version of the images when users click on them",
        )
        );
        $lightbox = $this->add_field(
            "lightbox",
            "General",
            "Lightbox caption field",
            "lightbox_caption_field",
            "select",
            array(
            "values"      => array(
            "none"              => "None",
            "title"             => "Title",
            "description"       => "Description",
            "title_description" => "Title + Description",
        ),
            "default"     => "description",
            "description" => "Text field to use for the lightbox caption",
        )
        );
        $this->add_field(
            "lightbox",
            "General",
            "Mobile Lightbox",
            "lightbox_mobile",
            "select",
            array(
            "values"          => array(
            "magnific"      => "Enable Magnific Popup lightbox",
            "fancybox"      => "Enable FancyBox lightbox",
            "link_to_image" => "Link images (use this for external lightboxes)",
            "none"          => "Don't use a lightbox and don't link the images",
        ),
            "premium"         => array(
            "fancybox" => "basic",
        ),
            "default"         => "magnific",
            "default_premium" => "fancybox",
            "description"     => "Same as above but for mobile devices",
        )
        );
        $this->add_field(
            "lightbox",
            "Aspect",
            "Background color",
            "lightbox_bg_color",
            "color",
            array(
            "default" => "rgba(0, 0, 0, 0.75)",
        )
        );
        $this->add_field(
            "lightbox",
            "Aspect",
            "Animation effect",
            "fancybox_animation",
            "select",
            array(
            "values"  => array(
            "false"       => "None",
            "zoom"        => "Zoom",
            "fade"        => "Fade",
            "zoom-in-out" => "Zoom in and out",
        ),
            "default" => "zoom",
            "show_if" => "lightbox || lightbox_mobile == fancybox",
        )
        );
        $this->add_field(
            "lightbox",
            "Aspect",
            "Transition effect",
            "fancybox_transition",
            "select",
            array(
            "values"  => array(
            "false"       => "None",
            "fade"        => "Fade",
            "slide"       => "Slide",
            "circular"    => "Circular",
            "tube"        => "Tube",
            "zoom-in-out" => "Zoom in and out",
            "rotate"      => "Rotate",
        ),
            "default" => "slide",
            "show_if" => "lightbox || lightbox_mobile == fancybox",
        )
        );
        $this->add_field(
            "lightbox",
            "Aspect",
            "Image size",
            "lightbox_image_size",
            "select",
            array(
            "values"  => array(
            "" => "Custom",
        ),
            "default" => '',
        )
        );
        foreach ( PhotoBlocks_Utils::list_thumbnail_sizes() as $s => $item ) {
            $this->fields["lightbox"]["Aspect"]["fields"]["lightbox_image_size"]["values"][$s] = $s . " (" . $item[0] . "x" . $item[1] . ")";
        }
        $this->fields["lightbox"]["Aspect"]["fields"]["lightbox_image_size"]["values"]['full'] = 'Full (original)';
        $this->add_field(
            "lightbox",
            "Aspect",
            "Custom image size",
            "lightbox_max_size",
            "number",
            array(
            "default" => 1600,
        )
        );
        /**
         * Captions
         */
        $this->add_field(
            "captions",
            "Hover",
            "Hover effect",
            "caption_effect",
            "hover_effect",
            array(
            "values"          => array(
            "hidden"   => array(
            "name" => "Hidden",
        ),
            "fade"     => array(
            "name" => "Fade",
        ),
            "sticky"   => array(
            "name"        => "Sticky",
            "title"       => "left|bottom",
            "description" => "left|bottom",
            "social"      => "center|middle",
        ),
            "label"    => array(
            "name"        => "Label",
            "title"       => "left|bottom",
            "description" => "center|middle",
            "social"      => "center|middle",
        ),
            "moresco"  => array(
            "name"        => "Moresco",
            "title"       => "center|middle",
            "description" => "center|bottom",
            "social"      => "center|bottom",
        ),
            "quadro"   => array(
            "name"        => "Quadro",
            "title"       => "center|middle",
            "description" => "center|middle",
            "social"      => "center|bottom",
        ),
            "focus"    => array(
            "name"        => "Focus",
            "title"       => "center|middle",
            "description" => "center|middle",
            "social"      => "center|bottom",
        ),
            "liney"    => array(
            "name"        => "Liney",
            "title"       => "right|top",
            "description" => "right|bottom",
            "social"      => "center|bottom",
        ),
            "dream"    => array(
            "name"        => "Dream",
            "title"       => "center|middle",
            "description" => "center|middle",
            "social"      => "center|bottom",
        ),
            "cinema"   => array(
            "name"        => "Cinema",
            "title"       => "center|middle",
            "description" => "center|middle",
            "social"      => "center|bottom",
        ),
            "stanley"  => array(
            "name"        => "Stanley",
            "title"       => "center|middle",
            "description" => "center|middle",
            "social"      => "center|bottom",
        ),
            "frack"    => array(
            "name"        => "Frack",
            "title"       => "center|middle",
            "description" => "center|middle",
            "social"      => "center|bottom",
        ),
            "break"    => array(
            "name"        => "Break",
            "title"       => "left|top",
            "description" => "left|top",
            "social"      => "center|bottom",
        ),
            "space"    => array(
            "name"        => "Space",
            "title"       => "center|middle",
            "description" => "center|bottom",
            "social"      => "center|bottom",
        ),
            "new-york" => array(
            "name"        => "New York",
            "title"       => "center|top",
            "description" => "center|top",
            "social"      => "center|bottom",
        ),
            "africa"   => array(
            "name"        => "Africa",
            "title"       => "center|top",
            "description" => "center|top",
            "social"      => "center|bottom",
        ),
            "window"   => array(
            "name"        => "Window",
            "title"       => "center|middle",
            "description" => "center|middle",
            "social"      => "center|bottom",
        ),
            "mirto"    => array(
            "name"        => "Mirto",
            "title"       => "center|top",
            "description" => "center|bottom",
            "social"      => "center|bottom",
        ),
        ),
            "premium"         => array(
            "moresco"  => "ultimate",
            "quadro"   => "ultimate",
            "label"    => "ultimate",
            "focus"    => "ultimate",
            "liney"    => "ultimate",
            "dream"    => "ultimate",
            "cinema"   => "ultimate",
            "stanley"  => "ultimate",
            "frack"    => "ultimate",
            "break"    => "ultimate",
            "space"    => "ultimate",
            "new-york" => "ultimate",
            "africa"   => "ultimate",
            "window"   => "ultimate",
            "mirto"    => "ultimate",
        ),
            "default"         => "fade",
            "default_premium" => "moresco",
        )
        );
        $this->add_field(
            "captions",
            "General",
            "Google Fonts API key",
            "google_font_key",
            "text",
            array(
            "default"      => "",
            "description"  => "If you want to use Google Fonts enter you API key here. If you don't have one, create it <a href='https://support.google.com/cloud/answer/6158862' target='_blank'>here</a><br>After you paste the API key, save the gallery and reload the page to let changes take effect.",
            "premium_only" => true,
            "min_plan"     => "ultimate",
        )
        );
        $this->add_field(
            "captions",
            "Title",
            "Vertical alignment",
            "caption_title_position_v",
            "select",
            array(
            "values"  => array(
            "top"    => "Top",
            "middle" => "Middle",
            "bottom" => "Bottom",
        ),
            "default" => "middle",
        )
        );
        $this->add_field(
            "captions",
            "Title",
            "Horizontal alignment",
            "caption_title_position_h",
            "select",
            array(
            "values"  => array(
            "left"   => "Left",
            "center" => "Center",
            "right"  => "Right",
        ),
            "default" => "center",
        )
        );
        $this->add_field(
            "captions",
            "Title",
            "Color",
            "caption_title_color",
            "color",
            array(
            "default" => "#fff",
        )
        );
        $this->add_field(
            "captions",
            "Title",
            "Size",
            "caption_title_size",
            "number",
            array(
            "default" => 20,
        )
        );
        $this->add_field(
            "captions",
            "Title",
            "Font",
            "caption_title_font",
            "select",
            array(
            "values"       => array(
            "" => "Theme default",
        ),
            "description"  => "Insert your Google Fonts API key to enable Google Fonts",
            "css_classes"  => "js-load-fonts js-chosen",
            "default"      => "",
            "premium_only" => true,
            "min_plan"     => "ultimate",
        )
        );
        $this->add_field(
            "captions",
            "Description",
            "Vertical alignment",
            "caption_description_position_v",
            "select",
            array(
            "values"  => array(
            "top"    => "Top",
            "middle" => "Middle",
            "bottom" => "Bottom",
        ),
            "default" => "middle",
        )
        );
        $this->add_field(
            "captions",
            "Description",
            "Horizontal alignment",
            "caption_description_position_h",
            "select",
            array(
            "values"  => array(
            "left"   => "Left",
            "center" => "Center",
            "right"  => "Right",
        ),
            "default" => "center",
        )
        );
        $this->add_field(
            "captions",
            "Description",
            "Color",
            "caption_description_color",
            "color",
            array(
            "default" => "rgba(255, 255, 255, .7)",
        )
        );
        $this->add_field(
            "captions",
            "Description",
            "Size",
            "caption_description_size",
            "number",
            array(
            "default" => 14,
        )
        );
        $this->add_field(
            "captions",
            "Description",
            "Font",
            "caption_description_font",
            "select",
            array(
            "values"       => array(
            "" => "Theme default",
        ),
            "description"  => "Insert your Google Fonts API key to enable Google Fonts",
            "css_classes"  => "js-load-fonts",
            "default"      => "",
            "premium_only" => true,
            "min_plan"     => "ultimate",
        )
        );
        $this->add_field(
            "captions",
            "Background",
            "Color",
            "caption_background_color",
            "color",
            array(
            "default" => "rgba(0, 0, 0, .75)",
        )
        );
        $this->add_field(
            "captions",
            "Background",
            "Always show overlay",
            "caption_background_show_empty",
            "toggle",
            array(
            "description" => "Show overlays even without captions",
            "default"     => "0",
        )
        );
        $this->add_field(
            "customisations",
            "General",
            "Custom CSS",
            "custom_css",
            "textarea",
            array(
            "description" => "Write here your the custom CSS for this gallery. Write CSS code without <style></style> tags.",
            "default"     => "",
        )
        );
        $this->add_field(
            "customisations",
            "General",
            "",
            "custom_css_help",
            "help_custom_css",
            array()
        );
        $this->add_field(
            "customisations",
            "General",
            "Event: before gallery",
            "custom_event_before",
            "textarea",
            array(
            "description" => "JavaScript code to run before the plugin starts building the gallery. Write CSS code without <script></script> tags.",
            "default"     => "",
        )
        );
        $this->add_field(
            "customisations",
            "General",
            "Event: refreshed gallery",
            "custom_event_refresh",
            "textarea",
            array(
            "description" => "JavaScript code to run after the plugin refreshed the gallery. Write CSS code without <script></script> tags.",
            "default"     => "",
        )
        );
        $this->add_field(
            "customisations",
            "General",
            "Event: after gallery",
            "custom_event_after",
            "textarea",
            array(
            "description" => "JavaScript code to run after the plugin complete building the gallery. Write CSS code without <script></script> tags.",
            "default"     => "",
        )
        );
        /*$this->add_field("customisations", "General", "Filter for blocks", "custom_blocks_filter", "textarea", array(
        			"description" => "",
        			"default" => "",
        			"premium" => array()
        		));
        		$this->add_field("customisations", "General", "Filter for settings", "custom_blocks_filter", "textarea", array(
        			"description" => "",
                    "default" => "",
        			"premium" => array()
        		));*/
        $show_filters_claim = false;
        $show_filters_claim = true;
        if ( $show_filters_claim ) {
            $this->add_field(
                "filters",
                "Filters",
                "",
                "",
                "filters_claim",
                array()
            );
        }
    }

}