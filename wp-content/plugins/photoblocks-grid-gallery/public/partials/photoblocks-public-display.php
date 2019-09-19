<!-- PhotoBlocks for WordPress v<?php 
echo  PHOTOBLOCKS_V . " " . PHOTOBLOCKS_PLAN ;
?> -->
<style>
    #photoblocks-<?php 
echo  $data['id'] ;
?> {<?php 
echo  $this->css( $data['id'], 'width', 'width' ) ;
?>}
    #photoblocks-<?php 
echo  $data['id'] ;
?> .pb-block {<?php 
echo  $this->css(
    $data['id'],
    'border-width',
    'border_size',
    'px'
) ;
echo  $this->css( $data['id'], 'border-color', 'border_color' ) ;
?>}
    #photoblocks-<?php 
echo  $data['id'] ;
?> .pb-title {<?php 
echo  $this->css( $data['id'], 'color', 'caption_title_color' ) ;
echo  $this->css(
    $data['id'],
    'font-size',
    'caption_title_size',
    'px'
) ;
echo  $this->css( $data['id'], 'font-family', 'caption_title_font' ) ;
?>}
    #photoblocks-<?php 
echo  $data['id'] ;
?> .pb-description {<?php 
echo  $this->css( $data['id'], 'color', 'caption_description_color' ) ;
echo  $this->css(
    $data['id'],
    'font-size',
    'caption_description_size',
    'px'
) ;
echo  $this->css( $data['id'], 'font-family', 'caption_description_font' ) ;
?>}
    #photoblocks-<?php 
echo  $data['id'] ;
?> .pb-block.pb-type-text .pb-overlay {<?php 
echo  $this->css( $data['id'], 'background-color', 'block_text_background_color' ) ;
?>}
    #photoblocks-<?php 
echo  $data['id'] ;
?> .pb-block.pb-type-text .pb-title,
    #photoblocks-<?php 
echo  $data['id'] ;
?> .pb-block.pb-type-text .pb-description {<?php 
echo  $this->css( $data['id'], 'color', 'block_text_color' ) ;
?>} 
    #photoblocks-<?php 
echo  $data['id'] ;
?> .pb-block.pb-type-text .pb-title {<?php 
echo  $this->css(
    $data['id'],
    'font-size',
    'block_text_title_size',
    'px'
) ;
?>}
    #photoblocks-<?php 
echo  $data['id'] ;
?> .pb-block.pb-type-text .pb-description {<?php 
echo  $this->css(
    $data['id'],
    'font-size',
    'block_text_description_size',
    'px'
) ;
?>}
    <?php 

if ( $gallery["caption_effect"] == "sticky" ) {
    ?>
    #photoblocks-<?php 
    echo  $data['id'] ;
    ?> .pb-overlay { background: transparent; }
    #photoblocks-<?php 
    echo  $data['id'] ;
    ?>.pb-effect-sticky .pb-block.pb-type-image .pb-overlay .pb-caption-bottom {<?php 
    echo  $this->css( $data['id'], 'background', 'caption_background_color' ) ;
    ?>}
    <?php 
} else {
    ?>
    #photoblocks-<?php 
    echo  $data['id'] ;
    ?> .pb-overlay {<?php 
    echo  $this->css( $data['id'], 'background', 'caption_background_color' ) ;
    ?>}    
    <?php 
}

?>    
    #photoblocks-<?php 
echo  $data['id'] ;
?>.pb-lift.show-empty-overlay .pb-block.pb-type-image:hover,
    #photoblocks-<?php 
echo  $data['id'] ;
?>.pb-lift .pb-block.pb-type-image.with-text:hover {
        box-shadow: <?php 
echo  $this->settings->get( $this->values[$data['id']], "caption_background_color" ) ;
?> 0 0 20px;
    }    
    #photoblocks-<?php 
echo  $data['id'] ;
?> .pb-block {
        <?php 
echo  $this->css(
    $data['id'],
    'border-radius',
    'border_radius',
    'px'
) ;
?>
        <?php 
echo  $this->css( $data['id'], 'background-color', 'block_background_color' ) ;
?>
    }
    #photoblocks-<?php 
echo  $data['id'] ;
?> .pb-block .pb-social button {<?php 
echo  $this->css( $data['id'], 'color', 'caption_title_color' ) ;
echo  $this->css(
    $data['id'],
    'font-size',
    'social_icon_size',
    'px'
) ;
?>}
    <?php 
?>
    <?php 
echo  $this->settings->get( $this->values[$data['id']], "custom_css" ) ;
?>    
</style>
<div class="photoblocks-gallery <?php 
echo  $this->hover_options_classes( $data['id'] ) ;
?> <?php 
echo  $this->css_classes( $data['id'] ) ;
?> pb-effect-<?php 
echo  $this->caption_effect( $data['id'] ) ;
?>" data-anim="<?php 
echo  $this->loading_effect( $data['id'] ) ;
?>" id="photoblocks-<?php 
echo  $data['id'] ;
?>">
    <?php 
?>
    <div class="pb-blocks">
        <?php 
