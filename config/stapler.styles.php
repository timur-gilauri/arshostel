<?php
	
	use Imagine\Image\Box;
	use Imagine\Image\Palette\RGB;
	use Imagine\Image\Point;
	
	function crop($file, $imagine, int $height, int $width)
	{
		$image = $imagine->open($file->getRealPath());
		try {
			$transparent = (new RGB())->color(0xffffff, 100);
			$resultImage = $imagine->create(new Box($width, $height), $transparent);
			
			$baseImageSize = $image->getSize();
			$ratio = min($width / $baseImageSize->getWidth(),
				$height / $baseImageSize->getHeight());
			
			$newSize = new Box(
				floor($baseImageSize->getWidth() * $ratio),
				floor($baseImageSize->getHeight() * $ratio)
			);
			
			$image->resize($newSize);
			
			$pastePoint = new Point(
				ceil(($width - $newSize->getWidth()) / 2),
				ceil(($height - $newSize->getHeight()) / 2)
			);
			
			$resultImage->paste($image, $pastePoint);
			
			return $resultImage;
			
			//@todo что тут делать в случае ошибки? Если игнорировать, то не будут падать следующие обработчики, но об ошибке мы не узнаем
		} catch (InvalidArgumentException $e) {
		} catch (RuntimeException $e) {
		}
		
		return $image;
	}
	
	return [
		
		\App\Models\Room::class => [
			'image' => [
				'styles'        => [
					'thumb' => '250x250',
					'full'  => '1000x1000',
				],
				'relative_path' => '/room/:id_partition/:style/:filename',
			],
		],
	];