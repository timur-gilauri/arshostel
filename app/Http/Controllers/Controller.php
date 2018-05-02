<?php
	
	namespace App\Http\Controllers;
	
	use App\Entities\MailEntity;
	use App\Mail\ContactRequest;
	use App\Repositories\ReviewsRepository;
	use App\Repositories\RoomsRepository;
	use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
	use Illuminate\Foundation\Bus\DispatchesJobs;
	use Illuminate\Foundation\Validation\ValidatesRequests;
	use Illuminate\Http\Request;
	use Illuminate\Routing\Controller as BaseController;
	use Illuminate\Support\Facades\Mail;
	
	class Controller extends BaseController
	{
		use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
		/** @var RoomsRepository */
		protected $roomsRepo;
		/** @var ReviewsRepository */
		protected $reviewsRepo;
		
		public function __construct()
		{
			$this->roomsRepo = app(RoomsRepository::class);
			$this->reviewsRepo = app(ReviewsRepository::class);
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
					'text' => 'Ррегистрация 24/7',
				],
			];
			
			$galleryItems = $this->roomsRepo->allActive();
			$rooms = $this->roomsRepo->findByType('room');
			$reviews = $this->reviewsRepo->all();
			
			return view('layouts.index', [
				'advantages'   => $advantages,
				'galleryItems' => $galleryItems,
				'rooms'        => $rooms,
				'reviews'      => $reviews,
			]);
		}
		
		public function contactRequest(Request $request)
		{
			$entity = new MailEntity($request->all());
			
			try {
				Mail::to('fatboy_slim@mail.ru')->send(new ContactRequest($entity));
				
				session()->flash('message', 'Мы успешно приняли ваш запрос и перезвоним вам в ближайшее время.');
				
				return redirect(url('/#contacts'), 301);
			} catch (\Exception $error) {
				session()->flash('color', 'danger');
				session()->flash('message', 'Во время отправки сообщения произошла ошибка.');
				
				return redirect(url('/#contacts'), 301);
			}
		}
	}
