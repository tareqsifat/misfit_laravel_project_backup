const { default: axios } = require("axios");
let per_page = 4;

function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();

    if(window.innerWidth <= 575){
        let check = (
            rect.top >= 0 &&
            rect.bottom >= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right >= (window.innerWidth || document.documentElement.clientWidth)
        );
        return check;
    }
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}



window.home_cat_load_api_page_content = async function (api, cat_id) {
    event.preventDefault();
    if (api) {
        $(`#home_cat_section${cat_id} .cat_products_items`).fadeOut();
        let res = await axios.get(api + '&perpage='+per_page);
        let home_cat_section = document.querySelector('#home_cat_section' + cat_id +' .cat_products_items');
        let home_cat_nav = document.getElementById('home_cat_nav' + cat_id);
        if (home_cat_section) {
            home_cat_section.innerHTML = res.data.products;
            $(`#home_cat_section${cat_id} .cat_products_items`).fadeIn();
        }
        if (home_cat_nav && res.data.api_pagination) {
            home_cat_nav.innerHTML = "";
            let url = res.data.api_pagination.prev_page_url;
            if (url) {
                home_cat_nav.innerHTML = `
                    <a onclick="window.home_cat_load_api_page_content('${url || ''}', ${cat_id})" href="${url || '#'}" class="btn btn-sm "><i class="fa fa-angle-left"></i></a>
                `;
            }
            url = res.data.api_pagination.next_page_url;
            if (url) {
                home_cat_nav.innerHTML += `
                    <a onclick="window.home_cat_load_api_page_content('${url || ''}', ${cat_id})" href="${url || '#'}" class="btn btn-sm "><i class="fa fa-angle-right"></i></a>
                `;
            }
        }
    }
}


window.load_home_cat_section = function () {
    if (window.location.pathname == "/" || window.location.pathname == "") {
        window.addEventListener('scroll', function () {
            var scrollPosition = window.scrollY;
            var home_cat_sections = this.document.querySelectorAll('.home_cat_section');
            [...home_cat_sections].forEach(async el => {
                let scroll_height = el.offsetTop;

                if (isElementInViewport(el)) {
                    if (!el.dataset.loaded) {
                        el.dataset.loaded = 1;
                        // console.log(el.dataset.category, scroll_height, scrollPosition);
                        let cat_id = el.dataset.category;
                        let res = await axios.get('/api/v1/category/' + cat_id + '/cat?perpage='+per_page);
                        let home_cat_section = document.querySelector('#home_cat_section' + cat_id +' .cat_products_items');
                        let home_cat_nav = document.querySelector('#home_cat_nav' + cat_id);
                        if (home_cat_section) {
                            home_cat_section.innerHTML = res.data.products;
                        }
                        if (home_cat_nav && res.data.api_pagination) {
                            home_cat_nav.innerHTML = "";
                            let url = res.data.api_pagination.prev_page_url;
                            if (url) {
                                home_cat_nav.innerHTML = `
                                    <a onclick="window.home_cat_load_api_page_content('${url || ''}', ${cat_id})" href="${url || '#'}" class="btn btn-sm "><i class="fa fa-angle-left"></i></a>
                                `;
                            }
                            url = res.data.api_pagination.next_page_url;
                            if (url) {
                                home_cat_nav.innerHTML += `
                                    <a onclick="window.home_cat_load_api_page_content('${url || ''}', ${cat_id})" href="${url || '#'}" class="btn btn-sm "><i class="fa fa-angle-right"></i></a>
                                `;
                            }
                        }
                    }
                }
            })
        });
    }

}
