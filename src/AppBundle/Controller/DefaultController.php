<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $this->subjectRepository = $this->getDoctrine()->getRepository('AppBundle:Subject');
        $subjects = $this->subjectRepository->findAll();

        return $this->render('default/index.html.twig', array(
            'subjects' => $subjects,
            'blogcounts' => $this->getSubjectBlogCountMap($subjects),
            'latestblogs' => BlogController::getLatestBlogs($this),
            'recommends' => BlogController::getRecommends($this),
        ));
    }
    public function getSubjectBlogCountMap($subjects)
    {
        $this->blogPostRepository = $this->getDoctrine()->getRepository('AppBundle:BlogPost');
        $map = array();
        for ($i = 0; $i < sizeof($subjects); $i = $i + 1)
        {
            $this->subject = $subjects[$i];
            $map[$this->subject->getId()] = sizeof($this->blogPostRepository->findBy(array('subject' => $this->subject->getId())));
        }
        return $map;
    }
}
