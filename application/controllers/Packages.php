<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Packages extends MY_Controller {
    public $slug;
    public $packageDate;
    public $adult;
    public $child;

    public function __construct()
    {
        parent::__construct();
        $this->slug = "";
        $this->packageDate = date("Y-m-d");
        $this->adult = 2;
        $this->child = 0;
    }

    public function index()
    {
        $data["otadata"] = $this->getOTAdata();
        $this->theme->view('modules/packages/details', $data);
    }

    public function _list()
    {
        $data["otadata"] = $this->getOTAdata();
        $this->theme->view('modules/packages/list', $data);
    }

    public function search(...$params)
    {
        $this->load->model('SearchForm');
        $searchForm = new SearchForm();
        if (empty($params)) {
            $searchForm->slug = $this->slug;
            $searchForm->packageDate = $this->packageDate;
            $searchForm->guests->adult = $this->adult;
            $searchForm->guests->child = $this->child;
        } else {
            $searchForm->populate($params);
        }

        $data["title"] = "Packages";
        $data["otadata"] = $this->getOTAdata();
        $searchForm->ota_id = $data["otadata"]->ota->ota_id;
        log_message('debug', 'Calling packages search api');
        log_message('debug', '[API_URL]: ' . APPURL . 'ota/packages/search');
        log_message('debug', '[PAYLOAD]: ' . json_encode($searchForm));
        $response = json_decode(server_request($searchForm, APPURL . 'ota/packages/search'));
        log_message('debug', '[API RESPONSE]: ' . json_encode($response));
        $data["package"]["data"] = $response->data;
        $data["package"]["count"] = count($response->data);
        $data["searchForm"] = $searchForm;
        $this->theme->view('modules/packages/list', $data);
    }

    public function detail($tour_id) {
        $data["otadata"] = $this->getOTAdata();
        $data["title"] = "Packages";
        $data['tour_id'] = $tour_id;
        $ota_id = $data["otadata"]->ota->ota_id;
        $this->load->model('Tour');
        $tour = new Tour();
        $data['tour'] = $tour->load($tour_id, $ota_id);
        $this->theme->view('modules/packages/detail', $data);
    }

    public function booking() {
        $this->theme->view('modules/packages/booking', null);
    }

    public function typeahead()
    {
        $ota_id = $this->getOTAdata()->ota->ota_id;
        $query = $this->input->get('q');
        $response = json_decode(file_get_contents(APPURL . "ota/packages/locations?q={$query}&ota_id={$ota_id}"));
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($response->data));
    }
}
