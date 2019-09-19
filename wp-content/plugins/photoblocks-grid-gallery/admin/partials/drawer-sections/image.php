<fieldset id="pb-image-settings">
    <h3><?php _e('Image settings', 'photoblocks') ?></h3>
    <div class="field">
        <label></label>
        <div class="current-block-pic">
        </div>
        <div class="field align-field align-v">
            <label><?php _e('Vertical alignment', 'photoblocks') ?></label>
            <select class="image-align" data-axis="v">
                <option value=""><?php _e('Gallery default', 'photoblocks') ?></option>
                <option value="top"><?php _e('Top', 'photoblocks') ?></option>
                <option value="center"><?php _e('Center', 'photoblocks') ?></option>
                <option value="bottom"><?php _e('Bottom', 'photoblocks') ?></option>
            </select>
        </div>
        <div class="field align-field align-h">
            <label><?php _e('Horizontal alignment', 'photoblocks') ?></label>
            <select class="image-align" data-axis="h">
                <option value=""><?php _e('Gallery default', 'photoblocks') ?></option>
                <option value="left"><?php _e('Left', 'photoblocks') ?></option>
                <option value="center"><?php _e('Center', 'photoblocks') ?></option>
                <option value="right"><?php _e('Right', 'photoblocks') ?></option>
            </select>
        </div>
        <div class="group">
            <h4><a class="toggle-group" data-group="overlay"><i class="close-arrow pb-right-open-mini"></i><i class="open-arrow pb-down-open-mini"></i> <?php _e('SEO', 'photoblocks') ?></a></h4>
            <div class="field inline">
                <label><?php _e('Alt', 'photoblocks') ?> <input type="text" class="pb-alt"></label>
            </div>
        </div>
        <div class="group">
            <h4><a class="toggle-group" data-group="overlay"><i class="close-arrow pb-right-open-mini"></i><i class="open-arrow pb-down-open-mini"></i> <?php _e('Overlay', 'photoblocks') ?></a></h4>

            <div class="field">
                <label><?php _e('Color', 'photoblocks') ?> <input type="text" data-control="wheel" class="js-colpick overlay-color"></label>
            </div>
            <!--<div class="field">
                            <label><?php _e('Opacity', 'photoblocks') ?> <input type="text" class="overlay-opacity"></label>
                    </div>-->
        </div>
        <div class="group">
            <h4><a class="toggle-group" data-group="title"><i class="close-arrow pb-right-open-mini"></i><i class="open-arrow pb-down-open-mini"></i> <?php _e('Title', 'photoblocks') ?></a></h4>
            <div class="field">
                <label><?php _e('Text', 'photoblocks') ?> <textarea class="caption-title"></textarea></label>
            </div>
            <div class="field">
                <label><?php _e('Size', 'photoblocks') ?> <input type="number" class="caption-title-size"></label>
            </div>
            <div class="field">
                <label><?php _e('Color', 'photoblocks') ?> <input type="text" data-control="wheel" class="js-colpick caption-title-color"></label>
            </div>
            <div class="field">
                <label><?php _e('Position', 'photoblocks') ?>
                    <select class="title-position">
                        <option value=""><?php _e('Gallery default', 'photoblocks') ?></option>
                        <optgroup label="Top">
                            <option value="top-left"><?php _e('Top, Left corner', 'photoblocks') ?></option>
                            <option value="top-center"><?php _e('Top, Centered', 'photoblocks') ?></option>
                            <option value="top-right"><?php _e('Top, Right corner', 'photoblocks') ?></option>
                        </optgroup>
                        <optgroup label="Middle">
                            <option value="middle-left"><?php _e('Middle, Left side', 'photoblocks') ?></option>
                            <option value="middle-center"><?php _e('Middle, Centered', 'photoblocks') ?></option>
                            <option value="middle-right"><?php _e('Middle, Right side', 'photoblocks') ?></option>
                        </optgroup>
                        <optgroup label="Bottom">
                            <option value="bottom-left"><?php _e('Bottom, Left corner', 'photoblocks') ?></option>
                            <option value="bottom-center"><?php _e('Bottom, Centered', 'photoblocks') ?></option>
                            <option value="bottom-right"><?php _e('Bottom, Right corner', 'photoblocks') ?></option>
                        </optgroup>
                    </select>
                </label>
            </div>
        </div>
        <div class="group">
            <h4><a class="toggle-group" data-group="description"><i class="close-arrow pb-right-open-mini"></i><i class="open-arrow pb-down-open-mini"></i> <?php _e('Description', 'photoblocks') ?></a></h4>
            <div class="field">
                <label><?php _e('Text', 'photoblocks') ?> <textarea class="caption-description"></textarea></label>
            </div>
            <div class="field">
                <label><?php _e('Size', 'photoblocks') ?> <input type="number" class="caption-description-size"></label>
            </div>
            <div class="field">
                <label><?php _e('Color', 'photoblocks') ?> <input type="text" data-control="wheel" class="js-colpick caption-description-color"></label>
            </div>
            <div class="field">
                <label><?php _e('Position', 'photoblocks') ?>
                    <select class="description-position">
                        <option value=""><?php _e('Gallery default', 'photoblocks') ?></option>
                        <optgroup label="Top">
                            <option value="top-left"><?php _e('Top, Left corner', 'photoblocks') ?></option>
                            <option value="top-center"><?php _e('Top, Centered', 'photoblocks') ?></option>
                            <option value="top-right"><?php _e('Top, Right corner', 'photoblocks') ?></option>
                        </optgroup>
                        <optgroup label="Middle">
                            <option value="middle-left"><?php _e('Middle, Left side', 'photoblocks') ?></option>
                            <option value="middle-center"><?php _e('Middle, Centered', 'photoblocks') ?></option>
                            <option value="middle-right"><?php _e('Middle, Right side', 'photoblocks') ?></option>
                        </optgroup>
                        <optgroup label="Bottom">
                            <option value="bottom-left"><?php _e('Bottom, Left corner', 'photoblocks') ?></option>
                            <option value="bottom-center"><?php _e('Bottom, Centered', 'photoblocks') ?></option>
                            <option value="bottom-right"><?php _e('Bottom, Right corner', 'photoblocks') ?></option>
                        </optgroup>
                    </select>
                </label>
            </div>
        </div>
        <div class="group">
            <h4><a class="toggle-group" data-group="on-click"><i class="close-arrow pb-right-open-mini"></i><i class="open-arrow pb-down-open-mini"></i> <?php _e('On click', 'photoblocks') ?></a></h4>

            <div class="field">
                <label><?php _e('Open link', 'photoblocks') ?> <input type="text" class="on-click-link"></label>
            </div>
            <div class="field">
                <label><?php _e('Target', 'photoblocks') ?></label>
                <select class="on-click-target">
                    <option value=""><?php _e('Gallery default', 'photoblocks') ?></option>
                    <option value="_self"><?php _e('Open in the same page', 'photoblocks') ?></option>
                    <option value="_blank"><?php _e('Open in a new page', 'photoblocks') ?></option>
                    <option value="_lightbox"><?php _e('Open in lightbox', 'photoblocks') ?></option>
                </select>
            </div>
            <div class="field">
                <label><?php _e('Rel', 'photoblocks') ?> <input type="text" class="on-click-rel"></label>
            </div>
        </div>
        <?php if(photob_fs()->is__premium_only() && photob_fs()->is_plan_or_trial("ultimate")) : ?>
        <div class="group">
            <h4><a class="toggle-group" data-group="on-click"><i class="close-arrow pb-right-open-mini"></i><i class="open-arrow pb-down-open-mini"></i> <?php _e('Filters', 'photoblocks') ?></a></h4>
            <div class="field">
                <ul class="js-linked-list-filters"></ul>
            </div>
        </div>
        <?php endif ?>
        <a href="#" onclick="PhotoBlocks.updateBlock()" title="<?php _e('Done', 'photoblocks') ?>" class="button close-drawer" tabindex="-1"><?php _e('Done', 'photoblocks') ?></a>
</fieldset>