<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$content = "salut !<br>";
$content.="Pour te connecter, c'est ici : <a href='".elgg_normalize_url("cb/login")."'>Connexion</a><br>";
$content.="Pour te créer un compte, c'est ici : <a href ='".elgg_normalize_url("cb/register")."'>Créer un compte</a><br>";
$body = elgg_view_layout('one_column',array('content'=>$content));
echo elgg_view_page("salut", $body);
?>
