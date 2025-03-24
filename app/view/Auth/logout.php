<?php
require(dirname(__File__) . "/../../lib/session.php");
Session::destroy(true);
header('Location: login');
exit();