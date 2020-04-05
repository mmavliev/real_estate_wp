<form class="add">
    <h6>Добавить недвижимость</h6>
    <div class="form-group">
        <label for="exampleInputEmail1">Название </label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Тип недвижимости </label>
        <input type="text" class="form-control" name="estate-type">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Город</label>
        <input type="text" class="form-control" name="city">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Адрес </label>
        <input type="text" class="form-control" id="adress" name="address">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Площадь </label>
        <input type="number" class="form-control" name="square">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Жилая площадь </label>
        <input type="number" class="form-control" name="live-square">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Стоимость </label>
        <input type="text" class="form-control" name="price">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Этаж </label>
        <input type="number" class="form-control" name="floor">
    </div>
    <p id="error" class="alert alert-danger" style="display:none">Заполните все поля</p>
    <button type="button" class="btn btn-primary" id="add-real">Отправить</button>
</form>

<script>
    (function ($) {
        $("#add-real").click(function () {
            $("#error").hide();
            let noerror = true;

            $('.add input').each(function () {
                if (!$(this).val()) {
                    $("#error").show();
                    noerror = false;
                    return false;
                }
            });
            if(noerror){
            var data = {
                action: 'add_real',
            };
            $.each($(".add").serializeArray(), function (i, kv) {
                data[kv.name] = kv.value;
            });
            $.post("<?php echo admin_url("admin-ajax.php ") ?>", data,
                function () {
                    $("form").empty().append(
                        `<div class="alert alert-success">Успешно отправлено!</div>`);
                });
            }
        })
    }(jQuery));
</script>