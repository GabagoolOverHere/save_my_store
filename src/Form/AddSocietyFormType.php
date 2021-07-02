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

class AddSocietyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_societe', TextType::class, ['label' => 'Company Name', 'mapped'=>false])
            ->add('tarif_societe', FileType::class, ['multiple'=>false, 'mapped'=>false, 'required'=>false])
            ->add('quartier_societe', EntityType::class, ['label' => 'District', 'class' => Quartier::class, 'choice_label'=>'nom', 'mapped'=>false, 'placeholder' => ''])
            ->add('email_societe', EmailType::class, ['label' => 'Email', 'mapped'=>false, 'required'=>false])
            ->add('tel_societe', TelType::class, ['label' => 'Tel', 'mapped'=>false, 'required'=>false])
            ->add('immeuble_societe', TextType::class, ['label' => 'Building','mapped'=>false, 'required'=>false])
            ->add('rue_societe', TextType::class, ['label' => 'Street', 'mapped'=>false, 'required'=>false])
            ->add('code_postal_societe', NumberType::class, ['label' => 'Zipcode', 'mapped'=>false, 'required'=>false])

            ->add('submit', SubmitType::class, ['label' =>"Submit", "attr" => ['class' => 'btn-custom']])
        ;
    }
}
