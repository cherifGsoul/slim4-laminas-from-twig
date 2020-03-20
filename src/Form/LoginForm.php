<?php

namespace Cherif\Demo\Form;

use Laminas\Form\Element\Password;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;

class LoginForm extends Form
{
	public function __construct()
	{
		parent::__construct('login-form');
		$this->init();
	}

	public function init()
	{
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
	}
}