<?php
	
	namespace App\Http\Controllers;
	
	use App\Entities\RoomEntity;
	use App\Repositories\RoomsRepository;
	use Illuminate\Http\Request;
	
	class RoomsController extends Controller
	{
		/** @var RoomsRepository */
		protected $repo;
		
		/**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct()
		{
			$this->repo = app(RoomsRepository::class);
		}
		
		/**
		 * Show the application dashboard.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index(Request $request)
		{
			$items = $this->repo->all();
			
			return view('administrator.rooms.index', [
				'title' => 'Все комнаты',
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
			return view('administrator.rooms.edit', [
				'title' => 'Добавить комнату',
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
				session()->flash('message', 'Комната с этим id не найдена');
				
				return redirect(route('admin::rooms::index'), 301);
			}
			
			return view('administrator.rooms.edit', [
				'title' => 'Редактировать комнату',
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
				'title' => 'required|string|max:255',
				'type'  => 'required|string|max:255',
				'beds'  => 'required|numeric|max:8',
				'price' => 'required|numeric',
				'image' => !$id ? 'required|file' : '',
			]);
			
			$entity = $id ? $this->repo->find((int)$id) : new RoomEntity();
			
			$entity->setTitle($request->get('title'));
			$entity->setType($request->get('type'));
			$entity->setDescription($request->get('description'));
			$entity->setBeds($request->get('beds'));
			$entity->setBedsAvailable($request->get('beds_available'));
			$entity->setPrice($request->get('price'));
			$entity->setAvailable($request->get('available') ? 1 : 0);
			
			if ($request->hasFile('image')) {
				$entity->setImage($request->file('image'));
			} else {
				if (!$entity->getId()) {
					
					return redirect()->back()->withErrors('Изображение не задано');
				}
			}
			
			if ($this->repo->save($entity)) {
				session()->flash('message', 'Комната успешно сохранена');
				
				return redirect(route('admin::rooms::index'));
			} else {
				session()->flash('errors', 'Произошла ошибка при сохранении комнаты');
				
				return redirect(route('admin::rooms::index'));
			}
		}
		
		public function delete(Request $request)
		{
			$id = $request->route('id');
			
			$item = $this->repo->find($id);
			
			if (!$item) {
				session()->flash('color', 'danger');
				session()->flash('message', 'Комната с данным id не найдена.');
			}
			if ($this->repo->delete($item)) {
				session()->flash('message', 'Комната удалена.');
				
				return redirect(route('admin::rooms::index'), 301);
			} else {
				session()->flash('color', 'danger');
				session()->flash('message', 'Произошла ошибка при удалении комнаты.');
				
				return redirect(route('admin::rooms::index'), 301);
			}
		}
	}
