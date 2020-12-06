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
require 'assets/libraries/PHPMailer-Master/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer;