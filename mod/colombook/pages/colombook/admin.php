<?php
function colombook_view_users($entities, $vars = array(), $offset = 0, $limit = 10, $full_view = true,
$list_type_toggle = true, $pagination = true) {

	if (!is_int($offset)) {
		$offset = (int)get_input('offset', 0);
	}

        $defaults = array(
                'items' => $entities,
                'list_class' => 'elgg-list-entity',
                'full_view' => true,
                'pagination' => true,
                'list_type' => $list_type,
                'list_type_toggle' => false,
                'offset' => $offset,
        );

        $vars = array_merge($defaults, $vars);

        return elgg_view('colombook/users', $vars);
}

$users = elgg_list_entities(array(
			'type' => 'user', 
			'joins' => array("join ".elgg_get_config("dbprefix")."users_entity u on e.guid = u.guid"),
			'wheres' => array("u.admin = 'no'")
		), elgg_get_entities, colombook_view_users);

//$users = elgg_list_entities(array('type'=>'user'));
//$user = elgg_get_logged_in_user_entity();
$body = elgg_view_title("Liste des utilisateurs");
$body .= elgg_view_layout('one_column', array('content' => $users));
echo elgg_view_page("Gestion COLOMBOOK", $body);
?>
