<?php

elgg_register_event_handler('init', 'system', 'colombook_init');
$colombookUser = null;

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


function colombook_init() {
    // Page d'accueil
    elgg_register_plugin_hook_handler('index', 'system', 'new_index');
    // Pages Colombook
    elgg_register_page_handler('cb', 'colombook_page_handler');
    // Gestion de l'affichage des éléments de la page
    elgg_register_plugin_hook_handler('view', 'navigation/menu/site', 'colombook_topbar_manager');
    elgg_register_plugin_hook_handler('view', 'search/search_box', 'colombook_topbar_manager');
    elgg_unregister_menu_item('topbar', 'elgg_logo');
    
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
    
    elgg_unregister_menu_item('topbar', 'elgg_logo');

    // Actions
    // -------
    // Enregistrement d'un utilisateur
    elgg_register_action("colombook/register", elgg_get_plugins_path() . "colombook/actions/colombook/register.php", 'public');
    // Configuration
    elgg_set_config('colombook_hide_topbar', false);
    //elgg_extend_view('forms/register', 'colombook/register');
    
    // Javascript
    $js_url = elgg_get_site_url()."mod/colombook/js/colombook.js";
    elgg_register_js('colombook', $js_url);

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
