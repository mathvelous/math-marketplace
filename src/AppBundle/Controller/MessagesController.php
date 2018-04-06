<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Offer;
use AppBundle\Entity\Message;
use AppBundle\Entity\User;


class DefaultController extends Controller
{
    /**
     * @Route("/send-message", name="send-message")
     * @Security("has_role('ROLE_USER')")
     *
     */
    public function sendMessageAction(Request $request, UserInterface $user = null, $offerId)
    {
        $message = new Message();
        $form = $this->createForm(OfferType::class, $message);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $offer -> setAuthorId($user);

            $file = $offer->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            $offer->setImage($fileName);


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



