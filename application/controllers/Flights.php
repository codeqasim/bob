<?php

class Flights extends  MY_Controller
{


    public function __construct()
    {
        parent::__construct();
    }


    public function list() {
        $data['metas'] =  flights();
        $data['title'] = "Flights result";
        $data['tag'] = "find the best result of your flights research";
        render('front/flights/list', $data);
    }

    public function book() {
        $data['metas'] =  flights();
        $data['title'] = "Flights Booking";
        $data['tag'] = "find the best result of your flights research";
        render('front/flights/book', $data);
    }


}