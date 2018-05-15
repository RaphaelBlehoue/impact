<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label' => false,
                'required' => true,
                'attr' => ['placeholder' => 'Nom *', 'class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Il manque votre nom'])
                ]
            ])
            ->add('lastname', TextType::class,[
                'label' => false,
                'required' => true,
                'attr' => ['placeholder' => 'Prénom *', 'class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Il manque votre nom'])
                ]
            ])
            ->add('compagny', TextType::class,[
                'label' => false,
                'required' => true,
                'attr' => ['placeholder' => 'Société *', 'class' => 'form-control']
            ])
            ->add('office', TextType::class,[
                'label' => false,
                'required' => true,
                'attr' => ['placeholder' => 'Fonction *', 'class' => 'form-control']
            ])
            ->add('phone', NumberType::class,[
                'label' => false,
                'required' => true,
                'attr' => ['placeholder' => 'Téléphone*', 'class' => 'form-control']
            ])
            ->add('address', NumberType::class,[
                'label' => false,
                'required' => true,
                'attr' => ['placeholder' => 'Quelle est votre situation ? *', 'class' => 'form-control']
            ])
            ->add('address', TextType::class,[
                'label' => false,
                'required' => true,
                'attr' => ['placeholder' => 'Code postal*', 'class' => 'form-control']
            ])
            ->add('town', TextType::class,[
                'label' => false,
                'required' => true,
                'attr' => ['placeholder' => 'Ville*', 'class' => 'form-control']
            ])
            ->add('subject', TextType::class,[
                'label' => false,
                'required' => true,
                'attr' => ['placeholder' => 'Quelle est la nature de votre demande *', 'class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Il manque le sujet'])
                ]
            ])
            ->add('email', EmailType::class,[
                'label' => false,
                'required' => true,
                'attr' => ['placeholder' => 'E-mail *', 'class' => 'form-control'],
                'constraints' => [
                    new Email(['message' => 'L\'email n\'est pas valide']),
                    new NotBlank(['message' => 'Renseignez votre adresse Email'])
                ]
            ])
            ->add('website', TextType::class,[
                'label' => false,
                'required' => true,
                'attr' => ['placeholder' => 'http://www.exemple.com', 'class' => 'form-control'],
                'constraints' => [
                    new Url(['message' => 'le format du site web est non valide'])
                ]
            ])
            ->add('content', TextareaType::class,[
                'label' => false,
                'required' => true,
                'attr' => ['placeholder' => 'Votre Message ici *', 'class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Le message est vide'])
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Envoyer le message',
                'attr'  => ['class' => "tg-btn"]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
