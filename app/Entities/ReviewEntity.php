<?php
	/**
	 * Created by PhpStorm.
	 * User: timur
	 * Date: 25.04.2018
	 * Time: 12:06
	 */
	
	namespace App\Entities;
	
	
	use Carbon\Carbon;
	
	class ReviewEntity
	{
		/** @var int|null */
		protected $id;
		/** @var string */
		protected $author_name;
		/** @var string */
		protected $content;
		/** @var Carbon */
		protected $created_at;
		
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
		public function getAuthorName(): string
		{
			return $this->author_name;
		}
		
		/**
		 * @param string $author_name
		 */
		public function setAuthorName(string $author_name): void
		{
			$this->author_name = $author_name;
		}
		
		/**
		 * @return string
		 */
		public function getContent(): string
		{
			return $this->content;
		}
		
		/**
		 * @param string $content
		 */
		public function setContent(string $content): void
		{
			$this->content = $content;
		}
		
		/**
		 * @return Carbon
		 */
		public function getCreatedAt(): Carbon
		{
			return $this->created_at;
		}
		
		/**
		 * @param Carbon $created_at
		 */
		public function setCreatedAt(Carbon $created_at): void
		{
			$this->created_at = $created_at;
		}
		
	}