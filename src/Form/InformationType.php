<?php

namespace App\Form;

use App\Entity\Information;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class InformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country', TextType::class, [
                'label' => 'Renseignez le pays',
                'attr' => ['placeholder' => 'Entrez le pays ici']
            ])
            ->add('city', TextType::class, [
                'label' => 'Renseignez la ville',
                'attr' => ['placeholder' => 'Entrez la ville ici']
            ])
            ->add('phone', TextType::class, [
                'label' => 'Renseignez le numero de téléphone',
                'attr' => ['placeholder' => 'Format : (+xx) xx xx xx xx xx']
            ])
            ->add('address', TextType::class, [
                'label' => 'Renseignez l\'adresse',
                'attr' => ['placeholder' => 'Format: Rue x 00000 ..., Paris Côte d\'ivoire']
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Renseignez le mail',
                'attr' => ['placeholder' => 'Renseignez le mail ici']
            ])
            ->add('imageFile', VichImageType::class, [
                'attr'  => ['data-provide' => 'dropify'],
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Information::class,
        ]);
    }
}
