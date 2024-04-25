<?php

namespace App\Controllers;

class mis_borradores extends BaseController {

    public function __construct() {
        helper('url');
    }

    public function index() {
        return view('vista_mis_borradores');
    }
}
