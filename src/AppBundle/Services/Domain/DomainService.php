<?php

namespace AppBundle\Services\Domain;

use AppBundle\Services\Domain\IDomainService;
use AppBundle\Entity\BadDomains;

class DomainService implements IDomainService
{
    private $container;

    public function __construct($container) 
    {
        $this->container = $container;
    }
    
    public function getDomainByParams($params = [])
    {
        try {
            $em = $this->container->get('doctrine')->getManager();
            $clickRepository = $em->getRepository('AppBundle:BadDomains');
            $result = $clickRepository->findOneBy($params);
        } catch ( \Exception $ex ) {
            return $ex;
        }
        return $result;
    }
    
    public function getDomainByName($name)
    {
        try {
            $em = $this->container->get('doctrine')->getManager();
            $clickRepository = $em->getRepository('AppBundle:BadDomains');
            $result = $clickRepository->findLikeName($name);
        } catch (Exception $ex) {
            return $ex;
        }
        return $result;
    }


    public function getDomainsByParams($params = [])
    {
        try {
            $em = $this->container->get('doctrine')->getManager();
            $clickRepository = $em->getRepository('AppBundle:BadDomains');
            $result = $clickRepository->findBy($params);
        } catch ( \Exception $ex ) {
            return $ex;
        }
        return $result;
    }
    
    public function saveDomain($domain)
    {
        if ( !($domain instanceof BadDomains) ) {
            $domain = $this->createDomain($domain);
        }
        try {
            $em = $this->container->get('doctrine')->getManager();
            $em->persist($domain);
            $em->flush();
        } catch (\Exception $ex) {
            return $ex;
        }
        return $domain;
    }
    
    public function createDomain($params)
    {
        try {
            if ( !is_array($params) ) {
                throw new \Exception('Params are missing for the BadDomains entity');
            }
            $domain = new BadDomains();
            $domain->setName($params['name']);
            
            $validator = $this->container->get('validator');
            $errors = $validator->validate($domain);

            if (count($errors) > 0) {
                throw new \Exception((string)$errors);
            }
        } catch (\Exception $ex) {
            return $ex;
        }
        return $domain;
    }
}

