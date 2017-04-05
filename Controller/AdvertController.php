<?php

namespace TestPageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\Mapping as ORM;
use TestPageBundle\Entity\Test;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdvertController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $testRepository = $em->getRepository('TestPageBundle\Entity\Test');

        $name = uniqid();

        $test = new Test();
        $test->setName($name);

        $em->persist($test);
        $em->flush();

        $test = $testRepository->findOneByName($name);

        $em->remove($test);
        $em->flush();

        return new Response();
    }
}
