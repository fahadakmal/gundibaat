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
$products = array();

$options['limit'] = (!empty($_POST['limit'])) ? (int) $_POST['limit'] : 35;
$options['id'] = (!empty($_POST['id'])) ? (int) $_POST['id'] : 0;
$options['offset'] = (!empty($_POST['offset'])) ? (int) $_POST['offset'] : false;
$options['genre'] = (!empty($_POST['genre'])) ? $_POST['genre'] : false;
$options['country'] = (!empty($_POST['country'])) ? $_POST['country'] : false;

$movies = Wo_GetMovies($options);

$response_data = array(
    'api_status' => 200,
    'movies' => $movies
);