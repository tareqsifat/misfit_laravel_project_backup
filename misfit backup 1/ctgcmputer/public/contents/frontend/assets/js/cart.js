
async function addToCart(product_id, qty = 1, show_toast = true) {

    await fetch("/add_to_cart", {
        method: "POST",
        headers: {
            "content-type": "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify({
            id: product_id,
            qty: qty,
        })
    }).then(async res => {
        let response = {}
        response.status = res.status
        response.data = await res.json();
        return response;
    }).then(res => {
        if (res.status === 200) {
            let product = res.data.cart.find(i => i.product.id == product_id);
            if (product) {
                $(`#${product_id}_cart_total`).html(product.price * product.qty);
            }
            $(".header_cart_count").html(res.data.cart_count);
            $("#cart_total").html(res.data.cart_total_formated);

            if (show_toast) {
                window.s_alert("success", res.data.message);
            }

            // fb_add_to_cart();
        }
    })
}

function up_qty(type = "inc", product_id = "") {
    let el = "";
    let qty = 1;

    if (type == "inc") {
        el = event.currentTarget.previousElementSibling;
        qty = +el.value + 1;
    } else {
        el = event.currentTarget.nextElementSibling;
        qty = +el.value - 1;
    }

    if (qty >= 1) {
        el.value = qty;
        addToCart(product_id, qty);
    }
}

function quick_view_add_to_cart(product_id) {
    Livewire.emit('viewProduct', product);
}

function checkout(event) {
    event.preventDefault();

    if(!confirm('complete order')){
        return 0;
    }

    let formData = new FormData(event.target);
    let city = ``;
    city += 'division: '+window.divisions.find(i=>i.id == $('#divisions').val()).name;
    city += ', district: '+window.districts.find(i=>i.id == $('#districts').val()).name;
    // city += ', upazila: '+window.upazilas.find(i=>i.id == $('#upazilas').val()).name;
    // city += ', union: '+window.unions.find(i=>i.id == $('#unions').val()).name;
    city += ', police station: '+$('#police_stations').val();
    city += ', area: '+$('input[name="address"]').val();
    formData.append('city', city);
    formData.append('shipping_method', $("input[name='shipping_method']:checked").val());

    fetch("/checkout", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: formData
    }).then(async res => {
        let response = {}
        response.status = res.status
        response.data = await res.json();
        return response;
    }).then(res => {
        if(res.status === 422) {
            render_error(res.data.data)
        }
        if(res.status === 200) {
            location.href = "/order-complete/"+res.data.order.id;
        }
    })
}

function change_bkash() {
    $('#bkash_section').removeClass('d-none');
    $('#bank_section').addClass('d-none');
    $('#bkash_number').attr('required');
    $('#bkash_trx_id').attr('required');
}

function change_bank_transfer() {
    $('#bkash_section').addClass('d-none');
    $('#bank_section').removeClass('d-none');
    $('#bank_ac_no').attr('required');
    $('#bank_trx_no').attr('required');
}

function change_cod() {
    $('#bkash_section').addClass('d-none');
    $('#bank_section').addClass('d-none');
}



window.divisions = [];
window.districts = [];
window.upazilas = [];
window.unions = [];
window.police_stations = [];

async function load_data(type) {
    var res = await fetch(`/jsons/${type}.json`)
    var data = await res.json();
    if(Array.isArray(data)){
        data = data?.map(i => ({ ...i, text: i.bn_name }))
    }
    window[type] = data;
}

async function init_division() {
    await load_data('divisions');
    await load_data('districts');
    await load_data('upazilas');
    await load_data('unions');
    await load_data('police_stations');
    setTimeout(() => {
        get_divisions();
    }, 200);
}

async function get_divisions() {
    var data = window.divisions;
    $('#divisions').select2({
        data,
    })
        .val([6]).trigger('change')
        .on('select2:select', function (e) {
            let value = e.target.value;
            get_districts(value);
            if (value != 6) {
                $('#home_delivery').prop('checked', false);
                $('#outside_dhaka').prop('checked', true);
                $('#outside_dhaka').trigger('change');
            } else {
                $('#outside_dhaka').prop('checked', false);
                $('#home_delivery').prop('checked', true);
                $('#home_delivery').trigger('change');
            }

        });
    get_districts();
}

async function get_districts(divistion = 6) {
    var data = window.districts.filter(i => i.division_id == divistion);
    data = data.map(i => ({ ...i, text: i.bn_name }));

    $('#districts').html('').select2().select2("destroy");
    $('#districts').select2({
        data,
    })
        .val([data[7]?.id || data[0].id]).trigger('change')
        .on('select2:select', function (e) {
            let value = e.target.value;
            // console.log(value);
            // get_upazilas(value);
            get_police_stations(data.find(i=>i.id==value)?.name || '');

            if (value != 47) {
                $('#home_delivery').prop('checked', false);
                $('#outside_dhaka').prop('checked', true);
                $('#outside_dhaka').trigger('change');
            } else {
                $('#outside_dhaka').prop('checked', false);
                $('#home_delivery').prop('checked', true);
                $('#home_delivery').trigger('change');
            }
        });
    // get_upazilas(data[7]?.id || data[0].id);
    get_police_stations(data[7]?.name || data[0].name);
}

async function get_police_stations(district_name) {
    var data = [];
    for (const key in window.police_stations) {
        if (Object.hasOwnProperty.call(window.police_stations, key)) {
            const stations = window.police_stations[key];
            if(key.includes(district_name)){
                data = stations
            }
        }
    }
    data = data.map(i => ({ id: i, text: i }));
    if(data.length == 0){
        data[0] = {id: "Enter police station name", text: "Enter police station name"}
    }

    $('#police_stations').html('').select2().select2("destroy");
    $('#police_stations').select2({
        data,
        tags: true,
    })
        .val([data[0]?.id]).trigger('change')
        .on('select2:select', function (e) {
            let value = e.target.value;
            console.log(value);
        });
}

async function get_upazilas(district = 1) {
    var data = window.upazilas.filter(i => i.district_id == district);
    data = data.map(i => ({ ...i, text: i.bn_name }))

    $('#upazilas').html('').select2().select2("destroy");
    $('#upazilas').select2({
        data,
    })
        .val([data[0].id]).trigger('change')
        .on('select2:select', function (e) {
            let value = e.target.value;
            get_unions(value);
        });
    get_unions(data[0].id)
}

async function get_unions(upazila = 1) {
    var data = window.unions.filter(i => i.upazilla_id == upazila);
    data = data.map(i => ({ ...i, text: i.bn_name }))

    $('#unions').html('').select2().select2("destroy");
    $('#unions').select2({
        data,
    })
        .val([data[0].id]).trigger('change')
        .on('select2:select', function (e) {
            let value = e.target.value;
        });
}
