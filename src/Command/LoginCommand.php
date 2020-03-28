<?php

namespace Cherif\Demo\Command;

class LoginCommand
{
	private $username;
	private $password;
	private $rememberMe;

	/**
	 * Get the value of username
	 */ 
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Set the value of username
	 *
	 * @return  self
	 */ 
	public function setUsername($username)
	{
		$this->username = $username;
	}

	/**
	 * Get the value of password
	 */ 
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Set the value of password
	 *
	 * @return  self
	 */ 
	public function setPassword($password)
	{
		$this->password = $password;
	}

	/**
	 * Get the value of rememberMe
	 */ 
	public function getRememberMe()
	{
		return $this->rememberMe;
	}

	/**
	 * Set the value of rememberMe
	 *
	 * @return  self
	 */ 
	public function setRememberMe($rememberMe)
	{
		$this->rememberMe = $rememberMe;
	}
}