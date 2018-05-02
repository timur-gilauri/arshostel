<?php
	
	namespace App\Classes\Stapler;
	
	use Imagine\Exception\InvalidArgumentException;
	use Imagine\Exception\OutOfBoundsException;
	use Imagine\Exception\RuntimeException;
	use Imagine\Image\ImageInterface;
	use Imagine\Image\ImagineInterface;
	use Imagine\Image\Point;
	
	/**
	 * Class StaplerWatermark
	 *
	 * Watermark
	 *
	 * @package App\Classes\Stapler
	 */
	class StaplerWatermark extends StaplerFilter
	{
		/** @var string */
		protected $watermark = '';
		
		/**
		 * StaplerWatermark constructor.
		 *
		 * @param string $watermark Путь к картинке относительно storage_path
		 */
		public function __construct($watermark)
		{
			$this->watermark = $watermark;
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
				$watermark = $imagine->open(storage_path($this->watermark));
				$size = $image->getSize();
				$watermarkSize = $watermark->getSize();
				
				$countX = ceil($size->getWidth() / ($watermarkSize->getWidth() + 80));
				$countY = ceil($size->getHeight() / ($watermarkSize->getHeight() + 80));
				
				$offsetX = 0 - $watermarkSize->getWidth();
				
				for ($i = 1; $i < $countX; $i++) {
					
					$offsetX += $watermarkSize->getWidth() + 80;
					$offsetY = 0 - $watermarkSize->getHeight();
					
					for ($j = 1; $j < $countY; $j++) {
						$offsetY += $watermarkSize->getHeight() + 80;
						$image->paste($watermark, new Point($offsetX, $offsetY));
					}
				}
			} catch (InvalidArgumentException $e) {
			} catch (RuntimeException $e) {
			} catch (OutOfBoundsException $e) {
			}
			
			return $image;
		}
	}