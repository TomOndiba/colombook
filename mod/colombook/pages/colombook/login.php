<?php
$login_url = elgg_get_site_url();
if (elgg_get_config('https_login')) {
	$login_url = str_replace("http:", "https:", $login_url);
}
$content = elgg_view_title("Connexion");
$content .= elgg_view_form('login', array('action' => "{$login_url}action/login"));
$body = elgg_view_layout('one_column',array('content'=>$content));
echo elgg_view_page("Connexion", $body);
?>
