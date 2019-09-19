<?php $disabled = ($field["premium_only"] && !photob_fs()->is_plan_or_trial($field["min_plan"])) ? "disabled" : "" ?>
<label class="pb-settings-label">
    <span class="control">    
        <input <?php echo $disabled ?> type="checkbox" value="1" class="js-serialize" name="<?php echo $field["code"] ?>">
        <?php _e($field["name"], 'photoblocks') ?>
        <?php if($field["premium_only"] && !photob_fs()->is_plan_or_trial($field["min_plan"])) : ?><span class='pb-badge'>PREMIUM: <?php echo $field["min_plan"] ?> plan</span><?php endif ?>
        </span>
</label>
<div class="pb-settings-description"><p><?php _e($field["description"], 'photobocks') ?></p></div>