<?php

// src/Form/Type/UserType.php
namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder 
            ->add('username',TextType::class)
            ->add('email',TextType::class)
            ->add('password',TextType::class)
            ->add('save',SubmitType::class,['label' => 'Register Me','attr' => array('class' => 'btn btn-primary mt-5')])
            ;
    }
    public function configureOptions(OptionsResolver $resolver): void 
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }


}