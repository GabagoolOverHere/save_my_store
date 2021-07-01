<?php

namespace App\Form;

use App\Entity\Mission;
use App\Entity\Prestataire;
use App\Entity\Admin;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\User\UserInterface;
class MissionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descriptif', TextField::class)
            ->add('date_debut', DateType::class, ['label' =>'Date of beginning :'])
            ->add('date_fin', DateType::class, ['label' =>'Date of end :'])
            ->add('date_facture', DateType::class, ['label' => 'Facture date :'])
            ->add('Facture', FileType::class, ['label' => 'Estimate :'])
            ->add('prestataire', EntityType::class, ['class' => Prestataire::class,'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('p');
            }, 'choice_label'=>'nom', 'mapped'=>false, 'placeholder' => 'Select which enterprise is in charge.'])
            ->add('Create', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
