<?php
$content = elgg_view_title("Liste des utilisateurs");
$content .= elgg_list_entities(array(
			'type' => 'user', 
			'joins' => array("join ".elgg_get_config("dbprefix")."users_entity u on e.guid = u.guid"),
			'wheres' => array("u.admin = 'no'")
		));
$body = elgg_view_layout('one_column', array('content' => $content));
echo elgg_view_page("Gestion COLOMBOOK", $body);
?>
