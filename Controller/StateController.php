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
 * Description of StateController
 *
 * @author Carlos Mendoza <inhack20@tecnocreaciones.com>
 */
class StateController extends \Tecnocreaciones\Bundle\ResourceBundle\Controller\ResourceController
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
        $view->getSerializationContext()->setGroups('list');
        return $this->handleView($view);
    }
    
    function getStateCitiesAction(\Symfony\Component\HttpFoundation\Request $request) {
        $resource = $this->findOr404($request);
        $view = $this
            ->view()
            ->setTemplate($this->config->getTemplate('stateCities.html'))
            ->setTemplateVar($this->config->getResourceName())
            ->setData($resource->getCities())
        ;
        $view->getSerializationContext()->setGroups('list');
        return $this->handleView($view);
    }
}
