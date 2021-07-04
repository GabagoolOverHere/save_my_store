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
use Symfony\Component\Validator\Constraints\File;
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
            ->add('nom', TextType::class, ['label' => 'Lastname'])
            ->add('prenom', TextType::class, ['label' => 'Firstname'])
            ->add('tel', TelType::class, ['label' => 'Phone number'])
            ->add('immeuble', TextType::class, ['label' => 'Building', 'required'=>false])
            ->add('rue', TextType::class, ['label' => 'Street'])
            ->add('code_postal', NumberType::class, ['label' => 'Zipcode'])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Password',
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
            ->add('nom_societe', TextType::class, ['label' => 'Company Name', 'mapped'=>false])
            ->add('tarif_societe', FileType::class, [
                'label' => 'Tarifs :',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])
            ->add('quartier_societe', EntityType::class, ['label' => 'District', 'class' => Quartier::class, 'choice_label'=>'nom', 'mapped'=>false, 'placeholder' => ''])
            ->add('share_info', CheckboxType::class, ['label'=>'My informations and the service society\'s are the same.','mapped'=>false, 'required' => false])
            ->add('email_societe', EmailType::class, ['label' => 'Email', 'mapped'=>false, 'required'=>false])
            ->add('tel_societe', TelType::class, ['label' => 'Tel', 'mapped'=>false, 'required'=>false])
            ->add('immeuble_societe', TextType::class, ['label' => 'Building','mapped'=>false, 'required'=>false])
            ->add('rue_societe', TextType::class, ['label' => 'Street', 'mapped'=>false, 'required'=>false])
            ->add('code_postal_societe', NumberType::class, ['label' => 'Zipcode', 'mapped'=>false, 'required'=>false])

            ->add('submit', SubmitType::class, ['label' =>"Submit", "attr" => ['class' => 'btn-custom']])
        ;
    }
}
