<?php

namespace App\Form;

use App\Entity\Ipadn;
use App\Entity\IpItemAdn;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class IpItemAdnType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ipadn', EntityType::class, [
                'class' => Ipadn::class,
                'choice_label' => 'name',
                'label' => 'Page',
                'required' => true,
                'attr' => ['placeholder' => 'Page', 'class' => 'col-md-6']
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre de la section',
                'attr' => ['placeholder' => 'Entrez le titre ici']
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
            'data_class' => IpItemAdn::class,
        ]);
    }
}
