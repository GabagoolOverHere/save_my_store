<?php

namespace App\Controller\Admin;

use App\Entity\Mission;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class MissionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mission::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('une mission')
            ->setEntityLabelInPlural('Missions')
            ->setSearchFields(['date_facture', 'date_debut', 'date_fin'])
            ->setDefaultSort(['date_facture' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('prestataire_id'));
    }


    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('prestataire');
        yield TextareaField::new('descriptif')
            ->hideOnIndex();
        yield DateTimeField::new('date_debut')->setFormTypeOptions([
            'html5' => true,
            'widget' => 'single_text',
        ]);
        yield DateTimeField::new('date_fin')->setFormTypeOptions([
            'html5' => true,
            'widget' => 'single_text',
        ]);
        yield DateTimeField::new('date_facture')->setFormTypeOptions([
            'html5' => true,
            'widget' => 'single_text',
        ]);
        yield TextField::new('facture')
            ->hideOnIndex();
    }

}
