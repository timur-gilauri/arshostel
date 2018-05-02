<section id="gallery">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-10">
                <h2>Наши номера</h2>
            </div>
        </div>

        <div class="row justify-content-center bx-slider-container">
            <div class="col">
                <ul class="gallery list-unstyled">
                    @foreach($galleryItems as $item)
                        <li class="gallery-item">
                            <a href="{{$item->getImage()->url()}}" data-fancybox="rooms">
                                <img src="{{$item->getImage()->url('thumb')}}"
                                     height="250"
                                     width="250"
                                     alt=""
                                     class="gallery-item__img">
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="small-controls bx-controls">
                    <div class="bx-controls-direction">
                        <div class="small-control bx-prev gallery-bx-prev"></div>
                        <div class="small-control bx-next gallery-bx-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>