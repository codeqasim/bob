<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

DEBUG - 2019-04-02 17:16:31 --> UTF-8 Support Enabled
DEBUG - 2019-04-02 17:16:31 --> No URI present. Default controller set.
DEBUG - 2019-04-02 17:16:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2019-04-02 17:16:32 --> Config file loaded: E:\server\htdocs\bob\application\config/theme.php
ERROR - 2019-04-02 17:16:38 --> Severity: Warning --> file_get_contents(http://localhost/api/api/global/countries?token=123): failed to open stream: HTTP request failed! HTTP/1.0 500 Internal Server Error
 E:\server\htdocs\bob\application\controllers\Home.php 14
ERROR - 2019-04-02 17:16:38 --> Severity: Notice --> Trying to get property 'data' of non-object E:\server\htdocs\bob\application\controllers\Home.php 14
ERROR - 2019-04-02 17:16:38 --> Severity: error --> Exception: Call to undefined method Home::getOTAdata() E:\server\htdocs\bob\application\controllers\Home.php 15
