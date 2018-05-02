<?php
	
	namespace App\Classes\Stapler;
	
	use Codesleeve\Stapler\Attachment;
	use Codesleeve\Stapler\Factories\File as FileFactory;
	
	/**
	 * Class RefreshAttachment
	 *
	 * @property array  $styles
	 * @property string $storage
	 * @method move($src, $dest)
	 *
	 * @package App\Classes\Stapler
	 */
	class RefreshAttachment extends Attachment
	{
		public $override_file_permissions = false;
		
		/**
		 * Rebuilds the images for this attachment.
		 */
		public function reprocess()
		{
			if (!$this->originalFilename()) {
				return;
			}
			foreach ($this->styles as $style) {
				try {
					$fileLocation = (string)$this->storage === 'filesystem' ? $this->path('original') : $this->url('original');
					$file = FileFactory::create($fileLocation);
					
					if ($style->dimensions && $file->isImage()) {
						$file = $this->resizer->resize($file, $style);
					} else {
						$file = $file->getRealPath();
					}
					
					$filePath = $this->path($style->name);
					$this->move($file, $filePath);
				} catch (\Exception $e) {
					echo $e->getMessage()."\n";
				}
			}
			
		}
	}