<?php

namespace App\Form;

use App\Entity\Founder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FounderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du fondateur',
                'attr' => ['placeholder' => 'Entrez le nom ici']
            ])
            ->add('office', TextType::class, [
                'label' => 'Titre de la section',
                'attr' => ['placeholder' => 'Entrez le poste']
            ])
            ->add('imageFile', VichImageType::class, [
                'attr'  => ['data-provide' => 'dropify'],
                'label' => false
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu de la section',
                'attr'  => ['placeholder' => 'Entrez le contenu ici', 'class' => 'editor']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Founder::class,
        ]);
    }
}
