<?php

namespace Cherif\Demo\Handler;

use Cherif\Demo\Form\LoginForm;
use Laminas\Diactoros\ResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginHandler implements RequestHandlerInterface
{
	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		$form = new LoginForm();
		$view = $request->getAttribute('view');
		
		return $view->render((new ResponseFactory())->createResponse(), 'login.twig',[
			'form' => $form->prepare()
		]);
	}
}