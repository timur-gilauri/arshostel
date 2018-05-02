<?php
	/**
	 * Created by PhpStorm.
	 * User: timur
	 * Date: 03.05.2018
	 * Time: 3:41
	 */
	
	namespace App\Repositories;
	
	
	use App\Entities\ReviewEntity;
	use App\Models\Review;
	use Illuminate\Support\Collection;
	
	class ReviewsRepository
	{
		/**
		 * @return Collection
		 */
		public function all(): Collection
		{
			return Review::all()->map(function (Review $model) {
				return $this->toEntity($model);
			});
		}
		
		/**
		 * @param int $id
		 *
		 * @return ReviewEntity|null
		 */
		public function find(int $id)
		{
			return ($model = Review::find($id)) ? $this->toEntity($model) : null;
		}
		
		/**
		 * @param Review $model
		 *
		 * @return ReviewEntity
		 */
		public function toEntity(Review $model): ReviewEntity
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
			
			if ($model->save()) {
				if (!$entity->getId()) {
					$entity->setId($model->id);
				}
				
				return true;
			}
			
			return false;
		}
		
		/**
		 * @param ReviewEntity $entity
		 *
		 * @return bool
		 */
		public function delete(ReviewEntity $entity)
		{
			try {
				Review::find($entity->getId())->delete();
				
				return true;
			} catch (\Exception $error) {
				return false;
			}
		}
	}