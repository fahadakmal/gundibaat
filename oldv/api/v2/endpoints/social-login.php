<?php
// +------------------------------------------------------------------------+
// | @author Monjur Munna
// | @author_url 1: https://imean.xyz
// | @author_url 2: https://imean.xyz/
// | @author_email: admin@imean.xyz   
// +------------------------------------------------------------------------+
// | iMean - Social Networking Website
// | Copyright (c) 2018 iMean. All rights reserved.
// +------------------------------------------------------------------------+

use AppleSignIn\ASDecoder;
$response_data   = array(
    'api_status' => 400
);
$required_fields = array(
    'access_token',
    'provider'
);
foreach ($required_fields as $key => $value) {
    if (empty($_POST[$value]) && empty($error_code)) {
        $error_code    = 3;
        $error_message = $value . ' (POST) is missing';
    }
}
if (empty($error_code)) {
	$social_id          = 0;
    $access_token       = $_POST['access_token'];
    $provider           = $_POST['provider'];
    if ($provider == 'facebook') {
    	$get_user_details = fetchDataFromURL("https://graph.facebook.com/me?fields=email,id,name,age_range&access_token={$access_token}");
    	$json_data = json_decode($get_user_details);
    	if (!empty($json_data->error)) {
    		$error_code    = 4;
    		$error_message = $json_data->error->message;
    	} else if (!empty($json_data->id)) {
    		$social_id = $json_data->id;
    		$social_email = $json_data->email;
    		$social_name = $json_data->name;
    		if (empty($social_email)) {
    			$social_email = 'fb_' . $social_id . '@facebook.com';
    		}
    	}
    } else if ($provider == 'google') {
        
		$get_user_details = fetchDataFromURL("https://oauth2.googleapis.com/tokeninfo?id_token={$access_token}");
		$json_data = json_decode($get_user_details);
		if (!empty($json_data->error)) {
    		$error_code    = 4;
    		$error_message = $json_data->error;
    	} else if (!empty($json_data->kid)) {
    		$social_id = $json_data->kid;
    		$social_email = $json_data->email;
    		$social_name = $json_data->name;
    		if (empty($social_email)) {
    			$social_email = 'go_' . $social_id . '@google.com';
    		}
    	}
    }
    elseif ($provider == 'apple') {
        include_once('assets/libraries/apple/vendor/autoload.php');
        try{
            $appleSignInPayload = ASDecoder::getAppleSignInPayload($access_token);
            $social_email = $appleSignInPayload->getEmail();
            $social_id = $social_name = $appleSignInPayload->getUser();
        }
        catch(exception $e){
            $error_code    = 4;
            $error_message = $e;
        }
    }
    if (!empty($social_id)) {
    	$create_session = false;
    	if (Wo_EmailExists($social_email) === true) {
    		$create_session = true;
    	} else {
    		$str          = md5(microtime());
            $id           = substr($str, 0, 9);
            $user_uniq_id = (Wo_UserExists($id) === false) ? $id : 'u_' . $id;
            $password = rand(1111, 9999);
            $re_data      = array(
                'username' => Wo_Secure($user_uniq_id, 0),
                'email' => Wo_Secure($social_email, 0),
                'password' => Wo_Secure(md5($password), 0),
                'email_code' => Wo_Secure(md5(time()), 0),
                'first_name' => Wo_Secure($social_name),
                'src' => Wo_Secure($provider),
                'lastseen' => time(),
                'social_login' => 1,
                'active' => '1'
            );
            if (Wo_RegisterUser($re_data) === true) {
            	$create_session = true;
            }
    	}

    	if ($create_session == true) {
    		$user_id        = Wo_UserIdForLogin($social_email);
    		$time           = time();
            $cookie         = '';
            $access_token   = sha1(rand(111111111, 999999999)) . md5(microtime()) . rand(11111111, 99999999) . md5(rand(5555, 9999));
            $timezone       = 'UTC';
            $create_session = mysqli_query($sqlConnect, "INSERT INTO " . T_APP_SESSIONS . " (`user_id`, `session_id`, `platform`, `time`) VALUES ('{$user_id}', '{$access_token}', 'phone', '{$time}')");
            $add_timezone = mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `timezone` = '{$timezone}' WHERE `user_id` = {$user_id}");
            
            if (!empty($_POST['android_m_device_id'])) {
                $device_id  = Wo_Secure($_POST['android_m_device_id']);
                $update  = mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `android_m_device_id` = '{$device_id}' WHERE `user_id` = '{$user_id}'");
            }
            if (!empty($_POST['ios_m_device_id'])) {
                $device_id  = Wo_Secure($_POST['ios_m_device_id']);
                $update  = mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `ios_m_device_id` = '{$device_id}' WHERE `user_id` = '{$user_id}'");
            }
            if (!empty($_POST['android_n_device_id'])) {
                $device_id  = Wo_Secure($_POST['android_n_device_id']);
                $update  = mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `android_n_device_id` = '{$device_id}' WHERE `user_id` = '{$user_id}'");
            }
            if (!empty($_POST['ios_n_device_id'])) {
                $device_id  = Wo_Secure($_POST['ios_n_device_id']);
                $update  = mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `ios_n_device_id` = '{$device_id}' WHERE `user_id` = '{$user_id}'");
            }
            if ($create_session) {
                $response_data = array(
                    'api_status' => 200,
                    'timezone' => $timezone,
                    'access_token' => $access_token,
                    'user_id' => $user_id,
                );
            }
    	}
    }
}