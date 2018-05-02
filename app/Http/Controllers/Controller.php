<?php
	
	namespace App\Http\Controllers;
	
	use App\Repositories\RoomsRepository;
	use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
	use Illuminate\Foundation\Bus\DispatchesJobs;
	use Illuminate\Foundation\Validation\ValidatesRequests;
	use Illuminate\Http\Request;
	use Illuminate\Routing\Controller as BaseController;
	
	class Controller extends BaseController
	{
		use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
		/** @var RoomsRepository */
		protected $roomsRepo;
		
		public function __construct()
		{
			$this->roomsRepo = app(RoomsRepository::class);
		}
		
		public function index(Request $request)
		{
			$advantages = [
				[
					'icon' => 'connection',
					'text' => 'Бесплантный Wi-Fi',
				],
				[
					'icon' => 'mop',
					'text' => 'Ежедневная уборка',
				],
				[
					'icon' => 'shower',
					'text' => 'Раздельные душевые',
				],
				[
					'icon' => 'microwave',
					'text' => 'Удобная кухня',
				],
				[
					'icon' => 'tv',
					'text' => 'Комната отдыха с TV+Xbox',
				],
				[
					'icon' => 'clock',
					'text' => 'Круглосуточная регистрация',
				],
			];
			
			$galleryItems = $this->roomsRepo->findByType('room');
			
			return view('layouts.index', [
				'advantages'   => $advantages,
				'galleryItems' => $galleryItems,
			]);
		}
		
		public function contactRequest(Request $request)
		{
		
		}
	}
