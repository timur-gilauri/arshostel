@if(isset($reviews) && $reviews)
    <section id="reviews">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col col-md-10">
                    <h2>Отзывы клиентов</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col">
                    <ul class="reviews list-unstyled">
                        @foreach($reviews as $review)
                            <li class="reviews-item">
                                <h4>{{$review->getAuthorName()}}</h4>
                                <p class="reviews-item__content">
                                    {{$review->getContent()}}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                    <div class="small-controls bx-controls">
                        <div class="bx-controls-direction">
                            <div class="small-control bx-prev reviews-bx-prev"></div>
                            <div class="small-control bx-next reviews-bx-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif