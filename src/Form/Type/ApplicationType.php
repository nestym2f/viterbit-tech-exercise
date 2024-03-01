<?php
namespace App\Form\Type;

use App\Document\Application;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('candidateName', TextType::class, ['label' => 'Full Name']);
        $builder->add('email', EmailType::class, ['label' => 'Email']);
        $builder->add('phone', TelType::class, ['label' => 'Phone Number']);
        $builder->add('positionAppliedFor', TextType::class, ['label' => 'Position Applied For']);        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
        ]);
    }
}