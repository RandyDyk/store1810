<?php
    // echo 123;
    class wechatTestConnect
    {
        public function volid()
        {

        }
        //检测是不是正确的
        public function checkSignature()
        {
            $signature=$_GET['signature'];
            $timestamp=$_GET['timestamp'];
            $nonce=$_GET['nonce'];
            // tmpArr=array(timestamp,$nonce);

        }
    }
?>