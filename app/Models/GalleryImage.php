<?php
	
	namespace App;
	
	use App\Traits\StaplerStylesTrait;
	use Czim\Paperclip\Contracts\AttachableInterface;
	use Czim\Paperclip\Model\PaperclipTrait;
	use Illuminate\Database\Eloquent\Model;
	
	class GalleryImage extends Model implements AttachableInterface
	{
		use StaplerStylesTrait;
	}
