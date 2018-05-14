<?php

namespace App\Form;

use App\Entity\Filiere;
use App\Entity\Formation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filiere', EntityType::class, [
                'class' => Filiere::class,
                'choice_label' => 'name',
                'label' => 'Choix de la filiere',
                'required' => true,
                'attr' => ['placeholder' => 'Choix de la filiere', 'class' => 'col-md-6']
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre de la formation',
                'attr' => ['placeholder' => 'Entrez le titre de la formation']
            ])
            ->add('smallContent', TextareaType::class, [
                'label' => 'Contenu sommaire formation',
                'attr'  => ['placeholder' => 'Entrez le contenu ici']
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu de la formation',
                'attr'  => ['placeholder' => 'Entrez le contenu ici']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
