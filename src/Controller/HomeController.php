<?php

namespace App\Controller;

use App\Manager\InsuranceManager;

class HomeController{

    public function homePage(){

        require_once("views/home_page.php");
    }
}