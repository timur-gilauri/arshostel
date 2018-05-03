@if(isset($reviews) && $reviews)
    <section id="reviews">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col col-md-10">
                    <h2>Отзывы клиентов</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col col-md-10">
                    <div class="reviews owl-carousel owl-theme">
                        @foreach($reviews as $review)
                            <div class="reviews-item">
                                <h4>{{$review->getAuthorName()}}</h4>
                                <p class="reviews-item__content">
                                    {{$review->getContent()}}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif