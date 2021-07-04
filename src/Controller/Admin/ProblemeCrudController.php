<?php

namespace App\Controller\Admin;

use App\Entity\Probleme;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class ProblemeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Probleme::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un problème')
            ->setEntityLabelInPlural('Problèmes')
            ->setSearchFields(['intitule', 'restaurant_id', 'type_probleme_id'])
            ->setDefaultSort(['intitule' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('type_probleme_id'));
    }


    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('typeProbleme');
        yield AssociationField::new('mission');
        yield AssociationField::new('restaurant');
        yield TextField::new('intitule');
    }
}
