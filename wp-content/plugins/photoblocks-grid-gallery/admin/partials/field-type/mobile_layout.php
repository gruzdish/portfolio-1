<label class="pb-settings-label">
  <span class="control"><?php _e($field["name"], 'photoblocks') ?>
</label>
<table class="js-mobile-layouts-list mobile-layouts-list" data-field="<?php echo $field["code"] ?>">
  <thead>
    <tr>
      <th><?php _e('Number of columns', 'photoblocks') ?></th>
      <th><?php _e('Max resolution (px)', 'photoblocks') ?></th>
      <th></th>
    </tr>
  </thead>
  <tbody id="mobile-layout-<?php echo $field["code"] ?>"></tbody>
</table>
<input type="hidden" value="" name="<?php echo $field["code"] ?>" class="js-serialize js-serialize-mobile-layout"></span>
<a class="pb-button" onclick="PBAdmin.addMobileLayout(this)" data-field="<?php echo $field["code"] ?>"><?php _e("Add layout", 'photobocks') ?></a>

<div class="pb-settings-description"><p><?php _e($field["description"], 'photoblocks') ?></p></div>