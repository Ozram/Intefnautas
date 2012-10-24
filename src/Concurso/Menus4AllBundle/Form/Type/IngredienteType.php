<?php

namespace Concurso\Menus4AllBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\DataTransformer\IntegerToLocalizedStringTransformer;

class IngredienteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
            $builder->add('nombre', 'text', array('label' => 'Nombre'))
                    ->add('proteinas', 'number', array('label' => 'Proteína (g)', 'rounding_mode' => IntegerToLocalizedStringTransformer::ROUND_HALFDOWN, 'precision' => 2))
                    ->add('calorias', 'integer', array('label' => 'Energía (Kcal)'))
                    ->add('grasas', 'number', array('label' => 'Grasas', 'rounding_mode' => IntegerToLocalizedStringTransformer::ROUND_HALFDOWN, 'precision' => 2))
                    ->add('carbohidratos', 'number', array('label' => 'Hidratos de Carbono (g)', 'rounding_mode' => IntegerToLocalizedStringTransformer::ROUND_HALFDOWN, 'precision' => 2));
    }

    public function getName() {
        return 'ingrediente';
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Concurso\Menus4AllBundle\Entity\Ingrediente',
        );
    }

}