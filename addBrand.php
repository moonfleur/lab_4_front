<?php include 'elements/header.php' ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Додавання нового бренду</div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger message_notification alert-dismissible" style="display: none;" role="alert">
                                    <span class='notification_text'><!--notification_text--></span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <form method="POST" id="add_brand_form">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Назва</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Додати
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'elements/scripts.php' ?>
    <script>
        $(function () {
            $('#add_brand_form').on('submit', function (event) {
                event.preventDefault();

                var data = {
                    'name': $('#name').val(),
                };

                $.ajax({
                    url: 'http://lab4-back.loc/addBrand.php',
                    method: 'POST',
                    data: data
                })
                .done(function (response) {
                    response = JSON.parse(response);
                    var notification_text = '';

                    $('.message_notification .notification_text').html('');
                    $.each(response.messages, function (index, element) {
                        notification_text += '<li>' + element + '</li>';
                    });
                    $('.message_notification .notification_text').append('<ul style="margin-bottom: 0;">' + notification_text + '</ul>');

                    if(response['status'] === 'success') {
                        $('.message_notification').removeClass('alert-danger').addClass('alert-success').show();
                        $('#name').val('');
                    } else {
                        $('.message_notification').removeClass('alert-success').addClass('alert-danger').show();
                    }
                })
            })
        });
    </script>

<?php include 'elements/footer.php' ?>