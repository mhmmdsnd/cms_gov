<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/18/2017
 * Time: 1:57 PM
 */
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
        $ci->lang->load('message','english');
    }
}