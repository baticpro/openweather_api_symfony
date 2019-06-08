<?php


namespace App\Service;


class WeatherBuilder
{
    public $lat;
    public $lng;
    public $city_id;
    public $lang;
    public $query;
    public $units;

    public function __construct($lang = 'ru')
    {
        $this->lang = $lang;
    }

    public function addCoords($coords)
    {
        $ll = explode(',', $coords);
        $this->lat = $ll[0];
        $this->lng = $ll[1];

        return $this;
    }

    public function addUnits($units)
    {
        $this->units = $units;
        return $this;
    }

    public function addCity($city_id)
    {
        $this->city_id = $city_id;
        return $this;
    }

    public function addQuery($query)
    {
        $this->query= $query;
        return $this;
    }

    public function isEmpty()
    {
        return $this->city_id || $this->lat || $this->query;
    }

    public function build(): Weather
    {
        return new Weather($this);
    }
}