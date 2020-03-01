<?php include 'elements/header.php' ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <form class="form-inline" id="search_form">
                    <div class="form-group mb-2 mr-2">
                        <label for="search_value" class="sr-only">Пошук</label>
                        <input type="text" class="form-control" id="search_value">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Знайти</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-10"><div class="text-muted">Марки автомобілів в яких нема моделей не будуть відображені!</div></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <table class="table" id="cars_table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Бренд</th>
                        <th scope="col">Модель</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include 'elements/scripts.php' ?>
    <script>
        $(function () {
            getCarBrands();

            $('#search_form').on('submit', function (event) {
                event.preventDefault();

                var search_value = $('#search_value').val();
                getCarBrands(search_value);
            });

            function getCarBrands(search_value) {
                $.ajax({
                    url: 'http://lab4-back.loc/index.php',
                    method: 'GET',
                    data: {
                        filter: search_value
                    }
                })
                    .done(function (response) {
                        response = JSON.parse(response);

                        $('#cars_table tbody').html('');
                        $.each(response, function (index, element) {
                            $('#cars_table tbody').append(`
                                <tr>
                                    <th scope="row">${element['id']}</th>
                                    <td>${element['name']}</td>
                                    <td>${element['model_name']}</td>
                                </tr>
                            `);
                        });
                    })
            }
        });
    </script>

<?php include 'elements/footer.php' ?>