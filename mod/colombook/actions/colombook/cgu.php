<?php
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
        system_message("Bienvenue sur le Colombook !");
        forward();
    }
?>
