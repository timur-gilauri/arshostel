<?php
	
	namespace App\Repositories;
	
	
	use App\Entities\RoomEntity;
	use App\Models\Room;
	use Codesleeve\Stapler\Attachment;
	use Illuminate\Support\Collection;
	
	class RoomsRepository
	{
		/**
		 * @return Collection
		 */
		public function all(): Collection
		{
			return Room::all()->map(function (Room $model) {
				return $this->toEntity($model);
			});
		}
		
		/**
		 * @return Collection
		 */
		public function allActive(): Collection
		{
			return Room::where('available', 1)->get()->map(function (Room $model) {
				return $this->toEntity($model);
			});
		}
		
		/**
		 * @param int $id
		 *
		 * @return RoomEntity|null
		 */
		public function find(int $id)
		{
			return ($model = Room::find($id)) ? $this->toEntity($model) : null;
		}
		
		/**
		 * @param int $id
		 *
		 * @return RoomEntity|null
		 */
		public function findActive(int $id)
		{
			return ($model = Room::where('available', 1)->where('id', $id)->first()) ? $this->toEntity($model) : null;
		}
		
		/**
		 * @param string $type
		 *
		 * @return RoomEntity|null
		 */
		public function findByType(string $type)
		{
			return Room::where('available', 1)->where('type', $type)->get()->map(function (Room $model) {
				return $this->toEntity($model);
			});
		}
		
		/**
		 * @param Room $model
		 *
		 * @return RoomEntity
		 */
		public function toEntity(Room $model): RoomEntity
		{
			$entity = new RoomEntity();
			
			$entity->setId($model->id);
			$entity->setTitle($model->title);
			$entity->setType($model->type);
			$entity->setDescription($model->description);
			$entity->setBeds($model->beds);
			$entity->setBedsAvailable($model->beds_available);
			$entity->setPrice($model->price);
			$entity->setImage($model->image);
			$entity->setAvailable($model->available);
			
			return $entity;
		}
		
		public function save(RoomEntity $entity): bool
		{
			$model = Room::find($entity->getId() ?? 9999) ?? new Room();
			
			$model->title = $entity->getTitle();
			$model->type = $entity->getType();
			$model->description = $entity->getDescription();
			$model->beds = $entity->getBeds();
			$model->beds_available = $entity->getBedsAvailable();
			$model->price = $entity->getPrice();
			$model->available = $entity->getAvailable();
			
			if (!($entity->getImage() instanceof Attachment) && !is_null($entity->getImage())) {
				$model->image = $entity->getImage();
			}
			
			if ($model->save()) {
				if (!$entity->getId()) {
					$entity->setId($model->id);
				}
				
				return true;
			}
			
			return false;
		}
		
		/**
		 * @param RoomEntity $entity
		 *
		 * @return bool
		 */
		public function delete(RoomEntity $entity)
		{
			try {
				Room::find($entity->getId())->delete();
				
				return true;
			} catch (\Exception $error) {
				return false;
			}
		}
	}