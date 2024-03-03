const { default: axios } = require("axios");

window.render_top_deals_product = async function (page=1) {
    let big_deals_slide = document.getElementById('big_deals_slide');
    if (big_deals_slide) {
        $('#big_deals_slide > div').fadeOut();
        let res = await axios.get('/api/v1/top-products?' + `page=${page}&take=1`);
        big_deals_slide.innerHTML = res.data.data;
        $('#big_deals_slide > div').fadeIn();
        // setTimeout(() => {
        // }, 1000);
        return 1;
    }

    return 0;
}
window.get_top_deals_product = async function () {
    let target = event.target;
    let page = +target.dataset.page;
    let data = await window.render_top_deals_product(page);
    if (data) {
        target.dataset.page = page + 1;
    }
}
