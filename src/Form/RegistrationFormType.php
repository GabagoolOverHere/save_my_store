<?php

namespace App\Form;

use App\Entity\PatronRestaurant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/* Formulaire d'enregistrement pour les RESTAURANT OWNER */

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['mapped' => false]) 
            ->add('email', EmailType::class)
            // Lien entre table 
            //->add('restaurant_camis', TextType::class,['label' => 'Restaurant CAMIS :'])
            ->add('nom', TextType::class,['label' => 'Name :'])
            ->add('prenom', TextType::class,['label' => 'Surname :'])
            ->add('immeuble', TextType::class,['label' => 'Building :'])
            ->add('rue', TextType::class,['label' => 'Street :'])
            ->add('code_postal', TextType::class,['label' => 'Zipcode :'])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PatronRestaurant::class,
        ]);
    }
}
