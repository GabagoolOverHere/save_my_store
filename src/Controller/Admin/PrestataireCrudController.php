<?php

namespace App\Controller\Admin;

use App\Entity\Prestataire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use function Sodium\add;


class PrestataireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Prestataire::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un prestataire')
            ->setEntityLabelInPlural('Prestataires')
            ->setSearchFields(['nom', 'patron_prestataire_id', 'quartier_id'])
            ->setDefaultSort(['nom' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('patron_prestataire_id'));
    }


    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('patronPrestataire');
        yield AssociationField::new('quartier');
        yield TextField::new('nom');
        yield TextField::new('immeuble');
        yield TextField::new('rue');
        yield NumberField::new('code_postal');
        yield NumberField::new('latitude');
        yield NumberField::new('longitude');
        yield TextField::new('tarif')
            ->hideOnIndex();
        yield EmailField::new('email');
        yield TelephoneField::new('tel');
    }
}
