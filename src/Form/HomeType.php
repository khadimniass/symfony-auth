<?php

namespace App\Form;

use App\Entity\Home;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class HomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fichier',FileType::class,[
                // 'constraints' =>[
                     //    new File([
                        //  'maxSize' => '1024k',
                        // 'mimeTypes' => [
                      //      'application/pdf',
                      //     'application/x-pdf',
                        //  ],
                       // 'mimeTypesMessage' => 'Please upload a valid excel document',
                   // ])
                        //   ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Home::class,
        ]);
    }
}
