Pusher.logToConsole = true;

const PUSHER_APP_KEY = window.my_pusher.app_key;
const PUSHER_CLUSTER = window.my_pusher.app_cluster;
const BASE_URL = window.my_pusher.base_url;

var pusher = new Pusher(PUSHER_APP_KEY, {
    cluster: PUSHER_CLUSTER,
});

const pusherConnection = (eventName, callback) => {
    pusher.connection.bind('connected', () => {
        const SOCKET_ID = pusher.connection.socket_id;
        const CHANNEL_NAME = `private-${eventName}`;
        pusher.config.authEndpoint = `${BASE_URL}/pusher/auth/${SOCKET_ID}/${CHANNEL_NAME}`;
        let channel = pusher.subscribe(CHANNEL_NAME);
        channel.bind('pusher:subscription_succeeded', function () {
            channel.bind(eventName, function (data) {
                callback(data);
            })
        });
    });
};

function marketChangeHtml(data) {
    $.each(data.marketData, function (i, marketData) {
        marketData = JSON.parse(marketData);
        let htmlClass = marketData.html_classes;
        $(`body`).find(`.market-price-${marketData.id}`).text(showAmount(marketData.price)).removeClass('up down').addClass(htmlClass.price_change);
        $(`body`).find(`.market-price-symbol-${marketData.id}`).removeClass('up down').addClass(htmlClass.price_change);
        if ($(`body`).find(`.price-icon-${marketData.id}`).length > 0) {
            $(`body`).find(`.price-icon-${marketData.id}`).removeClass('up down').addClass(htmlClass.price_change);
            if (htmlClass.price_change == 'up') {
                $(`body`).find(`.price-icon-${marketData.id} i`).removeClass('fa-arrow-down').addClass('fa-arrow-up');
            }else{
                $(`body`).find(`.price-icon-${marketData.id} i`).removeClass('fa-arrow-up').addClass('fa-arrow-down');
            }
        }

        $(`body`).find(`.market-last-price-${marketData.id}`).text(showAmount(marketData.last_price));
        $(`body`).find(`.market-percent-change-1h-${marketData.id}`).text(showAmount(marketData.percent_change_1h, 2) + '%').removeClass('up down').addClass(htmlClass.percent_change_1h);
        $(`body`).find(`.market-percent-change-24h-${marketData.id}`).text(showAmount(marketData.percent_change_24h, 2) + '%').removeClass('up down').addClass(htmlClass.percent_change_24h);
        $(`body`).find(`.market-market_cap-${marketData.id}`).text(showAmount(marketData.market_cap));
    });
}
