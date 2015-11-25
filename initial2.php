
<?php
if (!$socket = @fsockopen("192.168.1.122", 80, $errno, $errstr, 30)) 
    { echo "Offline!"; } 
    else 
    { echo "Online!"; 
    fclose($socket);} 
?>
