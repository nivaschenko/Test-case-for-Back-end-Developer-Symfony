<?php

namespace AppBundle\Services\Domain;

interface IDomainService
{
    public function getDomainByParams($params);
    public function getDomainsByParams($params);
    public function getDomainByName($name);
    public function saveDomain($domain);
    public function createDomain($params);
}
