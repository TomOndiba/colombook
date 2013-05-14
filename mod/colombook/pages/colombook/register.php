<?php
$content = elgg_view_title("S'enregistrer");
$content .= elgg_view_form('colombook/register');
$body = elgg_view_layout('one_column',array('content'=>$content));
echo elgg_view_page("S'enregistrer", $body);
?>
