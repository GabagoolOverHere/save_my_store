<?php

namespace App\Form;

use App\Entity\PatronRestaurant;
use App\Entity\Restaurant;
use App\Entity\PatronPrestataire;
use Symfony\Bridge\Doctrine\Form\ChoiceList;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\RestaurantRepository;
use Doctrine\DBAL\Types\BigIntType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/* Formulaire de modification pour les données des patrons des deux entités */

class EditPatronFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ['label' => 'Lastname', 'required' =>false,])
            ->add('prenom', TextType::class, ['label' => 'Firstname', 'required' =>false,])
            ->add('email', EmailType::class, ['required' =>false,])
            ->add('tel', TelType::class, ['label' => 'Phone number', 'required' =>false,])
            ->add('immeuble', TextType::class, ['label' => 'Building', 'required' =>false,])
            ->add('rue', TextType::class, ['label' => 'Street', 'required' =>false,])
            ->add('code_postal', TextType::class, ['label' => 'Zipcode','required' =>false,])
            ->add('submit', SubmitType::class, ['label' =>"Submit", "attr" => ['class' => 'btn-custom']])
        ;
    }

}
