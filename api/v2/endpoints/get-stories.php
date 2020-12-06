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
$stories = array();

$options['limit'] = (!empty($_POST['limit'])) ? (int) $_POST['limit'] : 35;
$options['api'] = true;

$get_all_stories = Wo_GetFriendsStatus($options);

foreach ($get_all_stories as $key => $one_story) {
    $get_stories = Wo_GetStroies(array('id' => $one_story['id']));
	foreach ($get_stories as $key => $story) {
        foreach ($non_allowed as $key => $value) {
           unset($story['user_data'][$value]);
        }
        if (!empty($story['thumb']['filename'])) {
            $story['thumbnail'] = $story['thumb']['filename'];
            unset($story['thumb']);
        } else {
            $story['thumbnail'] = $story['user_data']['avatar'];
        }
        $stories[] = $story;
    }
}

$response_data = array(
    'api_status' => 200,
    'stories' => $stories
);