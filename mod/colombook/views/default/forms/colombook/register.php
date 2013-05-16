<?php
/**
 * Elgg register form
 *
 * @package Elgg
 * @subpackage Core
 */

$password = $password2 = '';
$username = get_input('u');
$email = get_input('e');
$name = get_input('n');

if (elgg_is_sticky_form('colombook/register')) {
	extract(elgg_get_sticky_values('colombook/register'));
	elgg_clear_sticky_form('colombook/register');
}
?>
<div class="colombook_form colombook_required">
	<label>Prénom</label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'firstname',
		'value' => $firstname,
	));
	?>
</div>
<div class="colombook_form colombook_required">
	<label>Nom</label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'lastname',
		'value' => $lastname,
	));
	?>
</div>
<div class="colombook_form colombook_required">
	<label>Date de naissance</label><br />
	<?php
	echo elgg_view('input/date', array(
		'name' => 'birthday',
		'value' => $birthday,
	));
	?>
</div>
<div class="colombook_form colombook_required">
	<label>Tu es :</label><br />
	<?php
	echo elgg_view('input/radio', array(
		'name' => 'sex',
                'options'=>array('Une fille'=>'f', 'Un garçon'=>'m'),
		'value' => $sex,
	));
	?>
</div>
<div class="colombook_form colombook_required">
	<label>Nom de ton collège</label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'school',
		'value' => $school,
	));
	?>
</div>
<div class="colombook_form colombook_required">
	<label>En quelle classe es-tu ?</label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'class',
		'value' => $class,
	));
	?>
</div>
<div class="colombook_form colombook_required">
	<label>Quelle est ton adresse ?</label><br />
	<?php
	echo elgg_view('input/plaintext', array(
		'name' => 'address',
		'value' => $address,
                'rows' => '3',
	));
	?>
</div>
<div class="colombook_form colombook_required">
	<label><?php echo elgg_echo('email'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'email',
		'value' => $email,
	));
	?>
</div>
<div class="colombook_form">
	<label>Quel est ton numéro de téléphone ?</label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'phone',
		'value' => $phone,
	));
	?>
</div>
<div class="colombook_form">
	<label>As-tu une console ?</label><br />
	<?php
	echo elgg_view('input/dropdown', array(
		'name' => 'console',
		'value' => $console,
                'options' => array("Non", "PSP", "PSP Vita", "Nintendo DS", "PS2", "PS3", "Xbox", "Xbox 360", "Wii", "Game Cube", "Autre"),
	));
	?>
</div>
<div class="colombook_form">
	<label>Quelle est la profession de tes parents ?</label><br />
	<?php
	echo elgg_view('input/plaintext', array(
		'name' => 'parents',
		'value' => $parents,
                'rows' => 3,
	));
	?>
</div>
<div class="colombook_form">
	<label>Pratiques-tu un sport ?</label><br />
	<?php
	echo elgg_view('input/dropdown', array(
		'name' => 'sport',
		'value' => $sport,
                'options' => array("Non", "Football", "Basket", "Handball", "Badminton", "Natation", "Art martial", "Roller", "Trotinette ", "Skate", "Hip Hop", "Autre"),
	));
	?>
</div>
<div class="colombook_form">
	<label>Quel est ton groupe de musique préféré ?</label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'music',
		'value' => $music,
	));
	?>
</div>
<div class="colombook_form">
	<label>Quelle est ton émission de TV préférée ?</label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'tv',
		'value' => $tv,
	));
	?>
</div>
<div class="colombook_form colombook_required">
	<label><?php echo elgg_echo('username'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'username',
		'value' => $username,
	));
	?>
</div>
<div class="colombook_form colombook_required">
	<label><?php echo elgg_echo('password'); ?></label><br />
	<?php
	echo elgg_view('input/password', array(
		'name' => 'password',
		'value' => $password,
	));
	?>
</div>
<div class="colombook_form colombook_required">
	<label><?php echo elgg_echo('passwordagain'); ?></label><br />
	<?php
	echo elgg_view('input/password', array(
		'name' => 'password2',
		'value' => $password2,
	));
	?>
</div>
<?php
echo '<div class="elgg-foot">';
echo "<div class='colombook_note'>* information obligatoire</div>";
echo elgg_view('input/hidden', array('name' => 'friend_guid', 'value' => $vars['friend_guid']));
echo elgg_view('input/hidden', array('name' => 'invitecode', 'value' => $vars['invitecode']));
echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('register')));
echo '</div>';