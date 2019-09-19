<label class="pb-settings-label">
    <span class="control"><?php _e($field["name"], 'photoblocks') ?>
        <ul class="js-dynamic-list pb-dynamic-list" data-field="<?php echo $field["code"] ?>" id="dynamic-list-<?php echo $field["code"] ?>">
        </ul>
        <a class="pb-button" onclick="PBAdmin.addFilter(this)" data-field="<?php echo $field["code"] ?>"><?php _e("Add filter", 'photobocks') ?></a>
        <input type="hidden" value="" name="<?php echo $field["code"] ?>" class="js-serialize js-serialize-list"></span>
</label>
<div class="pb-settings-description"><p><?php _e($field["description"], 'photobocks') ?></p></div>