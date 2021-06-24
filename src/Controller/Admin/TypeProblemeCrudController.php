<?php

namespace App\Controller\Admin;

use App\Entity\TypeProbleme;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class TypeProblemeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeProbleme::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un type de problème')
            ->setEntityLabelInPlural('Types de problème')
            ->setSearchFields(['intitule'])
            ->setDefaultSort(['intitule' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('intitule'));
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('intitule');
        yield TextField::new('violation_code');
    }
}
