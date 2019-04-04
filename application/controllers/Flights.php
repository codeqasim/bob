<?php

class Flights extends  MY_Controller
{


    public function __construct()
    {
        parent::__construct();
    }


    public function index() {
        $data['metas'] =  flights();
        $data['title'] = "Flights result";
        $data['tag'] = "find the best result of your flights research";
        render('front/flights/list', $data);
    }


}