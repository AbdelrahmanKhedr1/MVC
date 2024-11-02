<?php 
//$argv
if(php_sapi_name() == 'cli') {
    $str = $_SERVER['argv'];
    
    if($str[1] == 'storage:link') {
        if(symlink(__DIR__.'/storage/public', __DIR__.'/public/storage')){
            echo 'Storage is Linked '.PHP_EOL;
        }else{
            echo 'Storage already Linked '.PHP_EOL;
        }
    }
}