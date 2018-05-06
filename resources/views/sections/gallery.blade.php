<section id="gallery">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h2>Галерея</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col">
                <div class="gallery owl-carousel owl-theme">
                    @foreach($galleryItems as $item)
                        <div class="item">
                            <a href="{{$item->getImage()->url('full')}}"
                               data-fancybox="gallery"
                               data-caption="{{$item->getTitle()}}">
                                <img src="{{$item->getImage()->url('thumb')}}"
                                     height="250"
                                     width="250"
                                     alt=""
                                     class="gallery-item__img">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>