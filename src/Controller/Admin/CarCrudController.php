<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Car::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Véhicules')
            ->setEntityLabelInSingular('Véhicule')

            ->setPaginatorPageSize(20)
            ->setPageTitle("index", "Garage Parrot - Administration des véhicules");
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('brand'),
            TextField::new('model'),
            IntegerField::new('year'),
            TextField::new('energy'),
            IntegerField::new('kilometers'),
            IntegerField::new('price'),
            DateTimeField::new('createdAt')
                ->hideOnForm(),
            DateTimeField::new('updatedAt')
                ->hideOnForm(),
        ];
    }
}
