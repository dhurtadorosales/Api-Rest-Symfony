<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends FOSRestController
{
    /**
     * @Rest\Get("/availabilities", name="get_availabilities", options={"method_prefix"=false})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getDataAction(Request $request)
    {
        $data = $this->getDoctrine()->getRepository('AppBundle:Availability')
            ->getAvailabilities(
                $request->query->get('start'),
                $request->query->get('length'),
                $request->query->get('search')['value']
            );

        $values = [];
        foreach ($data as $item) {
            array_push($values, [
                'id' => $item->getId(),
                'date' => $item->getDate()->format('Y-m-d'),
                'time' => $item->getTime()->format('H:i:s'),
            ]);
        }



        $result = [
            'draw' => $request->query->get('draw'),
            'recordsTotal' => count($values),
            'recordsFiltered' => $request->query->get('length'),
            'data' => $values
        ];

        $view = $this->view($result, 200);

        return $this->handleView($view);
    }
}
