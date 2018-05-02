@if(isset($advantages))
    <section id="advantages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col col-md-10">
                    <h2>Что мы предлагаем</h2>
                </div>
            </div>

            <div class="row justify-content-center advantages">
                @foreach($advantages as $advantage)
                    <div class="col-md-4 col-6 text-center mb-4 advantages-item">
                        <div class="rounded-circle d-block mx-auto advantages-item__img">
                            <i class="icon-{{$advantage['icon']}}"></i>
                        </div>
                        <h3 class="advantages-item__text title">{{$advantage['text']}}</h3>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif