<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2/26/2019
 * Time: 10:21 PM
 */

class Tour
{
    private $name;
    private $stars;
    private $location;
    private $description;
    private $cancellation_policy;
    private $inclusive_amenities = [];
    private $exclusive_amenities = [];
    private $gallery;
    private $images_path;
    private $itenraries = [];
    private $travler = [];

    public function load($tour_id, $ota_id)
    {
        $response = json_decode(file_get_contents(APPURL . "ota/packages/tour_detail?package_tour_id={$tour_id}&ota_id={$ota_id}"));

//        echo '<pre>';
//        print_r($response);
//        die();

        if (! empty($response->data))
        {
            $this->name = $response->data->name;
            $this->stars = $response->data->stars;
            $this->location = $response->data->location_name;
            $this->description = $response->data->description;
            $this->cancellation_policy = $response->data->cancellation_policy;
            $this->inclusive_amenities = $response->data->inclusive_amenities;
            $this->exclusive_amenities = $response->data->exclusive_amenities;
            $this->gallery = $response->data->gallery;
            $this->images_path = $response->data->images_path.$response->data->supplier_id.'/%s/';
            $this->setItineraries($response->data);
            $this->setTravler($response->data);
        }

        return $this;
    }

    public function setTravler($data)
    {
        array_push($this->travler, (object) array(
            "type" => "Adult",
            "quantity" => $data->maxadult,
            "price" => $data->adultprice,
        ));

        array_push($this->travler, (object) array(
            "type" => "Child",
            "quantity" => $data->maxchild,
            "price" => $data->childprice,
        ));

        array_push($this->travler, (object) array(
            "type" => "Infant",
            "quantity" => $data->maxinfant,
            "price" => $data->infantprice,
        ));
    }

    public function getTravlerPriceDetails()
    {
        return $this->travler;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStars()
    {
        $html = '<small>';
        for ($i = 0; $i < $this->stars; $i++) {
            $html .= '<i class="fa fa-star text-warning"></i> ';
        }
        $html .= '</small>';
        return $html;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCancellationPolicy()
    {
        return $this->cancellation_policy;
    }

    public function getInclusiveAmenities()
    {
        return $this->inclusive_amenities;
    }

    public function getExclusiveAmenities()
    {
        return $this->exclusive_amenities;
    }

    public function getGallery()
    {
        foreach ($this->gallery as &$gallery) {
            $gallery = $this->images_path.$gallery->image;
        }

        return $this->gallery;
    }

    public function getProfilePicture()
    {
        foreach ($this->gallery as $gallery) {
            if ($gallery->flag_thumbnail) {
                return sprintf($this->images_path.$gallery->image, 'main');
            }
        }
    }

    public function setItineraries($data)
    {
        $data->itinerary_title = json_decode($data->itinerary_title);
        $data->itinerary_description = json_decode($data->itinerary_description);
        $data->itinerary_images = json_decode($data->itinerary_images);
        for ($i = 0; $i < count($data->itinerary_title); $i++) {
            array_push($this->itenraries, (object) array(
                "title" => $data->itinerary_title[$i],
                "description" => $data->itinerary_description[$i],
                "image" => sprintf($this->images_path.$data->itinerary_images[$i], 'main'),
            ));
        }
    }

    public function getItineraries()
    {
        return $this->itenraries;
    }
}
