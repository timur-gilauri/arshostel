<?php
	/**
	 * Created by PhpStorm.
	 * User: timur
	 * Date: 05.05.2018
	 * Time: 0:30
	 */
	
	namespace App\Http\Controllers;
	
	
	use App\Entities\MailEntity;
	use App\Mail\ContactRequest;
	use App\Repositories\ReviewsRepository;
	use App\Repositories\RoomsRepository;
	use Carbon\Carbon;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Cache;
	use Illuminate\Support\Facades\Mail;
	
	class FrontController
	{
		/** @var RoomsRepository */
		protected $roomsRepo;
		/** @var ReviewsRepository */
		protected $reviewsRepo;
		/** @var Carbon */
		protected $cacheExpiresAt;
		
		public function __construct()
		{
			$this->cacheExpiresAt = Carbon::now()->addHours(5);
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
			
			$galleryItems = Cache::remember('gallery.all', $this->cacheExpiresAt, function () {
				return $this->roomsRepo->allActive();
			});
			$rooms = Cache::remember('rooms.all', $this->cacheExpiresAt, function () {
				return $this->roomsRepo->findByType('room');
			});
			$reviews = Cache::remember('reviews.all', $this->cacheExpiresAt, function () {
				return $this->reviewsRepo->all();
			});
			
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
			
			$response = [
				'message' => 'Во время отправки сообщения произошла ошибка.',
				'success' => false,
			];
			
			try {
				Mail::to(env('MAIL_USERNAME'))->send(new ContactRequest($entity));
				
				$response['message'] = 'Мы успешно приняли ваш запрос и перезвоним вам в ближайшее время.';
				$response['success'] = true;
			} catch (\Exception $error) {
			}
			
			return $response;
		}
	}