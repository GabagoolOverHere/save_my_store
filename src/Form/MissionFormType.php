<?php

namespace App\Form;

use App\Entity\Mission;
use App\Entity\Prestataire;
use App\Repository\MissionRepository;
use Doctrine\DBAL\Types\BigIntType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints\File;


class MissionFormType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $id=$this->security->getUser();

        $builder
            ->add('descriptif', TextareaType::class)
            ->add('date_debut', DateType::class, ['label' => 'Date of beginning :'])
            ->add('date_fin', DateType::class, ['label' => 'Date of end :'])
            ->add('date_facture', DateType::class, ['label' => 'Facture date :'])
            ->add('facture', FileType::class, [
                'label' => 'Facture :',
                'mapped' => false,
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
            ->add('prestataire', EntityType::class, ['class' => PrestataireRepository::class,'choice_label'=>'nom', 'mapped'=>false, 'placeholder' => 'Select which enterprise is in charge.'])
            ->add('restaurant', BigIntType::class, ['label' => 'The restaurant :', 'mapped'=>false, 'data'=>$id])
            ->add('Create', SubmitType::class, ['label' =>"Submit", "attr" => ['class' => 'btn-custom']])
            ;
    
        }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
