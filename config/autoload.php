<?php

function loader($class_name){
    // $dir_path = __DIR__;
    // $dirname = dirname($dir_path);
    $file_path = "model/$class_name.php";
    require($file_path);
}
spl_autoload_register("loader");