var top_product_page = 1;
window.load_top_products = async function (page = 1) {
    var home_top_products = document.getElementById('home_top_products');
    var top_product_load_btn = document.querySelector('.top_product_load_btn');

    if (home_top_products) {
        top_product_load_btn.disabled = true;
        await fetch(`/api/v1/top-products?page=${page}`)
            .then(res => res.json())
            .then(res => home_top_products.innerHTML += res.data);
        top_product_page = page + 1;
        top_product_load_btn.disabled = false;
    }
}

window.load_category_product = async function () {
    console.log('called');
    let category_products_paginations = document.getElementById('category_products_paginations');
    let category_product_list = document.getElementById('category_product_list');
    let url = new URL(location.href);
    if (!url.searchParams.get('page')) {
        url.searchParams.set('page', 1);
    }

    if (!category_product_list) {
        return 0;
    }

    await fetch(`/api/v1` + url.pathname + "?" + url.searchParams.toString(), {
        headers: {
            "Content-Type": "application/json"
        }
    })
        .then(res => res.json())
        .then(async res => {
            if (category_products_paginations) {
                category_products_paginations.innerHTML = res.links;
            }
            if (category_product_list) {
                category_product_list.innerHTML = res.products;
            }
            if (res.products) {
                init_pagination_active();
                await load_category_product_brands(res.category.id);
            }
        });
}

window.load_category_product_brands = async function (category_id) {
    let brand_list = document.getElementById('brand_list');
    let varient_list = document.getElementById('varient_list');
    let categories_and_brands = document.getElementById('categories_and_brands');
    let url = new URL(location.href);
    await fetch(`/api/v1/category-products/${category_id}/brands?` + url.searchParams.toString())
        .then(res => res.json())
        .then(res => {
            brand_list.innerHTML = res.data;
            varient_list.innerHTML = res.varient;
            // let unique_brand_list = res.brands.filter((d,i)=>res.brands.indexOf(d)===i);
            // categories_and_brands.innerHTML += unique_brand_list.map(i => `<a href="/${i.url}">${i.name}</a>`).join('')
        });
}

window.init_pagination_active = function () {
    [...document.querySelectorAll('#category_products_paginations a')].forEach((el) => {
        el.onclick = function (e) {
            e.preventDefault();
            var url = new URL(e.target.href);
            window.history.pushState({ path: url.href }, '', url.href);
            load_category_product();
            window.scrollTo(0, category_product_list.offsetTop - 120)
        }
    })
}

window.on_keyup_search = function () {
    console.log(event.target.value);
    let key = event.target.value;
    document.getElementById('search_result').innerHTML = "";
    if(key.length){
        fetch('/search-product/json?key=' + key)
            .then(res => res.text())
            .then(res => {
                document.getElementById('search_result').innerHTML = res;
            })
    }
}
