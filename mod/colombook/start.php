<?php

elgg_register_event_handler('init', 'system', 'colombook_init');

function colombook_page_handler($segments) {
    $page = null;
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
                elgg_set_view_location("user/default", dirname(__FILE__)."/views/default/colombook/");

                //elgg_set_view_location("user/default", dirname(__FILE__)."/views/default/colombook/user.php");
                //elgg_set_view_location("user/default", elgg_get_plugins_path()."colombook/views/default/colombook/user.php");                
            }
            break;        
    }
    if ($page !== null) {
        include elgg_get_plugins_path() . "colombook/pages/colombook/".$page;
        return true;
    }
    return false;
}


function colombook_init() {
    // Page d'accueil
    elgg_register_plugin_hook_handler('index', 'system', 'new_index');
    // Pages Colombook
    elgg_register_page_handler('cb', 'colombook_page_handler');
    // Gestion de l'affichage des éléments de la page
    elgg_register_plugin_hook_handler('view', 'navigation/menu/site', 'colombook_topbar_manager');
    elgg_register_plugin_hook_handler('view', 'search/search_box', 'colombook_topbar_manager');
    elgg_unregister_menu_item('topbar', 'elgg_logo');
    // Actions
    // -------
    // Enregistrement d'un utilisateur
    elgg_register_action("colombook/register", elgg_get_plugins_path() . "colombook/actions/colombook/register.php", 'public');
    // Configuration
    elgg_set_config('colombook_hide_topbar', false);
    //elgg_extend_view('forms/register', 'colombook/register');
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
 
function new_index() {
    if (elgg_is_logged_in ())
        return false;
    elgg_set_config('colombook_hide_topbar', true);
    if (!include_once(elgg_get_plugins_path() . "/colombook/pages/colombook/index.php"))
        return false;
    return true;
}
