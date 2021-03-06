<?php

namespace AppBundle\Controller;

use AppBundle\Form\OfferType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
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
     * @Route("/list-offer", name="list-offer")
     *
     */
    public function listOfferAction(Request $request)
    {
        $offerRepo = $this->getDoctrine()->getRepository(Offer::class);
        $offers = $offerRepo->findAll();

        return $this->render('views/listOffer.html.twig', [
            'offers' => $offers
        ]);
    }

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


    /**
     * @Route("/offer/edit/{offerId}", name="editOffer")
     * @Security("has_role('ROLE_USER')")
     *
     */
    public function editOfferAction(Request $request, UserInterface $user = null, $offerId)
    {

        $offer = $this->getDoctrine()->getRepository(Offer::class)->find($offerId);
        if (!$offer) {
            throw $this->createNotFoundException('No offer found id' . $offerId);
        }

        if($offer->getAuthorId()->getId() != $user->getId()){
            throw $this->createAccessDeniedException('You cannot acces this page');
        }

        $currentOfferImg = $offer->getImage();
        $offer->setImage(null);

        $form = $this->createForm(OfferType::class, $offer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $file = $offer->getImage();
            if ($file !== null) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
                $offer->setImage($fileName);
            }else{
                $offer->setImage($currentOfferImg);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();


            return $this->redirectToRoute('profil');
        }

        return $this->render('views/editOffer.html.twig', [
            'form' => $form->createView(),
            'currentOfferImg' => $currentOfferImg
        ]);
    }


    /**
     * @Route("/offer/delete/{offerId}", name="deleteOffer")
     * @Security("has_role('ROLE_USER')")
     *
     */
    public function deleteOfferAction(Request $request, UserInterface $user = null, $offerId)
    {

        $offer = $this->getDoctrine()->getRepository(Offer::class)->find($offerId);
        if (!$offer) {
            throw $this->createNotFoundException('No offer found id' . $offerId);
        }

        if($offer->getAuthorId()->getId() != $user->getId()){
            throw $this->createAccessDeniedException('You cannot acces this page');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($offer);
        $em->flush();

        return $this->redirectToRoute('/profil');
    }






}
