<?php
	/**
	 * Created by PhpStorm.
	 * User: timur
	 * Date: 02.05.2018
	 * Time: 1:47
	 */
	
	namespace App\Entities;
	
	
	use Codesleeve\Stapler\Attachment;
	use Symfony\Component\HttpFoundation\File\UploadedFile;
	
	class RoomEntity
	{
		/** @var int|null */
		protected $id;
		/** @var string */
		protected $title;
		/** @var string */
		protected $type;
		/** @var string|null */
		protected $description;
		/** @var int|null */
		protected $beds;
		/** @var int|null */
		protected $beds_available;
		/** @var int */
		protected $price;
		/** @var Attachment|UploadedFile|null */
		protected $image;
		/** @var int */
		protected $available;
		
		/**
		 * @return int|null
		 */
		public function getId(): ?int
		{
			return $this->id;
		}
		
		/**
		 * @param int|null $id
		 */
		public function setId(?int $id): void
		{
			$this->id = $id;
		}
		
		/**
		 * @return string
		 */
		public function getTitle(): string
		{
			return $this->title;
		}
		
		/**
		 * @param string $title
		 */
		public function setTitle(string $title): void
		{
			$this->title = $title;
		}
		
		/**
		 * @return string
		 */
		public function getType(): string
		{
			return $this->type;
		}
		
		/**
		 * @param string $type
		 */
		public function setType(string $type): void
		{
			$this->type = $type;
		}
		
		/**
		 * @return null|string
		 */
		public function getDescription(): ?string
		{
			return $this->description;
		}
		
		/**
		 * @param null|string $description
		 */
		public function setDescription(?string $description): void
		{
			$this->description = $description;
		}
		
		/**
		 * @return int|null
		 */
		public function getBeds(): ?int
		{
			return $this->beds;
		}
		
		/**
		 * @param int|null $beds
		 */
		public function setBeds(?int $beds): void
		{
			$this->beds = $beds;
		}
		
		/**
		 * @return int|null
		 */
		public function getBedsAvailable(): ?int
		{
			return $this->beds_available;
		}
		
		/**
		 * @param int|null $beds_available
		 */
		public function setBedsAvailable(?int $beds_available): void
		{
			$this->beds_available = $beds_available;
		}
		
		/**
		 * @return int
		 */
		public function getPrice(): int
		{
			return $this->price;
		}
		
		/**
		 * @param int $price
		 */
		public function setPrice(int $price): void
		{
			$this->price = $price;
		}
		
		/**
		 * @return Attachment|null|UploadedFile
		 */
		public function getImage()
		{
			return $this->image;
		}
		
		/**
		 * @param Attachment|null|UploadedFile $image
		 */
		public function setImage($image): void
		{
			$this->image = $image;
		}
		
		/**
		 * @return int
		 */
		public function getAvailable(): int
		{
			return $this->available;
		}
		
		/**
		 * @param int $available
		 */
		public function setAvailable(int $available): void
		{
			$this->available = $available;
		}
		
		/**
		 * @return bool
		 */
		public function isAvailable(): bool
		{
			return (bool)$this->getAvailable();
		}
	}