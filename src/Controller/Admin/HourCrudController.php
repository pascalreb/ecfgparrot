<?php

namespace App\Controller\Admin;

use App\Entity\Hour;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class HourCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hour::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Horaires')
            ->setEntityLabelInSingular('Horaire')

            ->setPaginatorPageSize(20)
            ->setPageTitle("index", "Garage Parrot - Administration des horaires");
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
