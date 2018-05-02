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
	 * Class StaplerSquare
	 *
	 * Вписывает изображение в квадрат, стороны которого равны наибольшей стороне картинки
	 *
	 * @package App\Classes\Stapler
	 */
	class StaplerSquare extends StaplerFilter
	{
		/** @var bool */
		protected $transparent = true;
		
		/**
		 * StaplerSquare constructor.
		 *
		 * @param bool $transparent
		 */
		public function __construct($transparent = true)
		{
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
				$baseImageSide = max($image->getSize()->getWidth(), $image->getSize()->getHeight());
				$resultImage = $imagine->create(new Box($baseImageSide, $baseImageSide), $transparent);
				
				$pastePoint = new Point(
					ceil(($baseImageSide - $image->getSize()->getWidth()) / 2),
					ceil(($baseImageSide - $image->getSize()->getHeight()) / 2)
				);
				$resultImage->paste($image, $pastePoint);
				
				return $resultImage;
			} catch (InvalidArgumentException $e) {
			} catch (RuntimeException $e) {
			} catch (OutOfBoundsException $e) {
			}
			
			return $image;
		}
	}