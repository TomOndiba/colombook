<?php
/**
 * Elgg registration action
 *
 * @package Elgg.Core
 * @subpackage User.Account
 */

elgg_make_sticky_form('colombook/register');

require elgg_get_plugins_path()."colombook/lib/colombook.php";

$friend_guid = (int) get_input('friend_guid', 0);
$invitecode = get_input('invitecode');

if (elgg_get_config('allow_registration')) {
    try {
        // test des données obligatoires
        foreach ($mandatory_fields as $dataname) {
            $data = get_input($dataname);
            if (trim($data) == "") {
                throw new RegistrationException(elgg_echo("colombook:empty_$dataname"));
            }
        }
        
        $username = get_input('username');
        $password = get_input('password', null, false);
        $password2 = get_input('password2', null, false);
        $firstname = get_input('firstname');
        $lastname = get_input('lastname');
        $email = get_input('email');

        // Test des mots de passe
        if (trim($password) == "" || trim($password2) == "") {
            throw new RegistrationException(elgg_echo('RegistrationException:EmptyPassword'));
        }
        if (strcmp($password, $password2) != 0) {
                throw new RegistrationException(elgg_echo('RegistrationException:PasswordMismatch'));
        }
        
        $name = $firstname." ".$lastname;

        // enregistrement de l'utilisateur
        $guid = register_user($username, $password, $name, $email, false, $friend_guid, $invitecode);

        if ($guid) {
            $new_user = get_entity($guid);
            
            // Enregistrement des données supplémentaires
            foreach ($profile_fields as $field_name=>$field_data) {
                $value = get_input($field_name);
                if ($value!==NULL) {
                    if (isset($field_data['access'])) {
                        $access_id = ACCESS_PRIVATE;
                    } else {
                        $access_id = ACCESS_LOGGED_IN;
                    }
                    create_metadata($guid, $field_name, $value, 'text', $guid, $access_id);
                }
                else 
                    elgg_delete_metadata(array('guid' => $guid, 'metadata_name' => $field_name, 'limit' => false));
            }
            
            // allow plugins to respond to self registration
            // note: To catch all new users, even those created by an admin,
            // register for the create, user event instead.
            // only passing vars that aren't in ElggUser.
            $params = array(
                    'user' => $new_user,
                    'password' => $password,
                    'friend_guid' => $friend_guid,
                    'invitecode' => $invitecode
            );

            // @todo should registration be allowed no matter what the plugins return?
            if (!elgg_trigger_plugin_hook('register', 'user', $params, TRUE)) {
                    $ia = elgg_set_ignore_access(true);
                    $new_user->delete();
                    elgg_set_ignore_access($ia);
                    // @todo this is a generic messages. We could have plugins
                    // throw a RegistrationException, but that is very odd
                    // for the plugin hooks system.
                    throw new RegistrationException(elgg_echo('registerbad'));
            }

            elgg_clear_sticky_form('register');
            system_message(elgg_echo("registerok", array(elgg_get_site_entity()->name)));

            // if exception thrown, this probably means there is a validation
            // plugin that has disabled the user
            try {
                    login($new_user);
            } catch (LoginException $e) {
                    // do nothing
            }

            // Forward on success, assume everything else is an error...
            forward();
        } else {
            register_error(elgg_echo("registerbad"));
        }
    } catch (RegistrationException $r) {
        register_error($r->getMessage());
    }
} else {
    register_error(elgg_echo('registerdisabled'));
}

forward(REFERER);
