<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Portal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->library('user_agent');

        if ($this->agent->is_browser() == true && $this->agent->platform() != "Android" && (strpos($this->agent->platform(), "Windows") !== true || strpos($this->agent->platform(), "Mac") !== true)) {
            redirect("login");
            //echo "desktop";
        } elseif ($this->agent->is_robot()) {
            echo "Sorry no access for robot";
        } elseif ($this->agent->is_mobile()) {
            redirect("mobilelogin");
            //echo "mobile";
        } else {
            //redirect("login");
            echo "Sorry no access for unknows system";
        }

        //echo $this->agent->is_mobile();
        //echo $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)
    }
}
