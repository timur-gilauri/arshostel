<?php
	
	namespace App\Classes\Stapler;
	
	use Imagine\Exception\InvalidArgumentException;
	use Imagine\Exception\OutOfBoundsException;
	use Imagine\Exception\RuntimeException;
	use Imagine\Image\ImageInterface;
	use Imagine\Image\ImagineInterface;
	use Symfony\Component\HttpFoundation\File\UploadedFile;
	
	/**
	 * Class StaplerFilter
	 *
	 * Фильтр, применяемый к оригиналу картинки
	 *
	 * @package App\Classes\Stapler
	 */
	abstract class StaplerFilter
	{
		/**
		 * @param \SplFileInfo|UploadedFile|\Codesleeve\Stapler\File\File $file
		 * @param ImagineInterface                                        $imagine
		 *
		 * @return \Imagine\Image\ImageInterface
		 *
		 * @throws RuntimeException
		 * @throws InvalidArgumentException
		 * @throws OutOfBoundsException
		 */
		public function __invoke($file, ImagineInterface $imagine)
		{
			return $this->filter($imagine->open($file->getRealPath()), $imagine, $file);
		}
		
		/**
		 * @param \SplFileInfo|UploadedFile $file
		 * @param ImageInterface            $image
		 * @param ImagineInterface          $imagine
		 *
		 * @return ImageInterface
		 */
		abstract public function filter(ImageInterface $image, ImagineInterface $imagine, $file);
	}