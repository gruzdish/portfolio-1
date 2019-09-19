<div class="pb-settings-label">
    <span class="control"><?php _e($field["name"], 'photoblocks') ?>
    <select name="<?php echo $field["code"] ?>" class="js-serialize js-update-additional-data">
    <?php foreach($field["values"] as $k => $v) : ?>
        <option value="<?php echo $k ?>"><?php _e($v["name"], 'photoblocks') ?></option>
    <?php endforeach ?>
    </select>

    <div class="additional-data additional-data-<?php echo $field["code"] ?>">
    <?php foreach($field["values"] as $k => $v) : ?>
        <?php if(array_key_exists("title", $v)) : ?>
        <div class="additional-data-item-<?php echo $k ?>">
            <?php $title = explode("|", $v["title"]) ?>
            <?php $description = explode("|", $v["description"]) ?>
            <?php $social = explode("|", $v["social"]) ?>
            <h4><?php _e("Suggested captions alignment", 'photoblocks') ?>:</h4>
            <p><strong><?php _e("Titles", 'photoblocks') ?></strong>: <?php _e($title[0], 'photoblocks') ?> / <?php _e($title[1], 'photoblocks') ?></p>
            <p><strong><?php _e("Descriptions", 'photoblocks') ?></strong>: <?php _e($description[0], 'photoblocks') ?> / <?php _e($description[1], 'photoblocks') ?></p>
            <p><strong><?php _e("Social icons", 'photoblocks') ?></strong>: <?php _e($social[0], 'photoblocks') ?> / <?php _e($social[1], 'photoblocks') ?></p>
            <a class="pb-button pb-small-button pb-button-green" onclick="PBAdmin.applyAlignments({ title: ['<?php _e($title[0], 'photoblocks') ?>', '<?php _e($title[1], 'photoblocks') ?>'], description: ['<?php _e($description[0], 'photoblocks') ?>', '<?php _e($description[1], 'photoblocks') ?>'], social: ['<?php _e($social[0], 'photoblocks') ?>', '<?php _e($social[1], 'photoblocks') ?>'] })"><?php _e("Apply alignments", 'photoblocks') ?></a>            
        </div>
        <?php endif ?>
    <?php endforeach ?>
    </div>
</div>
<div class="pb-settings-description"><p><?php _e($field["description"], 'photobocks') ?></p></div>