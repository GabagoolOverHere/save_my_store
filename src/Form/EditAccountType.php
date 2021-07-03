<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['label' => 'Username', 'required' =>false,])
            ->add('password', PasswordType::class, ['label' => 'Password','required' =>false,])
            ->add('submit', SubmitType::class, ['label' =>"Submit", "attr" => ['class' => 'btn-custom']])
        ;
    }
}
