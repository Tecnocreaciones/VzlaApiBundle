<?php

namespace Tecnocreaciones\Vzla\ApiBundle\EventListener;

use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

/**
 * Description of SerializeListerner
 *
 * @author Anais Ortega <adcom23@tecnocreaciones.com.ve>
 */
class SerializeEventListerner implements EventSubscriberInterface
{
    /**
     * 
     * @var Router
     */
    private $router;
    
    /**
     *
     * @var \Symfony\Bundle\FrameworkBundle\Translation\Translator
     */
    private $translator;
    
    public static function getSubscribedEvents() {
        return array(
            array('event' => Events::POST_SERIALIZE, 'method' => 'onPostSerializeCountry', 'class' => 'Tecnocreaciones\Vzla\EntityBundle\Entity\Country','format' => 'json'),
            array('event' => Events::POST_SERIALIZE, 'method' => 'onPostSerializeRegion', 'class' => 'Tecnocreaciones\Vzla\EntityBundle\Entity\Region','format' => 'json'),
            array('event' => Events::POST_SERIALIZE, 'method' => 'onPostSerializeState', 'class' => 'Tecnocreaciones\Vzla\EntityBundle\Entity\State','format' => 'json'),
            array('event' => Events::POST_SERIALIZE, 'method' => 'onPostSerializeCity', 'class' => 'Tecnocreaciones\Vzla\EntityBundle\Entity\City','format' => 'json'),
        );
    }
    
    /**
     * Captura el evento luego que se serealia un estado
     * @param \JMS\Serializer\EventDispatcher\ObjectEvent $event
     */
    function onPostSerializeState(ObjectEvent $event) {
        $object = $event->getObject();
        $event->getVisitor()->addData('_links', array(
            'self' => array(
                'href' => $this->generateUrl('api_tecnocreaciones_vzla_entity_state_show',array('id' => $object->getId()))
                ),
            'cities' => array(
                'href' => $this->generateUrl('api_tecnocreaciones_vzla_entity_state_cities',array('id' => $object->getId()))
                ),
        ));
    }
    
    /**
     * Captura el evento luego que se serealia una region
     * @param \JMS\Serializer\EventDispatcher\ObjectEvent $event
     */
    function onPostSerializeRegion(ObjectEvent $event) {
        $object = $event->getObject();
        $event->getVisitor()->addData('_links', array(
            'self' => array(
                'href' => $this->generateUrl('api_tecnocreaciones_vzla_entity_region_show',array('id' => $object->getId()))
                ),
        ));
    }
    
    /**
     * Captura el evento luego que se serealia un pais
     * @param \JMS\Serializer\EventDispatcher\ObjectEvent $event
     */
    function onPostSerializeCountry(ObjectEvent $event) {
        $object = $event->getObject();
        $event->getVisitor()->addData('_links', array(
            'self' => array(
                'href' => $this->generateUrl('api_tecnocreaciones_vzla_entity_country_show',array('id' => $object->getId()))
                ),
            'states' => array(
                'href' => $this->generateUrl('api_tecnocreaciones_vzla_entity_country_states',array('id' => $object->getId()))
                ),
            'regions' => array(
                'href' => $this->generateUrl('api_tecnocreaciones_vzla_entity_country_regions',array('id' => $object->getId()))
                ),
        ));
    }
    
    /**
     * Captura el evento luego que se serealia una ciudad
     * @param \JMS\Serializer\EventDispatcher\ObjectEvent $event
     */
    function onPostSerializeCity(ObjectEvent $event) {
        $object = $event->getObject();
        $event->getVisitor()->addData('_links', array(
            'self' => array(
                'href' => $this->generateUrl('api_tecnocreaciones_vzla_entity_city_show',array('id' => $object->getId()))
                ),
        ));
    }
    
    protected function  generateUrl($route,array $parameters){
        return $this->router->generate($route, $parameters, Router::ABSOLUTE_URL);
    }
    public function setRouter(Router $router) {
        $this->router = $router;
    }
    
    public function getTranslator() {
        return $this->translator;
    }

    public function setTranslator(\Symfony\Bundle\FrameworkBundle\Translation\Translator $translator) {
        $this->translator = $translator;
    }
}
