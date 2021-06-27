<?php 


class Hash {

    public function createObjHash(){
        return strtoupper(substr(sha1(md5(time()*20*10)),  0, 16));
    }

}