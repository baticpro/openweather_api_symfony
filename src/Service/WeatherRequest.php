<?php


namespace App\Service;


class WeatherRequest
{
    const API_URL = 'https://api.openweathermap.org/data/2.5/weather';
    const API_TOKEN = 'da00138950fd4c9c1cc07891e3a45ec1';

    private $lat;
    private $lng;
    private $city_id;
    private $query;
    private $lang;
    private $units;

    public function __construct(WeatherRequestBuilder $builder)
    {
        $this->lat = $builder->lat;
        $this->lng = $builder->lng;
        $this->city_id = $builder->city_id;
        $this->lang = $builder->lang;
        $this->query = $builder->query;
        $this->units = $builder->units ? $builder->units : 'metric';
    }

    public function fetch()
    {
        $url = self::API_URL . '?APPID=' . self::API_TOKEN . '&lang=' . $this->lang . '&units=' . $this->units;

        if($this->lat && $this->lng)
            $url .= '&lat=' . floatval($this->lat) . '&lon=' . floatval($this->lng);

        if($this->city_id)
            $url .= '&id=' . intval($this->city_id);

        if($this->query)
            $url .= '&q=' . urlencode($this->query);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, 1);
    }
}