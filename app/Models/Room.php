<?php
	
	namespace App\Models;
	
	use App\Classes\Stapler\StaplerTrait;
	use Codesleeve\Stapler\ORM\StaplerableInterface;
	use Illuminate\Database\Eloquent\Model;
	
	class Room extends Model implements StaplerableInterface
	{
		use StaplerTrait;
		
		protected $fillable = ['image'];
		
		public const TYPES = [
			'room'  => 'Комната',
			'other' => 'Другое',
		];
		
		public function __construct(array $attributes = [])
		{
			$this->attach('image');
			parent::__construct($attributes);
		}
		
	}
