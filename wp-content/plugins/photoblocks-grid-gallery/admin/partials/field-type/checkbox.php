<div class="pb-settings-label">
    <?php echo $field["name"] ?>
    <span class="control js-checkbox-list pb-checkbox-list" data-field="<?php echo $field["code"] ?>">
        <?php foreach($field["values"] as $label => $value) : ?>
            <label>
                <input type="checkbox" value="<?php echo $value ?>" class="js-checkbox">
                <?php _e($label, 'photoblocks') ?>
            </label>
        <?php endforeach ?>
        <input type="hidden" class="js-serialize js-serialize-checkboxes" name="<?php echo $field["code"] ?>" value="">
    </span>
</div>
<div class="pb-settings-description"><p><?php _e($field["description"], 'photobocks') ?></p></div>