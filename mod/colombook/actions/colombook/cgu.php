<?php
    function getUsers() {
        return elgg_get_entities(array(
			'type' => 'user', 
			'joins' => array("join ".elgg_get_config("dbprefix")."users_entity u on e.guid = u.guid"),
			'wheres' => array("u.admin = 'no'")
		));
    }

    function getGUIDs() {
        $dbPrefix = elgg_get_config("dbprefix");
        $query = "SELECT DISTINCT e.guid FROM {$dbPrefix}entities e join {$dbPrefix}users_entity u on e.guid = u.guid where e.enabled='yes' and u.admin = 'no'";
        return elgg_query_runner($query);
    }

    
    function connectEveryUsers($currentUser) {
        /*$users = getUsers();
        $currentGUID = $currentUser->getGUID();
        foreach ($users as $user) {
            $guid = $user->getGUID();
            if ($guid!=$currentGUID) {
                $user->addFriend($currentGUID);
                $currentUser->addFriend($guid);
            }
        }*/
        $currentGUID = $currentUser->getGUID();
        $userGUIDs = getGUIDs();
        foreach ($userGUIDs as $guidObject) {
            $guid = intval($guidObject->guid);
            if ($guid!=$currentGUID) {
                add_entity_relationship($currentGUID, "friend", $guid);
                add_entity_relationship($guid, "friend", $currentGUID);
            }
        }
    }

    $guid = get_input("guid");
    $euros = get_input("euros");
    if ($guid !== NULL) {
        elgg_push_context('colombook_validate_user');
        $access_status = access_get_show_hidden_status();
        access_show_hidden_entities(TRUE);
        $colombookUser = get_user($guid);
        if ($euros !== NULL) {
            $euros = false;
        } else {
            $euros = true;
        }
        $colombookUser->enable();
	elgg_set_user_validation_status($guid, TRUE);
        $colombookUser->cgu_euros = $euros;
        $colombookUser->save();
        access_show_hidden_entities($access_status);
        elgg_pop_context();
        login($colombookUser, false);
        //connectEveryUsers($colombookUser);
        system_message("Bienvenue sur le Colombook !");
        forward("blog/all");
    }
?>
