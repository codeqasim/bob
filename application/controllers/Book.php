<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Book extends MY_Controller {
    public function index() {
        $this->theme->view('modules/hotels/confirmation');
    }

    public function status() {
        $this->theme->view('modules/hotels/status');
    }
}
