<?php
// +------------------------------------------------------------------------+
// | @author Monjur Munna
// | @author_url 1: https://imean.xyz
// | @author_url 2: https://worldum.com
// | @author_email: imeansocial@gmail.com
// +------------------------------------------------------------------------+
// | imean - Social Network Website
// | Copyright (c) 2018 imean. All rights reserved.
// +------------------------------------------------------------------------+
$response_data = array(
    'api_status' => 400
);
if (empty($_POST['password'])) {
    $error_code    = 4;
    $error_message = 'password (POST) is missing';
}
if (empty($error_code)) {
    $delete     = Wo_DeleteUser($wo['user']['user_id']);
    if ($delete) {
        $response_data = array(
            'api_status' => 200,
            'message' => "User successfully deleted."
        );
    }
}