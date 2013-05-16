<?php
$content = elgg_view_title("Conditions Générales d'Utilisation");
$content .= elgg_view_form("colombook/cgu", array(), array('guid'=>$guid));
$body =elgg_view_layout('one_column',array('content'=>$content));
echo elgg_view_page("Conditions Générales d'Utilisation", $body);
?>
