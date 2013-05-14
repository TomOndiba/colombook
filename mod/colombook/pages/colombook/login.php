<?php
$content = elgg_view('core/account/login_box');
$body = elgg_view_layout('one_column',array('content'=>$content));
echo elgg_view_page("Connexion", $body);
?>
