<?php
    function xml($name='')
    {
        return $name['name'];
    }

    function remo($str){
        return preg_replace("'<script(.*?)<\/script>'is","",$str);
    }