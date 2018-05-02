<?php
	
	namespace App\Classes\Stapler;
	
	use Codesleeve\Stapler\ORM\EloquentTrait;
	
	/**
	 * Class StaplerTrait
	 *
	 * Trait для модели, добавляет функцию-хелпер attach,
	 * достающую параметры картинки из конфига
	 *
	 * @package App\Classes\Stapler
	 */
	trait StaplerTrait
	{
		use EloquentTrait;
		
		protected function attach($field)
		{
			$fieldConfig = config('stapler.styles.'.static::class.'.'.$field, []);
			$defaultConfig = config('stapler.styles.default', []);
			
			$fieldConfig += $defaultConfig;
			
			if ($fieldConfig['relative_path'] ?? false) {
				
				$locationPath = ltrim($fieldConfig['relative_path'], '/');
				if ($locationPath) {
					
					/*if (!($fieldConfig['path'] ?? false)) {
						$fieldConfig['path'] = ':image_path/' . $locationPath;
					}*/
					if (!($fieldConfig['url'] ?? false)) {
						$fieldConfig['url'] = '/images/'.$locationPath;
					}
				}
			}
			
			
			$this->hasAttachedFile($field, $fieldConfig + $defaultConfig);
		}
		
		/**
		 * Get all of the current attributes and attachment objects on the model.
		 *
		 * @return mixed
		 */
		public function getAttributes()
		{
			return parent::getAttributes();
		}
	}