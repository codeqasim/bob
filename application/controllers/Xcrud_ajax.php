<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Xcrud_ajax extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {   
        $this->load->library('session');
        $this->load->helper(array('url', 'xcrud'));
        $this->output->set_output(Xcrud::get_requested_instance());
    }
}

/* End of file xcrud_ajax.php */
/* Location: ./application/controllers/xcrud_ajax.php */
