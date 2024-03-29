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
$articles = array();

$options['limit'] = (!empty($_POST['limit'])) ? (int) $_POST['limit'] : 25;
$options['offset'] = (!empty($_POST['offset'])) ? (int) $_POST['offset'] : 0;
$options['user_id'] = (!empty($_POST['user_id'])) ? (int) $_POST['user_id'] : 0;
$options['category'] = (!empty($_POST['category'])) ? (int) $_POST['category'] : false;
$options['id'] = (!empty($_POST['article_id'])) ? (int) $_POST['article_id'] : 0;

$get_articles = Wo_GetBlogs($options);

foreach ($get_articles as $key => $article) {
    foreach ($non_allowed as $key => $value) {
       unset($article['author'][$value]);
    }
    $article['category'] = $wo['page_categories'][$article['category']];
    $article['posted'] = Wo_Time_Elapsed_String($article['posted']);
    $articles[] = $article;
}

$response_data = array(
    'api_status' => 200,
    'articles' => $articles
);