<?php

namespace App\Controller\Admin;

use App\Entity\Quartier;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class QuartierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Quartier::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un quartier')
            ->setEntityLabelInPlural('Quartiers')
            ->setSearchFields(['nom'])
            ->setDefaultSort(['nom' => 'DESC']);
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('nom');
    }
}
