<?php 


class Console {

    public function title(){
        echo ("\n\033[93m======================\n\nInstanceIO CL Tool\n\n======================\033\n");
    }

    public function error($message){
        echo ("\n\033[31m$message \033[0m\n\n");
    }

    public function success($message){
        echo ("\n\033[32m$message \033[0m\n\n");
    }

    public function info($message){
        echo ("\n\033[36m$message \033[0m\n\n");
    }

    public function desc($title){
        echo ("\n\033[34mCOMMAND: $title\033[0m\n");
    }

    public function line($message){
        echo ("\n\n$message\n");
    }

}