<label class="pb-settings-label">
    <span class="control"><?php _e($field["name"], 'photoblocks') ?>
        <?php if(array_key_exists("deprecated", $field)) : ?><span class="pb-badge"><?php _e('Deprecated', 'photobocks') ?></span><?php endif ?>
        <input type="number" value="" onkeyup="<?php echo $field["onchange"] ?>" name="<?php echo $field["code"] ?>" class="js-serialize"></span>
</label>
<div class="pb-settings-description"><p><?php _e($field["description"], 'photobocks') ?></p></div>