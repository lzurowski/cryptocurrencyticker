<?php
namespace lib;

class ShellPrint{

    const RED = '\033[91m';
    const GREEN = '\033[92m';
    const YELLOW = '\033[93m';
    const BLUE = '\033[34m';
    const WHITE = '\033[97m';
    const CYAN = '\033[96m';
    
    public static function color($str, $color){
        return $color.$str.'\033[0m';
    }

    public static function echo($str){
        system('echo "'.$str.'"');
    }

}