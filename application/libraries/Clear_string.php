<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clear_string
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function clear_quotes($string)
    {
        $text1 = htmlentities($string);
        $text2 = str_replace("'", "&#39", $text1);
        $text3 = preg_replace('~[\r\n]+~', '\n', $text2);
        $text4 = str_replace("%20", " ", $text3);
        $text5 = str_replace("+", "&#43;", $text4);
        $text6 = str_replace("-", "&#45;", $text5);
        $text7 = str_replace("/", "&#47;", $text6);
        $text8 = str_replace("(", "&#40;", $text7);
        $text9 = str_replace(")", "&#41;", $text8);
        $text10 = str_replace("[", "&#91;", $text9);
        $text11 = str_replace("]", "&#93;", $text10);
        $text12 = str_replace("=", "&#61;", $text11);
        $clear_text = $text12;

        return  $clear_text;
    }
}
