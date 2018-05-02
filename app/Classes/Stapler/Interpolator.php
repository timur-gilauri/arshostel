<?php
	
	namespace App\Classes\Stapler;
	
	use Codesleeve\Stapler\Interfaces\Attachment as AttachmentInterface;
	use Codesleeve\Stapler\Interpolator as BaseInterpolator;
	
	/**
	 * Class Interpolator
	 *
	 * Дополнительная замена плейсхолдеров в пути на значения
	 *
	 * @package App\Classes\Stapler
	 */
	class Interpolator extends BaseInterpolator
	{
		protected $cdn = '';
		protected $imagePath = '';
		
		/**
		 * Interpolator constructor.
		 */
		public function __construct()
		{
			$this->cdn = env('CDN_DOMAIN', '');
			$this->imagePath = public_path('images');
		}
		
		/**
		 *
		 * @return array
		 */
		protected function interpolations()
		{
			$parentInterpolations = parent::interpolations();
			
			return array_merge($parentInterpolations,
				[
					':cdn'         => 'getCdn',
					':image_path'  => 'getImagePath',
					':random'      => 'getRandom',
					':random_hash' => 'getRandomHash',
				]);
		}
		
		/**
		 * Возвращает путь к CDN (http://cdn.domain.ru/ )
		 * Домен берется из env(CDN_DOMAIN)
		 *
		 * @return string
		 */
		protected function getCdn()
		{
			return $this->cdn;
		}
		
		/**
		 * Путь к картинкам ( /var/www/.../public/images )
		 *
		 * @return string
		 */
		protected function getImagePath()
		{
			return $this->imagePath;
		}
		
		/**
		 * Случайное значение
		 *
		 * @return string
		 */
		public function getRandom(): string
		{
			return str_pad(mt_rand(), 10, '0', STR_PAD_LEFT);
		}
		
		/**
		 * @param AttachmentInterface $attachment
		 *
		 * @return string
		 */
		public function getRandomHash(AttachmentInterface $attachment): string
		{
			$hash = [];
			foreach (['id', 'image_file_name', 'image_file_size', 'image_content_type', 'image_updated_at'] as $key) {
				$hash[] = $attachment->getInstance()->getAttribute($key);
			}
			
			return sha1(implode('$', $hash));
		}
	}