foreach ( $blocks as $block ) {
    ?>
            <?php 
    if ( $block->type == "empty" ) {
        continue;
    }
    ?>
        <div class="pb-block
            <?php 
    echo  ( $block->has_captions() ? "with-text" : "" ) ;
    ?>
            <?php 
    echo  ( $block->has_any_social() ? "with-social" : "" ) ;
    ?>
            <?php 
    echo  ( $block->has_captions_or_social() ? "with-social-or-text" : "" ) ;
    ?>  
            <?php 
    
    if ( $block->type == "image" || $block->type == "post" ) {
        ?>
                <?php 
        echo  ( $block->ratio() > 1 ? "pb-landscape" : "pb-portrait" ) ;
        ?> pb-<?php 
        echo  $block->winning_size() ;
        ?>
            <?php 
    }
    
    ?>
            pb-type-<?php 
    echo  $block->type ;
    ?>
            <?php 
    echo  ( $block->type == "post" ? "pb-type-image" : "" ) ;
    ?>
            "
            style="<?php 
    echo  $block->style() ;
    ?>"
            <?php 
    ?> 
                data-colspan="<?php 
    echo  $block->colspan() ;
    ?>" 
                data-rowspan="<?php 
    echo  $block->rowspan() ;
    ?>" 
                data-col="<?php 
    echo  $block->col() ;
    ?>" 
                data-row="<?php 
    echo  $block->row() ;
    ?>" 
                <?php 
    
    if ( $block->type == "image" || $block->type == "post" ) {
        ?>
                data-valign="<?php 
        echo  $block->valign() ;
        ?>" 
                data-halign="<?php 
        echo  $block->halign() ;
        ?>" 
                <?php 
    }
    
    ?>
                data-type="<?php 
    echo  $block->type ;
    ?>"
                data-ratio="<?php 
    echo  $block->ratio() ;
    ?>">
            
            <?php 
    
    if ( $block->type == "image" || $block->type == "post" ) {
        ?>
                <img 
                    class="pb-image skip-lazy <?php 
        echo  $block->get_image_class() ;
        ?>" 
                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==" 
                    data-pb-source="<?php 
        echo  $block->get_image_url() ;
        ?>" 
                    alt="<?php 
        echo  $block->get_alt() ;
        ?>">
                <noscript><img src="<?php 
        echo  $block->image->url ;
        ?>" alt="<?php 
        echo  $block->get_alt() ;
        ?>"></noscript>
            <?php 
    }
    
    ?>
            <?php 
    
    if ( $block->has_link_or_lightbox() ) {
        ?>
                <a class="pb-link <?php 
        echo  $block->mfp_iframe_class() ;
        ?> 
                <?php 
        echo  $block->get_link_class() ;
        ?>" 
                <?php 
        echo  $block->get_lightbox_attrs() ;
        ?> 
                data-caption="<?php 
        echo  $block->get_lightbox_caption() ;
        ?>" 
                rel="<?php 
        echo  $block->click->rel ;
        ?>" 
                <?php 
        
        if ( $block->has_link_or_lightbox() ) {
            ?>
                    target="<?php 
            echo  $block->click->target ;
            ?>"
                <?php 
        }
        
        ?> 
                    href="<?php 
        echo  $block->get_link() ;
        ?>">
            <?php 
    }
    
    ?>
                <?php 
    
    if ( $block->has_captions() || $block->show_empty_overlay() ) {
        ?>
                <div class="pb-overlay" style="<?php 
        
        if ( $block->has_custom_overlay() ) {
            ?>background-color: <?php 
            echo  $block->get_overlay_bg() ;
        }
        
        ?>">
                    <?php 
        foreach ( array( 'top', 'middle', 'bottom' ) as $position ) {
            ?>
                        <?php 
            
            if ( $block->has_captions_or_social( $position ) ) {
                ?>
                        <div class="pb-caption-<?php 
                echo  $position ;
                ?>">
                            <?php 
                
                if ( $block->has_title( $position ) ) {
                    ?>
                            <span class="pb-title pb-caption-<?php 
                    echo  $block->caption_position( 'title', 'h' ) ;
                    ?>" style="<?php 
                    echo  $block->custom_styles( 'title' ) ;
                    ?>"><?php 
                    echo  do_shortcode( $block->caption->title->text ) ;
                    ?></span>
                            <?php 
                }
                
                ?>
                            <?php 
                
                if ( $block->has_description( $position ) ) {
                    ?>
                            <span class="pb-description pb-caption-<?php 
                    echo  $block->caption_position( 'description', 'h' ) ;
                    ?>" style="<?php 
                    echo  $block->custom_styles( 'description' ) ;
                    ?>"><?php 
                    echo  do_shortcode( $block->caption->description->text ) ;
                    ?></span>
                            <?php 
                }
                
                ?>
                            <?php 
                
                if ( ($block->type == "image" || $block->type == "post") && $block->has_any_social_here( $position ) ) {
                    ?>
                            <span class="pb-social pb-social-<?php 
                    echo  $gallery['social_position_h'] ;
                    ?>">
                                <?php 
                    foreach ( $block->list_social() as $item ) {
                        ?>
                                <button data-social="<?php 
                        echo  $item ;
                        ?>"><i class="pb-icon-<?php 
                        echo  $item ;
                        ?>"></i></button>
                                <?php 
                    }
                    ?>
                            </span>
                            <?php 
                }
                
                ?>
                        </div>
                        <?php 
            }
            
            ?>
                    <?php 
        }
        ?>
                </div>
            <?php 
    }
    
    ?>
            <?php 
    if ( $block->has_link_or_lightbox() ) {
        ?></a><?php 
    }
    ?>            
        </div>
        <?php 
}
?>
    </div>
</div>
<div id="photoblocks-fancybox-<?php 
echo  $data['id'] ;
?>"></div>
<script>
<?php 

if ( $this->fonts_to_load( $data['id'] ) ) {
    ?>
  (function () {
    var head = document.head;
    var link = document.createElement("link");

    link.type = "text/css";
    link.rel = "stylesheet";
    link.href = "<?php 
    echo  $this->fonts_to_load( $data['id'] ) ;
    ?>";

    head.appendChild(link);
  })();
<?php 
}

?>
jQuery(function () {
	var p = new PhotoBlocks({
        selector: "#photoblocks-<?php 
echo  $data['id'] ;
?>",
        columns: <?php 
echo  $gallery['columns'] ;
?>,
        padding: <?php 
echo  $gallery['padding'] ;
?>,
        resizer: "<?php 
echo  $this->resizer_url( $data['id'] ) ;
?>",
        image_quality: <?php 
echo  $this->settings->get( $this->values[$data['id']], "image_quality" ) ;
?>,
        disable_below: <?php 
echo  $gallery['disable_below'] ;
?>,
        imageFactor: <?php 
echo  $this->settings->get( $this->values[$data['id']], "image_factor" ) ;
?>,
        on: {
            before: function () { <?php 
echo  $gallery['custom_event_before'] ;
?> },
            after: function () { <?php 
echo  $gallery['custom_event_after'] ;
?> },
            refresh: function () { <?php 
echo  $gallery['custom_event_refresh'] ;
?> }
        },
        <?php 
$mobile = $this->settings->get( $this->values[$data['id']], "mobile_layout" );
?>
        mobile_layout: <?php 
echo  ( empty($mobile) ? "[]" : $mobile ) ;
?>,
        lazy: <?php 
echo  ( $this->settings->get( $this->values[$data['id']], "lazy" ) == "1" ? "true" : "false" ) ;
?>,
		debug: <?php 
echo  ( isset( $_GET["debug"] ) && $_GET["debug"] == "1" ? "true" : "false" ) ;
?>
    });
    <?php 

if ( $this->lightbox( $data['id'] ) == 'fancybox' ) {
    ?>
    jQuery("#photoblocks-<?php 
    echo  $data['id'] ;
    ?> [data-fancybox]").fancybox({
        <?php 
    if ( $gallery['fancybox_thumbnails'] == "1" ) {
        ?>
        thumbs : {
            autoStart : true,
            hideOnClose : false
        },
        <?php 
    }
    ?>
        loop: <?php 
    echo  $this->show_toggle( $data['id'], 'fancybox_loop' ) ;
    ?>,
        keyboard: <?php 
    echo  $this->show_toggle( $data['id'], 'fancybox_keyboard' ) ;
    ?>,
        arrows: <?php 
    echo  $this->show_toggle( $data['id'], 'fancybox_arrows' ) ;
    ?>,
        gutter : 50,
        infobar : <?php 
    echo  $this->show_toggle( $data['id'], 'fancybox_infobar' ) ;
    ?>,
        toolbar : <?php 
    echo  $this->show_toggle( $data['id'], 'fancybox_toolbar' ) ;
    ?>,
        buttons : [ <?php 
    echo  $this->fancybox_buttons( $data['id'] ) ;
    ?>],        
        transitionEffect: "<?php 
    echo  $gallery['fancybox_transition'] ;
    ?>",
        animationEffect : "<?php 
    echo  $gallery['fancybox_animation'] ;
    ?>",        
        baseClass: "photoblocks-fancybox-<?php 
    echo  $data['id'] ;
    ?>",
        protect: <?php 
    echo  $this->show_toggle( $data['id'], 'fancybox_protect' ) ;
    ?>,        
    });
    <?php 
}

?>
    <?php 

if ( $this->lightbox( $data['id'] ) == 'magnific' ) {
    ?>
    jQuery("#photoblocks-<?php 
    echo  $data['id'] ;
    ?>").magnificPopup({
        delegate: ".pb-block:not(.pb-filtered) [data-magnific]",
        type: "image",
        gallery: {
            enabled: true,
            preload: [0,2]
        },
        image: {
            titleSrc: 'data-caption'
        },
        mainClass: "mfp-<?php 
    echo  $data['id'] ;
    ?>"
    });
    <?php 
}

?>
});
</script>