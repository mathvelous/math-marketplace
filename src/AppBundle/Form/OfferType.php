<?php

namespace AppBundle\Form\Type;

/**
 * Created by PhpStorm.
 * User: mathildehenry
 * Date: 02/02/2018
 * Time: 11:02
 *
 */

namespace AppBundle\Form;

use AppBundle\Entity\Offer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvents;

class OfferType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('label' => 'Titre'))
            ->add('description', TextType::class, array('label' => 'Description'))
            ->add('price', NumberType::class, array('label' => 'Prix'))
            ->add('zipcode', TextType::class, array('label' => 'Code postal'))
            ->add('save', SubmitType::class);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
           $offer = $event->getData();
           $form = $event->getForm();

           if (!$offer || null === $offer->getId() ) {
               $form->add('image', FileType::class, array('label' => 'image'));
               $form->add('save', SubmitType::class, array(
                   'validation_groups' => array('Default', "add"),
               ));
           } else {
               $form->add('image', FileType::class, array('label' => 'New image', 'required' => false));
               $form->add('save', SubmitType::class, array(
                   'validation_groups' => array('Default'),
               ));
           }
        });
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Offer::class,
        ));
    }

}
