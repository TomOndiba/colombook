<?php
$profile_fields = array('firstname' => array('type'=>'text'),
                'lastname' => array('type'=>'text'),
                'description' => array('type'=>'longtext'),
                'birthday' => array('type'=>'date', 'access' => 1),
                'sex' => array('type'=>'radio', 'options'=>array('Une fille'=>'une fille', 'Un garçon'=>'un garçon')),
                'school' => array('type'=>'text'),
                'class' => array('type'=>'text'),
		'address' => array('type'=>'plaintext', 'rows' => 3),
		'phone' => array('type'=>'text', 'access' => 1),
		'console' => array('type'=>'dropdown', 'options' => array("Non", "PSP", "PSP Vita", "Nintendo DS", "PS2", "PS3", "Xbox", "Xbox 360", "Wii", "Game Cube", "Autre"), 'access' => 1),
		'parents' => array('type'=>'plaintext', 'rows' => 3, 'access' => 1),
                'sport' => array('type'=>'dropdown', 'options' => array("Non", "Football", "Basket", "Handball", "Badminton", "Natation", "Art martial", "Roller", "Trotinette ", "Skate", "Hip Hop", "Autre"), 'access' => 1),
                'music' => array('type'=>'text', 'access' => 1),
                'tv' => array('type'=>'text', 'access' => 1),
		'contactemail' => array('type'=>'email', 'access' => 1)
    );
// Données obligatoires
$mandatory_fields = array('firstname', 'lastname', 'birthday', 'sex', 'school', 'class', 'address', 'email', 'username');

?>
