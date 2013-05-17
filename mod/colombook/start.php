<?php

elgg_register_event_handler('init', 'system', 'colombook_init');
elgg_register_event_handler('pagesetup', 'system', 'colombook_init_2');

function colombook_init() {
    // Page d'accueil
    elgg_register_plugin_hook_handler('index', 'system', 'new_index');
    // Pages Colombook
    elgg_register_page_handler('cb', 'colombook_page_handler');
    
    // Gestion de l'affichage des éléments de la page
    elgg_register_plugin_hook_handler('view', 'navigation/menu/site', 'colombook_topbar_manager');
    elgg_register_plugin_hook_handler('view', 'search/search_box', 'colombook_topbar_manager');
    elgg_register_plugin_hook_handler('view', 'page/layouts/content/filter', 'colombook_filter_manager');
    elgg_register_plugin_hook_handler('view', 'navigation/breadcrumbs', 'colombook_breadcrumbs_manager');
    elgg_register_plugin_hook_handler('prepare', 'menu:entity', 'colombook_entity_menu_manager');
    elgg_register_plugin_hook_handler('prepare', 'menu:page', 'colombook_page_menu_manager');
    elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'colombook_user_hover_menu_manager');

    
    // Invalide un nouvel utilisateur, tant qu'il n'a pas accepté les CGU
    elgg_register_plugin_hook_handler('register', 'user', 'colombook_disable_new_user');
    // canEdit override to allow not logged in code to disable a user
    elgg_register_plugin_hook_handler('permissions_check', 'user', 'colombook_allow_new_user_can_edit');

    // Actions
    // -------
    // Enregistrement d'un utilisateur
    elgg_register_action("colombook/register", elgg_get_plugins_path() . "colombook/actions/colombook/register.php", 'public');
    // Acceptation des CGU
    elgg_register_action("colombook/cgu", elgg_get_plugins_path() . "colombook/actions/colombook/cgu.php", 'public');

    
    // Configuration
    elgg_set_config('colombook_hide_topbar', false);
    if (strcmp(elgg_get_context(),"blog")==0)
        elgg_set_config('colombook_hide_filter', true);
    else 
        elgg_set_config('colombook_hide_filter', false);
    if (strcmp(elgg_get_context(),"blog")==0)
        elgg_set_config('colombook_hide_breadcrumbs', true);
    else 
        elgg_set_config('colombook_hide_breadcrumbs', false);
    //elgg_extend_view('forms/register', 'colombook/register');
    
    // Javascript
    $js_url = elgg_get_site_url()."mod/colombook/js/colombook.js";
    elgg_register_js('colombook', $js_url);
    
    // CSS
    elgg_extend_view("css/elgg", "colombook/css");
    
    // On supprime le RSS
    elgg_unregister_plugin_hook_handler('output:before', 'layout', 'elgg_views_add_rss_link');

    //elgg_unregister_plugin_hook_handler('register', 'menu:user_hover', 'elgg_user_hover_menu');
}

function colombook_init_2() {
    // Menus
    colombook_init_menus();
}

function colombook_page_handler($segments) {
    $page = null;
    $colombookUser = null;
    $guid = null;
    switch ($segments[0]) {
        case 'register':
            $page = "register.php";
            elgg_set_config('colombook_hide_topbar', true);
            break;
        case 'login':
            $page = "login.php";
            elgg_set_config('colombook_hide_topbar', true);
            break;
        case 'admin':
            // page restreinte à un administrateur
            if (elgg_is_admin_logged_in()) {
                $page = "admin.php";
                elgg_set_view_location("user/default", elgg_get_plugins_path()."colombook/views_colombook/");
            }
            break;        
        case 'user':
            // page restreinte à un administrateur
            if (elgg_is_admin_logged_in()) {
                $page = "user.php";
                $colombookUser = get_user($segments[1]);
                elgg_set_view_location("object/blog", elgg_get_plugins_path()."colombook/views_colombook/");
            }
            break;        
        case 'cgu':
            $page = "cgu.php";
            $guid = $segments[1];
            elgg_set_config('colombook_hide_topbar', true);
            break;        
        case 'ax_posts':
        case 'ax_email':
        case 'ax_chat':
        case 'ax_profile':
            // page restreinte à un administrateur
            if (elgg_is_admin_logged_in()) {
                $page = $segments[0].".php";
                $colombookUser = get_user($segments[1]);
            }
            break;
    }
    if ($page !== null) {
        include elgg_get_plugins_path() . "colombook/pages/colombook/".$page;
        return true;
    }
    return false;
}

