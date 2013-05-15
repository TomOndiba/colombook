<?php
    elgg_load_js("colombook");
    $body = elgg_view_title("Utilisateur : ".$colombookUser->name);
    /*$posts = elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'blog',
        'owner_guid' => $user->getGUID
    ));*/
    /*$emails = elgg_get_entities($options);
    $messages = ;*/
    $userId = $colombookUser->getGUID();
    
    $body.="<ul id=\"colombook_admin_tabs\">";
    $body.="<li class=\"colombook_admin_tab\"><a href=\"javascript:colombook_jump('cb/ax_profile/$userId')\">Profil</a></li>";
    $body.="<li class=\"colombook_admin_tab\"><a href=\"javascript:colombook_jump('cb/ax_posts/$userId')\">Posts</a></li>";
    $body.="<li class=\"colombook_admin_tab\"><a href=\"javascript:colombook_jump('cb/ax_emails/$userId')\">Emails</a></li>";
    $body.="<li class=\"colombook_admin_tab\"><a href=\"javascript:colombook_jump('cb/ax_chat/$userId')\">Chats</a></li>";
    $body.="</ul>";
    $body.="<div id=\"colombook_content\"></div>";
    echo elgg_view_page("Gestion COLOMBOOK", $body);

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
