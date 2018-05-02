<?php
	
	namespace App\Http\Controllers;
	
	use App\Entities\ReviewEntity;
	use App\Repositories\ReviewsRepository;
	use Illuminate\Http\Request;
	
	class ReviewsController extends Controller
	{
		/** @var ReviewsRepository */
		protected $repo;
		
		/**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct()
		{
			$this->middleware('auth');
			$this->repo = app(ReviewsRepository::class);
			parent::__construct();
		}
		
		/**
		 * Show the application dashboard.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index(Request $request)
		{
			$items = $this->repo->all();
			
			return view('administrator.reviews.index', [
				'title' => 'Все отзывы',
				'items' => $items,
			]);
		}
		
		/**
		 * @param Request $request
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function create(Request $request)
		{
			return view('administrator.reviews.edit', [
				'title' => 'Добавить отзыв',
			]);
		}
		
		/**
		 * @param Request $request
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
		 */
		public function edit(Request $request)
		{
			$id = $request->route('id');
			
			$item = $this->repo->find($id);
			
			if (!$item) {
				session()->flash('message', 'Отзыв с этим id не найден');
				
				return redirect(route('admin::reviews::index'), 301);
			}
			
			return view('administrator.reviews.edit', [
				'title' => 'Редактировать отзыв',
				'item'  => $item,
			]);
		}
		
		/**
		 * @param Request $request
		 *
		 * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function save(Request $request)
		{
			$id = $request->get('id', null);
			
			$this->validate($request, [
				'author_name' => 'required|string|max:255',
				'content'     => 'required|string',
			]);
			
			$entity = $id ? $this->repo->find((int)$id) : new ReviewEntity();
			
			$entity->setAuthorName($request->get('author_name'));
			$entity->setContent($request->get('content'));
			
			if ($this->repo->save($entity)) {
				session()->flash('message', 'Отзыв успешно сохранен');
				
				return redirect(route('admin::reviews::index'));
			} else {
				session()->flash('errors', 'Произошла ошибка при сохранении отзыва');
				
				return redirect(route('admin::reviews::index'));
			}
		}
		
		public function delete(Request $request)
		{
			$id = $request->route('id');
			
			$item = $this->repo->find($id);
			
			if (!$item) {
				session()->flash('color', 'danger');
				session()->flash('message', 'Отзыв с данным id не найден.');
			}
			if ($this->repo->delete($item)) {
				session()->flash('message', 'Отзыв удален.');
				
				return redirect(route('admin::reviews::index'), 301);
			} else {
				session()->flash('color', 'danger');
				session()->flash('message', 'Произошла ошибка при удалении отзыва.');
				
				return redirect(route('admin::reviews::index'), 301);
			}
		}
	}
