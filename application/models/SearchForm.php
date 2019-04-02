<?php

include_once 'Guests.php';

class SearchForm
{
    public $slug;
    public $packageDate;
    public $guests;
    public $ota_id;

    public function __construct()
    {
        $this->guests = new Guests();
        $this->packageDate = date('Y-m-d');
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getText()
    {
        $text = str_replace('-', ' ', $this->slug);
        return ucwords($text);
    }

    public function populate($params)
    {
        $this->slug = $params[0];
        $this->packageDate = $params[1];
        $this->guests->adult = $params[1];
        $this->guests->child = $params[3];
    }

    public function toArray()
    {
        return (array) $this;
    }

    public function defaultLocationOption()
    {
        $text = ucwords(str_replace("-", " ", $this->slug));
        return "<option value='".$this->slug."'>".$text."</option>";
    }

    public function getLocationsDd()
    {
        $CI =& get_instance();
        $CI->load->helper('form');

        $response = json_decode(file_get_contents(APPURL . "ota/packages/locations?ota_id={$this->ota_id}"));

        $options = array();
        foreach ($response->data as $data) {
            $options[$data->id] = $data->text;
        }

        return form_dropdown('slug', $options, $this->slug, 'id="locations"');
    }

    public function detailPageLink($data)
    {
        return base_url("packages/detail/".$data->package_tour_id);
    }
}
