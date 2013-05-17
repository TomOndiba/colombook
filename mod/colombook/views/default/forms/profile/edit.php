<?php
/**
 * Edit profile form
 *
 * @uses vars['entity']
 */

?>

<?php

$profile_fields = array('firstname' => array('type'=>'text'),
                'lastname' => array('type'=>'text'),
                'description' => array('type'=>'longtext'),
                'birthday' => array('type'=>'date', 'access' => 1),
                'sex' => array('type'=>'radio', 'options'=>array('Une fille'=>'f', 'Un garçon'=>'m')),
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
        
if (is_array($profile_fields) && count($profile_fields) > 0) {
	foreach ($profile_fields as $shortname => $field_data) {
		$metadata = elgg_get_metadata(array(
			'guid' => $vars['entity']->guid,
			'metadata_name' => $shortname,
			'limit' => false
		));
		if ($metadata) {
			if (is_array($metadata)) {
				$value = '';
				foreach ($metadata as $md) {
					if (!empty($value)) {
						$value .= ', ';
					}
					$value .= $md->value;
					$access_id = $md->access_id;
				}
			} else {
				$value = $metadata->value;
				$access_id = $metadata->access_id;
			}
		} else {
			$value = '';
			$access_id = ACCESS_DEFAULT;
		}

?>
<div class='colombook_form'>
	<label><?php echo elgg_echo("profile:{$shortname}") ?></label>
	<?php
		$params = array(
			'name' => $shortname,
			'value' => $value,
		);
                $type = $field_data['type'];
                if (isset($field_data['access']))
                    $access = true;
                else
                    $access = false;
                unset($field_data['access']);
                unset($field_data['type']);
                $params = array_merge($params, $field_data);
		echo elgg_view("input/{$type}", $params);
                if ($access) {
                    $params = array(
                            'name' => "accesslevel[$shortname]",
                            'value' => $access_id,
                    );
                    if ($access_id == ACCESS_PRIVATE) {
                        $params['checked'] = "1";
                    }
                    echo "<div class='colombook_access'>";
                    echo elgg_view("input/checkbox", $params);
                    echo "<label>Information privée</label>";
                    echo "</div>";
                }
	?>
</div>
<?php
	}
}
?>
<div class="elgg-foot">
<?php
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['entity']->guid));
	echo elgg_view('input/submit', array('value' => elgg_echo('save')));
?>
</div>
