<?php 


function setmessage($message,$type = 'success'){
    $_SESSION['msg']['content'] = $message;
    $_SESSION['msg']['type'] = $type;
}