<?php

/*
 * This file is part of the TecnoCreaciones package.
 * 
 * (c) www.tecnocreaciones.com
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tecnocreaciones\Vzla\ApiBundle\Controller;

/**
 * Controlador de municipios
 *
 * @author Carlos Mendoza <inhack20@tecnocreaciones.com>
 */
class MunicipalityController extends \Tecnocreaciones\Bundle\ResourceBundle\Controller\ResourceController
{
    function getMunicipalitiesByStateAction($stateId)
    {
        $em = $this->getDoctrine()->getManager();
        $municipalities = $em->getRepository("Tecnocreaciones\Vzla\EntityBundle\Entity\Municipality")->findMunicipalitiesByState($stateId);
        $view = $this->view($municipalities);
        return $view;
    }
}
