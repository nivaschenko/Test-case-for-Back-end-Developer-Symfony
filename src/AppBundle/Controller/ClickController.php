<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Services\Click\ClickService;

class ClickController extends Controller
{
    public function saveAction(Request $request)
    {
        $params = ['ip' => $request->getClientIp(),
            'ref' => $request->headers->get('referer'),
            'param1' => $request->query->get('param1'),
            'ua' => $request->headers->get('User-Agent')];
        
        $clickServise = $this->get('click_service');
        
        $click = $clickServise->getClickByParams($params);
        if ( $click instanceof \AppBundle\Entity\Click) {
            $click->setError($click->getError() + 1);
            $clickServise->save($click);
            return $this->redirectToRoute('error_click', array('id' => $click->getId()));
        }
        $params['param2'] = $request->query->get('param2');
        
        if ( $this->isBadDomain($params['ref']) ) {
            $params['error'] = 1;
            $params['bad_domain'] = 1;
            $click = $clickServise->save($params);
            if ($click instanceof \Exception) {
                return $this->render('default/error_page.html.twig', [
                    'data' => $click->getMessage()
                ]);
            }
            return $this->redirectToRoute('error_click', array('id' => $click->getId()));
        }
        
        $click = $clickServise->save($params);
        if ($click instanceof \Exception) {
            return $this->render('default/error_page.html.twig', [
                'data' => $click->getMessage()
            ]);
        }
        return $this->redirectToRoute('success_click', array('id' => $click->getId()));
    }
    
    public function indexAction()
    {
        $clickServise = $this->get('click_service');
        $result = $clickServise->getClicksByParams();
        if ( $result instanceof \Exception ) {
            return $this->render('default/index.html.twig', [
                'data' => $click->getMessage()
            ]);
        }
        $serializer = $this->get('serializer');
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'data' => $serializer->serialize($result, 'json'),
        ]);
    }
    
    private function isBadDomain($ref)
    {
        $search = ['http://', 'https://', 'www.', '/'];
        $name = str_replace($search, '', $ref);
        $domainService = $this->get('domain_service');
        return $domainService->getDomainByName($name) instanceof \AppBundle\Entity\BadDomains;
    }


    public function errorClickAction($id)
    {
        $clickServise = $this->get('click_service');
        $click = $clickServise->getClickByParams(['id' => $id]);
        if ($click instanceof \AppBundle\Entity\Click && $click->getBadDomain()) {
            header("refresh:5;url=http://www.google.com");
        }
        return $this->render('default/error_click.html.twig', [
            'data' => !!$clickServise->getClickByParams(['id' => $id]),
        ]);
    }
    
    public function successClickAction($id)
    {
        $clickServise = $this->get('click_service');
        return $this->render('default/click_success.html.twig', [
            'click' => $clickServise->getClickByParams(['id' => $id]),
        ]);
    }
}
