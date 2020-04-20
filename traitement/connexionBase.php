<?php
    $db_handle =new mysqli('localhost','root','','ebay ece');
    mysqli_set_charset($db_handle, 'utf8');
    mb_internal_encoding('UTF-8');
    mb_http_output('UTF-8');
    mb_http_input('UTF-8');
    mb_regex_encoding('UTF-8');
?>