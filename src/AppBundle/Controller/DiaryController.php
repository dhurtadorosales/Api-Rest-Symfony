<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class DiaryController extends FOSRestController
{
    /**
     * @Rest\Get("/{id}", name="get_diary", options={"method_prefix"=false})
     *
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getDataAction(Request $request, User $user)
    {
        $data = $this->getDoctrine()->getRepository('AppBundle:Diary')
            ->getDiaryByUser($user);

        $values = [];
        foreach ($data as $item) {
            array_push($values, [
                'id' => $item->getId(),
                'description' => $item->getDescription(),
                'availability' => $item->getAvailability()
            ]);
        }

        $result = [
            'draw' => $request->query->get('draw'),
            'recordsTotal' => count($values),
            'data' => $values
        ];

        $view = $this->view($result, 200);

        return $this->handleView($view);
    }
}
