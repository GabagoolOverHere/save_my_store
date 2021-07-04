<?php

namespace App\Form;

use App\Entity\PatronRestaurant;
use App\Entity\Restaurant;
use App\Repository\AdminRepository;
use App\Repository\PatronRestaurantRepository;
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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Security;

/* Formulaire de modification pour les RESTAURANT OWNER */

class LinkRestaurantToOwnerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Restaurant', EntityType::class, ['class' => Restaurant::class, 'choice_label'=>'camis', 'mapped'=>false, 'placeholder' => 'Select your camis'])
            ->add('submit', SubmitType::class, ['label' =>"Submit", "attr" => ['class' => 'btn-custom']])
        ;
    }
}
