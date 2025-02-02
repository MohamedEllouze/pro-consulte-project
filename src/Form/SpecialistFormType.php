<?php

namespace App\Form;

use App\Entity\Specialist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecialistFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 50])
                ]
            ])
            ->add('lastName', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 50])
                ]
            ])
            ->add('online', CheckboxType::class, [
                'required' => false
            ])
            ->add('active', CheckboxType::class, [
                'required' => false
            ])
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 500])
                ]
            ])
            ->add('mobile', TelType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^\+?[0-9]{10,15}$/',
                        'message' => 'Enter a valid phone number.'
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email()
                ]
            ])
            ->add('city', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 100])
                ]
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Specialist::class,
        ]);
    }
}
