<?php

namespace App\Form;

use App\Entity\Mission;
use App\Entity\Prestataire;
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

        //$admin=$this->security->getUser('patron_prestataire_id');

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
        ;
        // $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($id){
        //     $form = $event->getForm();
        //     $prestataire = [
        //         'class' => Prestataire::class,
        //         'query_builder' => function (EntityRepository $er) use ($id) {
        //             return $er->createQueryBuilder('p')
        //             ->where('p.patron_id =' . $id);
        //         },
        //         'choice_label'=>'nom', 'mapped'=>false, 'placeholder' => 'Select which enterprise is in charge.'
        //     ];
        //     $form
        //         ->add('prestataire', EntityType::class, $prestataire);
        //     });
        $builder
            ->add('prestataire', EntityType::class, [
                'class' => Prestataire::class,
                'choice_label' => 'nom',
                'mapped' => false,
                'placeholder' => 'Select which enterprise is in charge.'
            ])
            ->add('Create', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
