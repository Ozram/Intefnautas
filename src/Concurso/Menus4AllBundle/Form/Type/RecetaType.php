<?php

namespace Concurso\Menus4AllBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\DataTransformer\IntegerToLocalizedStringTransformer;

class RecetaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nombre', 'text', array('label' => 'Nombre'))
                ->add('descripcion', 'textarea', array('label' => 'Descripcion'))
                ->add('n_personas', 'number', array('label' => 'Comensales'));
    }

    public function getName() {
        return 'receta';
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Concurso\Menus4AllBundle\Entity\Receta',
        );
    }

}