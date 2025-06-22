<?php
require(dirname(__File__) . "/../../lib/session.php");
Session::destroy(true);

 echo "<script>
 localStorage.removeItem('isLogin');
 window.location.href = '/duanweb2/homepage';
</script>";
exit();