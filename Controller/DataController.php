<?php

/*
 * This file is part of the TecnoReady Solutions C.A. package.
 * 
 * (c) www.tecnoready.com
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tecnocreaciones\Vzla\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

/**
 * Description of DataController
 *
 * @author Carlos Mendoza <inhack20@gmail.com>
 */
class DataController extends FOSRestController
{
    public function getCitiesByParishAction($parishId)
    {    
//        $parishId = $request->get("parishId");
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository("Tecnocreaciones\Vzla\EntityBundle\Entity\City")->findCitiesByParish($parishId);
//        var_dump($data);
        $view = $this->view($data);
        $view->setFormat("json");
        $view->getSerializationContext()->setGroups(array('list'));
        return $this->handleView($view);
    }
    
    public function getParishesByMunicipalityAction($municipalityId)
    {    
        $em = $this->getDoctrine()->getManager();
        $states = $em->getRepository("Tecnocreaciones\Vzla\EntityBundle\Entity\Parish")->findByMunicipality($municipalityId);
        $view = $this->view($states);
        $view->setFormat("json");
        $view->getSerializationContext()->setGroups(array('list'));
        return $this->handleView($view);
    }
    
    public function getUrbanizationByCityAction($cityId,$parishId)
    {    
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository("Tecnocreaciones\Vzla\EntityBundle\Entity\Urbanization")->getUrbanizationByCity($cityId,$parishId);
        $view = $this->view($data);
        $view->setFormat("json");
        $view->getSerializationContext()->setGroups(array('list'));
        return $this->handleView($view);
    }
}
