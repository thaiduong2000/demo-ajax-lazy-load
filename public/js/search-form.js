models = {
    body: '.content__body',
    vehicle: {
        maker: 'vehicle--maker',
        initial: 'vehicle--initial',
        id: 'vehicle--id',
        model: '.model--box',
        step3: '.step3',
        vehicleBox: '.vehicle--box',
    },
    timeoutFunc: 0,
    api: {
        vehicle: '/search/api/vehicle',
        model: '/search/api/model',
    },
};

init = function () {
    $("img.lazy").lazyload({
        effect: "slideDown"
    });
    $(models.vehicle.step3).hide();

    var body = $(models.body);
    var getVehicle = function () {
        events.getVehicles();
    }
    body.find('[name=' + models.vehicle.maker + '], [name=' + models.vehicle.initial + ']')
        .on('change', debounce(getVehicle, 500));
};

events = {
    getVehicles: function () {
        var maker = methods.getValueInput(models.vehicle.maker);
        var initial = $('[name=' + models.vehicle.initial + ']:checked').val();
        if (maker && initial) {
            var callback = function (response) {
                $(models.vehicle.vehicleBox).hide();
                if (response.status) {
                    $(models.vehicle.vehicleBox).html(methods.vehicleRender(response.data));
                    $(models.vehicle.vehicleBox).fadeToggle(500);

                    var mincount = 1
                    var maxcount = $(".vehicle").length;
                    $(".vehicle--box .vehicle").slice(8).hide();
                    $(".scroll2").scroll(function () {
                        if ($(".scroll2").scrollTop() + $(".scroll2").height() >= $(".scroll2")[0].scrollHeight) {
                            $(".vehicle--box .vehicle").slice(mincount, maxcount).fadeIn(1000);
                        }
                    });
                }
            }
            events.getApi(models.api.vehicle, { maker, initial }, callback);
        }
    },
    getModels: function () {
        var vehicle = methods.getValueInput(models.vehicle.id);
        if (vehicle) {
            $(".vehicle").lazyload({
                effect: "fadeIn"
            });
            var callback = function (response) {
                $(models.vehicle.model).hide();
                $(models.vehicle.step3).show();
                if (response.status) {
                    $(models.vehicle.model).html(methods.modelRender(response.data));
                    $(models.vehicle.model).show();
                }
            }
            events.getApi(models.api.model, { vehicle }, callback);
        }
    },
    getApi: function (url, data, func) {
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            data: data,
            success: function (response) {
                func(response);
            }
        });
    }
};

methods = {
    getValueInput: function (name) {
        return $('[name=' + name + ']:checked').val();
    },
    vehicleRender: function (data) {
        return $.map(data, function (item) {
            var name = item.name_en ? item.name_en : '';
            return '<div class="vehicle"><input type="radio" name="vehicle--id"\n' +
                'onclick="events.getModels()"' +
                'value="' + item.id + '" >\n' +
                ' <label>' + name + '</label></div>';
        });
    },
    modelRender: function (data) {
        return $.map(data, function (item) {
            var name = item.name_en ? item.name_en : '';
            return '<div class="element"><input type="radio" name="model--id"\n' +
                'value="' + item.id + '" >\n' +
                ' <label>' + name + '</label></div>';

        });
    },
}
function debounce(func, wait) {
    return function () {
        var context = this, args = arguments;
        var later = function () {
            func.apply(context, args);
        };
        setTimeout(later, wait);
    };
};