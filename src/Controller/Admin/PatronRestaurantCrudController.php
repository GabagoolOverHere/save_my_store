<?php

namespace App\Controller\Admin;

use App\Entity\PatronRestaurant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PatronRestaurantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PatronRestaurant::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un patron de restaurant')
            ->setEntityLabelInPlural('Patrons de restaurant')
            ->setSearchFields(['nom', 'prenom', 'tel'])
            ->setDefaultSort(['nom' => 'DESC']);
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('nom');
        yield TextField::new('prenom');
        yield EmailField::new('email');
        yield TelephoneField::new('tel');
        yield TextField::new('immeuble');
        yield TextField::new('rue');
        yield NumberField::new('code_postal');
    }
}
