<?php

namespace App\Form;

use App\Entity\PatronRestaurant;
use App\Entity\Restaurant;
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

/* Formulaire d'enregistrement pour les RESTAURANT OWNER */

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['mapped' => false])
            ->add('email', EmailType::class)
            ->add('nom', TextType::class, ['label' => 'Lastname'])
            ->add('prenom', TextType::class, ['label' => 'Firstname'])
            ->add('immeuble', TextType::class, ['label' => 'Building'])
            ->add('tel', TelType::class, ['label' => 'Phone number'])
            ->add('rue', TextType::class, ['label' => 'Street'])
            ->add('code_postal', TextType::class, ['label' => 'Zipcode'])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' => 'Password',
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
            ->add('Restaurant', EntityType::class, ['class' => Restaurant::class,'label' => 'Find', 'choice_label'=>'camis', 'mapped'=>false])
            ->add('submit', SubmitType::class, ['label' =>"Submit", "attr" => ['class' => 'btn-custom']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PatronRestaurant::class,
        ]);
    }
}
