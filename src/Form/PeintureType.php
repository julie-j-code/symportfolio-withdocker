<?php

namespace App\Form;

use App\Entity\Peinture;
use Symfony\Component\Form\AbstractType;
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
            // ->add('createdAt')
            ->add('description')
            // ->add('portfolio')
            ->add('slug')
            ->add('file')
            // ->add('user')
            // ->add('categorie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Peinture::class,
        ]);
    }
}
