<?php
    $posts = elgg_list_entities(array(
        'type' => 'object',
        'subtype' => 'blog',
        'owner_guid' => $colombookUser->getGUID
    ));
    $body = elgg_view_layout('one_column', array('content' => $posts));
    echo $body;
?>
