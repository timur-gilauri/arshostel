<?php
	/**
	 * Created by PhpStorm.
	 * User: timur
	 * Date: 03.05.2018
	 * Time: 2:01
	 */
	
	namespace App\Entities;
	
	
	class MailEntity
	{
		/** @var string */
		protected $name;
		/** @var string */
		protected $email;
		/** @var string */
		protected $phone;
		/** @var string|null */
		protected $message;
		
		
		public function __construct($data = [])
		{
			if ($data) {
				$this->setName($data['name']);
				$this->setEmail($data['email']);
				$this->setPhone($data['phone']);
				$this->setMessage($data['message'] ?? '');
			}
		}
		
		/**
		 * @return string
		 */
		public function getName(): string
		{
			return $this->name;
		}
		
		/**
		 * @param string $name
		 */
		public function setName(string $name): void
		{
			$this->name = $name;
		}
		
		/**
		 * @return string
		 */
		public function getEmail(): string
		{
			return $this->email;
		}
		
		/**
		 * @param string $email
		 */
		public function setEmail(string $email): void
		{
			$this->email = $email;
		}
		
		/**
		 * @return string
		 */
		public function getPhone(): string
		{
			return $this->phone;
		}
		
		/**
		 * @param string $phone
		 */
		public function setPhone(string $phone): void
		{
			$this->phone = $phone;
		}
		
		/**
		 * @return null|string
		 */
		public function getMessage(): ?string
		{
			return $this->message;
		}
		
		/**
		 * @param null|string $message
		 */
		public function setMessage(?string $message): void
		{
			$this->message = $message;
		}
		
		
	}