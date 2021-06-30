<?php

namespace App\Form;

use App\Entity\PatronPrestataire;
use App\Entity\Quartier;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\ChoiceList;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/* Formulaire d'enregistrement pour les SERVICE PROVIDER */

class ServiceProviderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['mapped' => false]) 
            ->add('email', EmailType::class)
            ->add('nom', TextType::class,['label' => 'Name :'])
            ->add('prenom', TextType::class,['label' => 'Surname :'])
            ->add('tel', TelType::class,['label' => 'Phone number :'])
            ->add('immeuble', TextType::class,['label' => 'Building :', 'required'=>false])
            ->add('rue', TextType::class,['label' => 'Street :'])
            ->add('code_postal', NumberType::class,['label' => 'Zipcode :'])
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
            ->add('nom_societe',TextType::class, ['mapped'=>false])
            ->add('tarif_societe',NumberType::class, ['mapped'=>false])
            ->add('quartier_societe', EntityType::class, ['class' => Quartier::class, 'choice_label'=>'nom', 'mapped'=>false, 'placeholder' => 'Select your quarter'])
            ->add('share_info', CheckboxType::class, ['label'=>'My informations and the service society\'s are the same.','mapped'=>false])
            ->add('email_societe',EmailType::class, ['mapped'=>false, 'required'=>false])
            ->add('tel_societe',TelType::class, ['mapped'=>false, 'required'=>false])
            ->add('immeuble_societe',TextType::class, ['mapped'=>false, 'required'=>false])
            ->add('rue_societe',TextType::class, ['mapped'=>false, 'required'=>false])
            ->add('code_postal_societe',NumberType::class, ['mapped'=>false, 'required'=>false])

            ->add('Validate', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PatronPrestataire::class,
        ]);
    }
}