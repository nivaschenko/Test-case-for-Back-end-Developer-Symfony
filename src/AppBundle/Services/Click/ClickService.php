<?php

namespace AppBundle\Services\Click;

use Sinergi\Token\StringGenerator;
use Symfony\Bridge\Monolog\Logger;
use AppBundle\Entity\Click;
use Exception;

class ClickService
{
    private $logger;
    private $container;

    public function __construct($container) 
    {
        $this->logger = new Logger(__CLASS__);
        $this->container = $container;
    }
    
    public function createClick($params)
    {
        try {
            if ( !is_array($params) ) {
                $this->logger->error('Params are missing ');
                throw new \Exception('Params are missing for the click');
            }
            $click = new Click();
            $validator = $this->container->get('validator');

            $click->setId(StringGenerator::randomUuid())
                ->setIp($params['ip'])
                ->setUa($params['ua'])
                ->setRef($params['ref'])
                ->setParam1($params['param1'])
                ->setParam2($params['param2'])
                ->setBadDomain($params['bad_domain'])
                ->setError($params['error']);

            $errors = $validator->validate($click);

            if (count($errors) > 0) {
                $this->logger->error((string)$errors);
                throw new \Exception((string)$errors);
            }
        } catch (\Exception $e) {
            return $e;
        }
        
        return $click;
    }

    public function save($click)
    {
        if ( !($click instanceof Click) ) {
            $click = $this->createClick($click);
        }
        try {
            $em = $this->container->get('doctrine')->getManager();
            $em->persist($click);
            $em->flush();
        } catch (\Exception $e) {
            return $e;
        }
        return $click;
    }
    
    public function getClickByParams($params = [])
    {
        try {
            $em = $this->container->get('doctrine')->getManager();
            $clickRepository = $em->getRepository('AppBundle:Click');
            $result = $clickRepository->findOneBy($params);
        } catch ( \Exception $e ) {
            return $e;
        }
        return $result;
    }
    
    public function getClicksByParams($params = [])
    {
        try {
            $em = $this->container->get('doctrine')->getManager();
            $clickRepository = $em->getRepository('AppBundle:Click');
            $result = $clickRepository->findBy($params);
        } catch ( \Exception $e ) {
            return $e;
        }
        return $result;
    }
}