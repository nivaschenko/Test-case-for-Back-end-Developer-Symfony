<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\BadDomains;

class DomainController extends Controller
{
    public function indexAction()
    {
        $domainServise = $this->get('domain_service');
        $serializer = $this->get('serializer');
        $json = $serializer->serialize(
            $domainServise->getDomainsByParams(), 'json');
        return $this->render('default/bad_domains.html.twig', 
                array('badDomain' => $json,));
    }
    
    public function saveAction(Request $request)
    {
        $domain = new BadDomains();
        
        $form = $this->createFormBuilder($domain)
            ->add('name', TextType::class, 
                ['label' => 'Add Bad Domain', 'required' => true, 'attr' => ['placeholder' => 'badDomain.com']])
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $domain = $form->getData();
            $domainService = $this->get('domain_service');
            $domainService->saveDomain($domain);

            return $this->redirectToRoute('domains');
        }

        return $this->render('default/add_bad_domain.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}