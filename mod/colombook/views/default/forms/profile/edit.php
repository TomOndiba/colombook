<?php
/**
 * Edit profile form
 *
 * @uses vars['entity']
 */
require elgg_get_plugins_path()."colombook/lib/colombook.php";

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
                            'name' => "privateaccess[$shortname]",
                            'value' => "1",
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
