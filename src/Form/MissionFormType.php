<?php

namespace App\Form;

use App\Entity\Mission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descriptif', TextType::class)
            ->add('date_debut', DateType::class, ['label' =>'Date of beginning :'])
            ->add('date_fin', DateType::class, ['label' =>'Date of end :'])
            ->add('date_facture', DateType::class, ['label' => 'Facture date :'])
            ->add('montant', MoneyType::class, ['label' => 'Price :'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
