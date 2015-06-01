<?php

/*
 * This file is part of the TecnoCreaciones package.
 * 
 * (c) www.tecnocreaciones.com.ve
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tecnocreaciones\Vzla\ApiBundle\Controller;

/**
 * Description of CityController
 *
 * @author Carlos Mendoza <inhack20@tecnocreaciones.com>
 */
class CityController extends \Tecnocreaciones\Bundle\ResourceBundle\Controller\ResourceController
{
    public function indexAction(\Symfony\Component\HttpFoundation\Request $request) {
        $resources = $this->getRepository()->findBy(array(
            "active" => true,
        ));
        $view = $this
            ->view()
            ->setTemplateVar($this->config->getResourceName())
            ->setData($resources)
        ;
        //$view->getSerializationContext()->setGroups('state');
        return $this->handleView($view);
    }
    public function getCitiesByMunicipalityAction($municipalityId)
    {    
        $em = $this->getDoctrine()->getManager();
        $states = $em->getRepository("Tecnocreaciones\Vzla\EntityBundle\Entity\City")->findCitiesByMunicipality($municipalityId);
        $view = $this->view($states);
        $view->getSerializationContext()->setGroups(array('list'));
        return $this->handleView($view);
    }
}
