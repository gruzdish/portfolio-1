<?php foreach($this->settings->fields[$section] as $group) : ?>    
    <li><a href="#sub-<?php echo Photoblocks_Utils::slugify($group["name"]) ?>"><?php _e($group["name"], 'photoblocks') ?></a></li>
<?php endforeach ?>