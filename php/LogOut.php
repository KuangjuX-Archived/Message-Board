<?php
session_start();
session_destroy();
echo "<script>alert(`登出成功`)</script>";
echo "<script>setTimeout(function () {
        window.location.href=`../index.html`;},500);</script>";