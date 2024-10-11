<?php

if (!function_exists('helloWorld')) {
    function helloWorld()
    {
        echo 'welcome to helper function';
        log_message('info', 'helloWorld function is called.');
    }
}
