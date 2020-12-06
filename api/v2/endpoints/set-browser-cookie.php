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
if (!empty(Wo_GetUserFromSessionID($_GET['access_token']))) {
	$cookie = Wo_Secure($_GET['access_token']);
	$_SESSION['user_id'] = $cookie;
	setcookie("user_id", $cookie, time() + (10 * 365 * 24 * 60 * 60));
	header("Location: " . Wo_SeoLink('index.php?link1=get_news_feed'));
	exit();
}