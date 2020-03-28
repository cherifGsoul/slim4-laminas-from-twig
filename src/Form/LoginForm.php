<?php

namespace Cherif\Demo\Form;

use Cherif\Demo\Command\LoginCommand;
use Laminas\Form\Element\Checkbox;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\InputFilter\InputFilterProviderInterface;

class LoginForm extends Form implements InputFilterProviderInterface
{
	public function __construct()
	{
		parent::__construct('login-form');
		$this->init();
	}

	public function init()
	{
		$this->setHydrator(new ClassMethodsHydrator());
		$this->add([
			'type' => Text::class,
			'name' => 'username',
			'options' => [
				'label' => 'Username'
			]
		]);

		$this->add([
			'type' => Password::class,
			'name' => 'password',
			'options' => [
				'label' => 'Password'
			]
		]);

		$this->add([
			'name' => 'login',
			'type' => 'submit',
			'attributes' => [
				'value' => 'Login'
			]
		]);

		$this->add([
			'type' => Checkbox::class,
			'name' => 'rememberMe',
			'options' => [
				'label' => 'Remembe me!',
				'checked_value' => 'yes',
				'unchecked_value' => 'no',
			],
			'attributes' => [
				'value' => 'no'
			]
		]);
	}

	public function getInputFilterSpecification()
	{
		return [
			[
				'name' => 'username',
				'required' => true
			],
			[
				'name' => 'password',
				'required' => true
			]
		];
	}
}