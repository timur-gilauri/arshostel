<section id="rooms">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h2>Наши номера</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 animate-box">
                <ul class="rooms list-unstyled">
                    @foreach($rooms as $room)
                        <li class="rooms-item">
                            <a href="{{$room->getImage()->url()}}"
                               class="rooms-item__image"
                               data-fancybox="rooms"
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
                        </li>
                    @endforeach
                </ul>
                <div class="small-controls bx-controls">
                    <div class="bx-controls-direction">
                        <div class="small-control bx-prev rooms-bx-prev"></div>
                        <div class="small-control bx-next rooms-bx-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>