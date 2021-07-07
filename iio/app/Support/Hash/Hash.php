<?php 


class Hash {

    public function createObjHash(){
        return strtoupper(substr(sha1(md5(time()*20*10)),  0, 16));
    }

    public function createUniqHash(){
        $s1 = $this->createObjHash();
        $s2 = $this->createObjHash();
        $s3 = $this->createObjHash();

        return strtoupper(substr(sha1( base64_encode($s3) . sha1($s1) . md5(time()*20*10) . $s2),  0, 16));
    }

}