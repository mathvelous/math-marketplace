<?php

namespace AppBundle\Controller;

use AppBundle\Form\OfferType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Entity\Offer;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class OfferController extends Controller
{

    /**
     * @Route("/add-offer", name="add-offer")
     * @Security("has_role('ROLE_USER')")
     *
     */
    public function addOfferAction(Request $request, UserInterface $user = null)
    {

        $offer = new Offer();
        $form = $this->createForm(OfferType::class, $offer);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $offer -> setAuthorId($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();


            return $this->redirectToRoute('profil');
        }

        return $this->render('views/addOffer.html.twig', [
            'form' => $form->createView()
        ]);
    }


}