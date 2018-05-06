<section id="rooms">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h2>Наши номера</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <div class="owl-carousel owl-theme rooms">
                    @foreach($rooms as $room)
                        <div class="item">
                            <a href="{{$room->getImage()->url('full')}}"
                               class="rooms-item__image"
                               data-slider="rooms"
                               data-caption="{{$room->getTitle() . ' - ' . $room->getPrice() . '₽ / за ночь'}}">
                                <img src="{{$room->getImage()->url('thumb')}}" alt="{{$room->getTitle()}}">
                            </a>
                            <div class="desc text-center">
                                <h3>{{$room->getTitle()}}</h3>
                                <p class="price">
                                    <span class="currency">₽</span>
                                    <span class="price-room">{{$room->getPrice()}}</span>
                                    <span class="per">/ за ночь</span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>