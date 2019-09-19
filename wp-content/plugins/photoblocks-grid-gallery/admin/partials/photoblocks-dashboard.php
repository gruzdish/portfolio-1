<div class="wrap" id="photoblocks-dashboard">
	<h1 class="wp-heading-inline"><?php _e('Galleries', 'photoblocks') ?></h1>
	<a href="?page=<?php echo $this->plugin_name ?>-edit" class="page-title-action"><?php _e('Create a new gallery', 'photoblocks') ?></a>

	<hr class="wp-header-end">
	<br>
	<br>
	<br>
	
	<div class="panel">
				
		<table class="wp-list-table widefat fixed striped photoblocks">
			<thead>
				<tr>
					<th><?php _e('Gallery name', 'photoblocks') ?></th>
                    <th><?php _e('Shortcode', 'photoblocks') ?></th>
				</tr>
			</thead>
			<tbody>
			<?php if(count($_bag["galleries"]) == 0) : ?>	
				<tr>
					<td colspan="2"><?php _e('No items found.', 'photoblocks') ?></td>
				</tr>
			<?php endif ?>
            <?php foreach($_bag["galleries"] as $g) : ?>
            <tr>
                <td>
					<a class="row-title" href="?page=<?php echo $this->plugin_name ?>-edit&amp;id=<?php echo $g->id ?>"><?php echo $g->name ?></a>
					<div class="row-actions">
						<span class="edit"><a href="?page=<?php echo $this->plugin_name ?>-edit&amp;id=<?php echo $g->id ?>" aria-label="Edit">Edit</a> | </span>
						<span class="clone"><a href="?page=<?php echo $this->plugin_name ?>&amp;action=clone&amp;id=<?php echo $g->id ?>" data-id="<?php echo $g->id ?>" aria-label="Clone">Clone</a> | </span>
						<span class="trash"><a href="?page=<?php echo $this->plugin_name ?>&amp;action=delete&amp;id=<?php echo $g->id ?>" data-id="<?php echo $g->id ?>" class="submitdelete" aria-label="Delete">Delete</a></span>
					</div>
				</td>
                <td><input type="text" readonly value="[photoblocks id=<?php echo $g->id ?>]"></td>
            </tr>
            <?php endforeach ?>
			</tbody>
			<tfoot>
				<tr>
					<th><?php _e('Gallery name', 'photoblocks') ?></th>
                    <th><?php _e('Shortcode', 'photoblocks') ?></th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>