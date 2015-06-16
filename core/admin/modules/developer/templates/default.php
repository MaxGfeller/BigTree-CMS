<?php
	$templates = $admin->getTemplates();

	$basic_data = $routed_data = array();
	foreach ($templates as $template) {
		if ($template["routed"]) {
			$routed_data[] = $template;
		} else {
			$basic_data[] = $template;
		}
	}
?>
<div id="basic_templates"></div>
<div id="routed_templates"></div>
<script>
	var config = {
		actions: {
			edit: function(id,state) {
				document.location.href = "<?=DEVELOPER_ROOT?>templates/edit/" + id + "/";
			},
			delete: function(id,state) {
				BigTreeDialog({
					title: "Delete Template",
					content: '<p class="confirm">Are you sure you want to delete this template?<br /><br />Deleting a template also removes its files in the /templates/ directory.</p>',
					icon: "delete",
					alternateSaveText: "OK",
					callback: function() {
						document.location.href = "<?=DEVELOPER_ROOT?>templates/delete/" + id + "/";
					}
				});
			}
		},
		columns: {
			name: { title: "Template Name", largeFont: true, actionHook: "edit" }
		},
		draggable: function(positioning) {
			console.log(positioning);
		}
	};

	// Basic table
	config.data = <?=json_encode($basic_data)?>;
	config.container = "#basic_templates";
	config.title = "Basic Templates";
	BigTreeTable(config);

	// Routed table
	config.data = <?=json_encode($routed_data)?>;
	config.container = "#routed_templates";
	config.title = "Routed Templates";
	BigTreeTable(config);
</script>