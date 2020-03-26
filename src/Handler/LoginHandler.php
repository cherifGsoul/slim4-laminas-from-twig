<?php

namespace Cherif\Demo\Handler;

use Cherif\Demo\Command\LoginCommand;
use Cherif\Demo\Form\LoginForm;
use Laminas\Diactoros\ResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginHandler implements RequestHandlerInterface
{
	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		$view = $request->getAttribute('view');
		$form = new LoginForm();
		$form->bind(new LoginCommand);
		if ('POST' == $request->getMethod()) {
			$form->setData($request->getParsedBody());
			$form->isValid();
		}

		return $view->render((new ResponseFactory())->createResponse(), 'login.twig',[
			'form' => $form->prepare()
		]);
	}
}