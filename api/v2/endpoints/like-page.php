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
    'api_status' => 400,
);
if (empty($_POST['page_id'])) {
    $error_code    = 3;
    $error_message = 'page_id (POST) is missing';
}
if (empty($error_code)) {
    $page_id   = Wo_Secure($_POST['page_id']);
    $page_data = Wo_PageData($page_id);
    if (empty($page_data)) {
        $error_code    = 6;
        $error_message = 'Page not found';
    } else {
    	$like_message = 'invalid';
        if (Wo_IsPageLiked($page_id, $wo['user']['user_id']) === true) {
            if (Wo_DeletePageLike($page_id, $wo['user']['user_id'])) {
                $like_message = 'unliked';
            }
        } else {
            if (Wo_RegisterPageLike($page_id, $wo['user']['user_id'])) {
                $like_message = 'liked';
            }
        }
        $response_data = array(
		    'api_status' => 200,
		    'like_status' => $like_message
		);
    }
}