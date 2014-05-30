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

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * API Rest Country
 *
 * @author Carlos Mendoza <inhack20@tecnocreaciones.com>
 */
class CountryController extends \Tecnocreaciones\Bundle\ResourceBundle\Controller\ResourceController
{
    /**
     * This is the documentation description of your method, it will appear
     * on a specific pane. It will read all the text until the first
     * annotation.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="List all countries registered",
     *  filters={
     *      {"name"="limit", "dataType"="integer"},
     *      {"name"="page", "dataType"="integer"},
     *      {"name"="another-filter", "dataType"="string", "pattern"="(foo|bar) ASC|DESC"}
     *  }
     * )
     */
    public function indexAction(\Symfony\Component\HttpFoundation\Request $request) {
        return parent::indexAction($request);
    }
    
    /**
     * This is the documentation description of your method, it will appear
     * on a specific pane. It will read all the text until the first
     * annotation.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="This is a description of your API method",
     *  filters={
     *      {"name"="a-filter", "dataType"="integer"},
     *      {"name"="another-filter", "dataType"="string", "pattern"="(foo|bar) ASC|DESC"}
     *  }
     * )
     */
    public function showAction(\Symfony\Component\HttpFoundation\Request $request) {
        $view = $this
            ->view()
            ->setTemplate($this->config->getTemplate('show.html'))
            ->setTemplateVar($this->config->getResourceName())
            ->setData($this->findOr404($request))
        ;
        $view->getSerializationContext()->setGroups(array('country'));
        return $this->handleView($view);
    }
    
    function getCountriesStatesAction(\Symfony\Component\HttpFoundation\Request $request) {
        $resource = $this->findOr404($request);
        $view = $this
            ->view()
            ->setTemplate($this->config->getTemplate('states.html'))
            ->setTemplateVar('states')
            ->setData($resource->getStates())
        ;
        $view->getSerializationContext()->setGroups('country');
        return $this->handleView($view);
    }
    
    function getCountriesRegionsAction(\Symfony\Component\HttpFoundation\Request $request) {
        $resource = $this->findOr404($request);
        $view = $this
            ->view()
            ->setTemplate($this->config->getTemplate('regions.html'))
            ->setTemplateVar('regions')
            ->setData($resource->getRegions())
        ;
        $view->getSerializationContext()->setGroups('country');
        return $this->handleView($view);
    }
}
