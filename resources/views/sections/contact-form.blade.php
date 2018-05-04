<section id="contacts">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-10">
                <h2>Напишите нам</h2>
                <h3>МЫ СВЯЖЕМСЯ С ВАМИ И ВСЕ ПОДРОБНО РАССКАЖЕМ</h3>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col col-md-8">
                @include('blocks.session-message')
                <form id="contacts-form" action="{{route('contacts')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-row form-group">
                        <div class="col-12 col-md-4">
                            <input type="text"
                                   class="form-control form-control-lg"
                                   id="name"
                                   name="name"
                                   placeholder="Имя"
                                   required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    Поле "Имя" должно быть заполнено
                                </div>
                            @endif
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="email"
                                   class="form-control form-control-lg"
                                   id="email"
                                   name="email"
                                   placeholder="Email"
                                   required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    Поле "Email" должно быть заполнено
                                </div>
                            @endif
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text"
                                   class="form-control form-control-lg"
                                   id="phone"
                                   name="phone"
                                   placeholder="Телефон"
                                   required>
                            @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    Поле "Телефон" должно быть заполнено
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control form-control-lg"
                                  id="message"
                                  name="message"
                                  rows="3"
                                  placeholder="Сообщение"></textarea>
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="button submit-button">Забронировать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>