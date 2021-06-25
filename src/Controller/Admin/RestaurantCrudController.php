<?php

namespace App\Controller\Admin;

use App\Entity\Restaurant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class RestaurantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Restaurant::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un restaurant')
            ->setEntityLabelInPlural('Restaurants')
            ->setSearchFields(['nom', 'patron_restaurant_id', 'quartier_id'])
            ->setDefaultSort(['nom' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('patron_restaurant_id'));
    }


    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('patronRestaurant');
        yield AssociationField::new('quartier');
        yield TextField::new('nom');
        yield TextField::new('immeuble');
        yield TextField::new('rue');
        yield NumberField::new('code_postal');
        yield NumberField::new('latitude');
        yield NumberField::new('longitude');
        yield TelephoneField::new('tel');
    }
}
