<?php
// +------------------------------------------------------------------------+
// | @author Monjur Munna
// | @author_url 1: https://imean.xyz
// | @author_url 2: https://worldum.com
// | @author_email: imeansocial@gmail.com   
// +------------------------------------------------------------------------+
// | imean - Social Network Website
// | Copyright (c) 2016 imean. All rights reserved.
// +------------------------------------------------------------------------+
require 'assets/libraries/PayPal/vendor/autoload.php';
$paypal = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
    $wo['config']['paypal_id'],
    $wo['config']['paypal_secret']
  )
);
$paypal->setConfig(
    array(
      'mode' => $wo['config']['paypal_mode']
    )
);