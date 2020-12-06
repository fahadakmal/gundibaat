<?php
// +------------------------------------------------------------------------+
// | @author Monjur Munna
// | @author_url 1: https://imean.xyz
// | @author_url 2: https://imean.xyz/
// | @author_email: admin@imean.xyz   
// +------------------------------------------------------------------------+
// | iMean - Social Networking Website
// | Copyright (c) 2016 iMean. All rights reserved.
// +------------------------------------------------------------------------+
require 'assets/libraries/PHPMailer-Master/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer;