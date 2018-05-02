<?php
	
	namespace App\Classes\Stapler;
	
	use Imagine\Image\ImageInterface;
	use Imagine\Image\ImagineInterface;
	
	/**
	 * Class StaplerChunk
	 *
	 * Контейнер для нескольких фильтров-обработчиков
	 *
	 * @package App\Classes\Stapler
	 */
	class StaplerChunk extends StaplerFilter
	{
		/** @var StaplerFilter[] */
		protected $items = [];
		
		/**
		 * StaplerChunk constructor.
		 *
		 * @param StaplerFilter[] $items
		 */
		public function __construct(array $items)
		{
			$this->items = $items;
		}
		
		/**
		 * Последовательное применение фильтров
		 *
		 * @param ImageInterface                                                   $image
		 * @param ImagineInterface                                                 $imagine
		 * @param \SplFileInfo|\Symfony\Component\HttpFoundation\File\UploadedFile $file
		 *
		 * @return ImageInterface
		 */
		public function filter(ImageInterface $image, ImagineInterface $imagine, $file)
		{
			foreach ($this->items as $item) {
				$image = $item->filter($image, $imagine, $file);
			}
			
			return $image;
		}
	}