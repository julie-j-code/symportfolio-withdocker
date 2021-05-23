<?php

namespace App\Form;

use App\Entity\Peinture;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeintureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('largeur')
            ->add('hauteur')
            ->add('enVente')
            ->add('prix')
            ->add('dateRealisation')
            ->add('createdAt')
            ->add('description')
            ->add('portfolio')
            ->add('slug')
            ->add('file', FileType::class, [
                'label' => 'Fichier Image',
                'multiple' => true,
                'mapped' => false,
                'required' => false

            ])
            ->add('user')
            ->add('categorie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Peinture::class,
        ]);
    }
}
