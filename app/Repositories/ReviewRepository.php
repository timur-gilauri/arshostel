<?php
	/**
	 * Created by PhpStorm.
	 * User: timur
	 * Date: 25.04.2018
	 * Time: 12:03
	 */
	
	namespace App\Repositories;
	
	
	use App\Entities\ReviewEntity;
	use App\Models\Review;
	use Illuminate\Support\Collection;
	
	class ReviewRepository
	{
		public function all(): Collection
		{
			return Review::all()->map(function (Review $model) {
				return $this->toEntity($model);
			});
		}
		
		/**
		 * @param int $id
		 *
		 * @return null
		 */
		public function find(int $id)
		{
			$model = Review::find($id);
			
			return $model ? $this->toEntity($model) : null;
		}
		
		/**
		 * @param Review $model
		 *
		 * @return ReviewEntitys
		 */
		public function toEntity(Review $model)
		{
			$entity = new ReviewEntity();
			
			$entity->setId($model->id);
			$entity->setAuthorName($model->author_name);
			$entity->setContent($model->content);
			$entity->setCreatedAt($model->created_at);
			
			return $entity;
		}
		
		/**
		 * @param ReviewEntity $entity
		 *
		 * @return bool
		 */
		public function save(ReviewEntity $entity): bool
		{
			$model = $entity->getId() ? Review::find($entity->getId()) : new Review();
			
			$model->author_name = $entity->getAuthorName();
			$model->content = $entity->getContent();
			$model->created_at = $entity->getCreatedAt();
			
			if ($model->save()) {
				if (!$entity->getId()) {
					$entity->setId($model->id);
				}
				
				return true;
			}
			
			return false;
		}
		
		/**
		 * @param int $id
		 *
		 * @return bool
		 */
		public function remove(int $id): bool
		{
			try {
				Review::find($id)->delete();
				
				return true;
			} catch (\Exception $error) {
				return false;
			}
			
		}
	}