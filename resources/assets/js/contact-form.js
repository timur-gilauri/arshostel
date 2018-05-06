window.addEventListener('load', function () {
    let form = $('#contacts-form');
    let submitBtn = $('#submit-btn');
    let messageBlock = $('#contact-form-message');


    submitBtn.not(':disabled').click(function (e) {
        if (!form.get(0).reportValidity()) {
            return false;
        }
        grecaptcha.execute();
        let data = form.serialize();
        let url = `${window.location.origin}/contact-request`;

        messageBlock.slideUp(100);

        form.find('input, textarea, button').attr('disabled', true);

        axios.post(url, data, {})
            .then(response => {
                let message = response.data.message;
                let success = response.data.success;
                let color = success ? 'success' : 'danger';

                messageBlock
                    .addClass(`alert-${color}`)
                    .text(message)
                    .slideDown(200, 'linear', function () {
                        setTimeout(function () {
                            messageBlock.slideUp(200);
                        }, 5000);
                    });

                form.trigger('reset');
                form.find('input, textarea, button').attr('disabled', false);
            })
    })
});