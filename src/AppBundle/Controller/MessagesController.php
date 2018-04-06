<?php

namespace AppBundle\Controller;

use AppBundle\Form\MessageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Offer;
use AppBundle\Entity\Message;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;


class MessagesController extends Controller
{
    /**
     * @Route("/send-message/{offerId}", name="send-message")
     * @Security("has_role('ROLE_USER')")
     *
     */
    public function sendMessageAction(Request $request, UserInterface $user = null, $offerId)
    {
        $offer = $this->getDoctrine()->getRepository(Offer::class)->find($offerId);
        if (!$offer) {
            throw $this->createNotFoundException('No offer found id' . $offerId);
        }

        if($offer->getAuthorId()->getId() == $user->getId()){
            throw $this->createAccessDeniedException('You cannot acces this page');
        }

        $message = new Message();

        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message->setAuthor($user);
            $message->setDest($offer->getAuthorId());
            $message->setSubject($offer);
            $message->setRelateOffer($offer);

            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();


            return $this->redirectToRoute('list-offer');
        }

        return $this->render('views/sendMessage.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/list-message", name="list-message")
     * @Security("has_role('ROLE_USER')")
     *
     */
    public function listMessageAction(Request $request, UserInterface $user = null) {
        $messagesOfMe = $this->getDoctrine()->getRepository(Message::class)->findBy(array('author' => $user->getId()));
        $messagesForMe = $this->getDoctrine()->getRepository(Message::class)->findBy(array('dest' => $user->getId()));

        return $this->render('views/listMessage.html.twig', [
            'messagesOfMe' => $messagesOfMe,
            'messagesForMe' => $messagesForMe
        ]);
    }

}



