<?php


namespace App\Tests;

use App\Service\WeatherRequestBuilder;
use PHPUnit\Framework\TestCase;

class WeatherRequestTest extends TestCase
{
    public function testQuery()
    {
        $builder = new WeatherRequestBuilder();
        $builder->addQuery('Moscow');
        $w = $builder->build()->fetch();

        $this->assertArrayHasKey('weather', $w);
    }

    public function testLocation()
    {
        $builder = new WeatherRequestBuilder();
        $builder->addCoords('44,24');
        $w = $builder->build()->fetch();

        $this->assertArrayHasKey('weather', $w);
    }

    public function testId()
    {
        $builder = new WeatherRequestBuilder();
        $builder->addCity(2172797);
        $w = $builder->build()->fetch();

        $this->assertArrayHasKey('weather', $w);
    }
}