function colombook_init_menus() {
    elgg_unregister_menu_item('topbar', 'elgg_logo');
    elgg_unregister_menu_item('topbar', 'friends');
    // On enlève tous les items du menu site
    elgg_unregister_menu_item('site', 'activity');
    elgg_unregister_menu_item('site', 'blog');
    elgg_unregister_menu_item('site', 'file');
    elgg_unregister_menu_item('site', 'members');

    // On ajoute nos menus
    elgg_register_menu_item('site', array(
            'name' => "activity",
            'href' => "blog/all",
            'text' => "Activités",
    ));
    
    if (elgg_is_logged_in()) {
        $href = "blog/owner/".  elgg_get_logged_in_user_entity()->username;
        elgg_register_menu_item('site', array(
                'name' => "wall",
                'href' => $href,
                'text' => "Mon mur",
        ));

        $href = "friends/".  elgg_get_logged_in_user_entity()->username;
        elgg_register_menu_item('site', array(
                'name' => "contacts",
                'href' => $href,
                'text' => "Mes amis",
        ));

        
    }

    elgg_register_menu_item('page', array(
            'name' => "colombook",
            'href' => "cb/admin",
            'text' => "Colombook",
            'context' => 'admin',
            'section' => "administer"
    ));
    
    if (elgg_is_admin_logged_in()) {
        elgg_register_menu_item('topbar', array(
                'name' => "colombook",
                'href' => "cb/admin",
                'text' => "Administration Colombook",
                'section' => "alt"
        ));
    }
}

function colombook_topbar_manager($hook, $type, $returnvalue, $params) {
    $hideTopbar = elgg_get_config('colombook_hide_topbar');
    if ($hideTopbar) {
        // Hide element
        return "";
    } else {
        return $returnvalue;
    }
}

function colombook_filter_manager($hook, $type, $returnvalue, $params) {
    $hideFilter = elgg_get_config('colombook_hide_filter');
    if ($hideFilter) {
    /*if (strcmp(elgg_get_context(),"blog")==0) {
        die(var_dump($returnvalue));*/
        return "";
    } else
        return $returnvalue;
}

function colombook_breadcrumbs_manager($hook, $type, $returnvalue, $params) {
    $hideBreadcrumbs = elgg_get_config('colombook_hide_breadcrumbs');
    if ($hideBreadcrumbs) {
        return "";
    } else
        return $returnvalue;
}

function new_index() {
    if (elgg_is_logged_in ()) {
        forward ("blog/all");
        return true;
    }
    elgg_set_config('colombook_hide_topbar', true);
    if (!include_once(elgg_get_plugins_path() . "/colombook/pages/colombook/index.php"))
        return false;
    return true;
}
function colombook_entity_menu_manager($hook, $type, $returnValue, $vars) {
    if ($vars['handler'] == "blog") {
        unset($returnValue["default"][0]);
        $returnValue["default"] = array_values($returnValue["default"]);
    }
    return $returnValue;
}

function colombook_page_menu_manager($hook, $type, $returnValue, $vars) {
    if (elgg_get_context() == "friends") {
        return array();
    }
    return $returnValue;
}

function colombook_user_hover_menu_manager($hook, $type, $returnValue, $vars) {
    //die(var_dump($returnValue));
    $index = -1;
    $i = 0;
    foreach($returnValue as $item) {
        if ($item->getName() == "remove_friend") {
            $index = $i;
        }
        $i++;
    }
    if ($index>=0) {
        unset($returnValue[$index]);
        $returnValue = array_values($returnValue);
    }
    return $returnValue;
}

function colombook_disable_new_user($hook, $type, $value, $params) {
	$user = elgg_extract('user', $params);

	// no clue what's going on, so don't react.
	if (!$user instanceof ElggUser) {
		return;
	}

	// another plugin is requesting that registration be terminated
	if (!$value) {
		return $value;
	}

	// has the user already been validated?
	if (elgg_get_user_validation_status($user->guid) == true) {
		return $value;
	}

	// disable user to prevent showing up on the site
	// set context so our canEdit() override works
	elgg_push_context('colombook_new_user');
	$hidden_entities = access_get_show_hidden_status();
	access_show_hidden_entities(TRUE);

	// Don't do a recursive disable.  Any entities owned by the user at this point
	// are products of plugins that hook into create user and might need
	// access to the entities.
	// @todo That ^ sounds like a specific case...would be nice to track it down...
	$user->disable('colombook_cgu', FALSE);

	elgg_set_user_validation_status($user->guid, FALSE);

	elgg_pop_context();
	access_show_hidden_entities($hidden_entities);

        forward("cb/cgu/".$user->guid);
        
	return $value;
}

function colombook_allow_new_user_can_edit($hook, $type, $value, $params) {
	$user = elgg_extract('entity', $params);

	if (!($user instanceof ElggUser)) {
		return;
	}

	$context = elgg_get_context();
	if ($context == 'colombook_new_user' || $context == 'colombook_validate_user') {
		return TRUE;
	}

	return;
}