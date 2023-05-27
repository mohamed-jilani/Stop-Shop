<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('name'),
            AssociationField::new('category'),
            MoneyField::new('price')->setCurrency('TND'),
            TextField::new('description'),
            //ImageField::new('image')->setUploadDir('/public/images'),
            // ImageField::new('image')->setUploadedFileNamePattern(
            //     fn (UploadedFile $file): string => sprintf('upload_%d_%s.%s', random_int(1, 999), $file->getFilename(), $file->guessExtension()))->setUploadDir('/public/images'),
            //TextEditorField::new('description'),
            ImageField::new('image')
            ->setBasePath('/images') // Chemin de base pour les images
            ->setUploadDir('public/images') // Répertoire de destination des images
            ->setUploadedFileNamePattern(
                fn (UploadedFile $file): string => sprintf('upload_%d_%s.%s', random_int(1, 999), $file->getClientOriginalName(), $file->getClientOriginalExtension())
            )
            ->setRequired(false), // Le champ n'est pas obligatoire
            BooleanField::new('status')

        ];
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
