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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OfferType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('label' => 'Titre'))
            ->add('description', TextType::class, array('label' => 'Description'))
            ->add('price', TextType::class, array('label' => 'Prix'))
            ->add('zipcode', TextType::class, array('label' => 'Code postal'))
            ->add('save', SubmitType::class);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Offer::class,
        ));
    }

}