<?php

namespace App\Controller;

use App\Service\WeatherBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $builder = new WeatherBuilder();

        if ($request->query->get('city_id'))
            $builder->addCity($request->query->get('city_id'));

        if ($request->query->get('coords'))
            $builder->addCoords($request->query->get('coords'));

        if ($request->query->get('q'))
            $builder->addQuery($request->query->get('q'));

        if(!$builder->isEmpty())
            $builder->addQuery('Moscow');

        $weather = $builder->build()->fetch();

        if(empty($weather['weather']))
            throw new NotFoundHttpException();

        return $this->render('main/index.html.twig', [
            'description' => $weather['weather'][0]['description'],
            'name' => $weather['name'],
            'temp' => $weather['main']['temp'],
            'pressure' => $weather['main']['pressure'],
            'humidity' => $weather['main']['humidity'],
            'clouds' => $weather['clouds']['all'],
            'wind' => $weather['wind']['speed'],
            'icon' => $weather['weather'][0]['icon']
        ]);
    }
}
