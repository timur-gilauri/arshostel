<?php
	
	namespace App\Classes\Stapler;
	
	use Imagine\Exception\InvalidArgumentException;
	use Imagine\Exception\OutOfBoundsException;
	use Imagine\Exception\RuntimeException;
	use Imagine\Image\Box;
	use Imagine\Image\ImageInterface;
	use Imagine\Image\ImagineInterface;
	use Imagine\Image\Palette\RGB;
	use Imagine\Image\Point;
	
	/**
	 * Class StaplerCrop
	 *
	 * Изменение картинки до определенных размеров
	 * Если картинка меньше, чем нужно - она располагается по центру
	 *
	 * @package App\Classes\Stapler
	 */
	class StaplerCrop extends StaplerFilter
	{
		/** @var int */
		protected $width = 0;
		/** @var int */
		protected $height = 0;
		/** @var bool */
		protected $transparent = true;
		
		/**
		 * StaplerCrop constructor.
		 *
		 * @param int  $width Ширина
		 * @param int  $height Высота
		 * @param bool $transparent Прозрачность
		 */
		public function __construct($width, $height, $transparent = true)
		{
			$this->width = $width;
			$this->height = $height;
			$this->transparent = $transparent;
		}
		
		/**
		 * @param ImageInterface                                                   $image
		 * @param ImagineInterface                                                 $imagine
		 * @param \SplFileInfo|\Symfony\Component\HttpFoundation\File\UploadedFile $file
		 *
		 * @return ImageInterface
		 */
		public function filter(ImageInterface $image, ImagineInterface $imagine, $file)
		{
			try {
				$transparent = (new RGB())->color(0xffffff, $this->transparent ? 0 : 100);
				$resultImage = $imagine->create(new Box($this->width, $this->height), $transparent);
				
				$baseImageSize = $image->getSize();
				$ratio = min($this->width / $baseImageSize->getWidth(),
					$this->height / $baseImageSize->getHeight());
				
				$newSize = new Box(
					floor($baseImageSize->getWidth() * $ratio),
					floor($baseImageSize->getHeight() * $ratio)
				);
				
				$image->resize($newSize);
				
				$pastePoint = new Point(
					ceil(($this->width - $newSize->getWidth()) / 2),
					ceil(($this->height - $newSize->getHeight()) / 2)
				);
				
				$resultImage->paste($image, $pastePoint);
				
				return $resultImage;
				
				//@todo что тут делать в случае ошибки? Если игнорировать, то не будут падать следующие обработчики, но
				// об ошибке мы не узнаем
			} catch (InvalidArgumentException $e) {
			} catch (RuntimeException $e) {
			} catch (OutOfBoundsException $e) {
			}
			
			return $image;
		}
	}