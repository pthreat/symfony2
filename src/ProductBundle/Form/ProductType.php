<?php

namespace ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('name')
			->add('price')
			->add('stock')
			->add('categories');
	}/**
	  * {@inheritdoc}
	  */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
					'data_class' => 'ProductBundle\Entity\Product'
					));
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix()
	{
		return 'productbundle_product';
	}


}
