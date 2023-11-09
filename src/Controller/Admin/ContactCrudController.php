<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Contacts')
            ->setEntityLabelInSingular('Contact')

            ->setPaginatorPageSize(20)
            ->setPageTitle("index", "Garage Parrot - Administration des contacts");
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('name')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('firstname')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('email')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('phone')
                ->setFormTypeOption('disabled', 'disabled'),
            TextareaField::new('message'),
            DateTimeField::new('createdAt')
                ->hideOnForm(),
        ];
    }
}
