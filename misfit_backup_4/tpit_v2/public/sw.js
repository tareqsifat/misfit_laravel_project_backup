self.importScripts('/js/plugins/localforage.min.js');

var asset_cache = 'asset_cache';
var precachedAssets = [
    '/',
    '/part-66-module-examination',
    '/css/plugins/bootstrap.css',
    '/frontend/assets/styles/style.css',
    '/js/plugins/axios.js',
    '/js/plugins/localforage.min.js',
    '/js/plugins/sweetalert.js',
    '/js/plugins/turbolinks.min.js',
    '/js/frontend.js',
    '/logo.jpg',
    '/logo.png',
    '/favicon.ico',
    '/favicon.png',
    '/manifest.json',
    '/main.js',
    '/sw.js',
];


/* Start the service worker and cache all of the app's content */
self.addEventListener('install', function (e) {
    e.waitUntil(
        caches.open(asset_cache).then(async function (cache) {
            return cache.addAll(precachedAssets);
        })
    );
    self.skipWaiting();
});


self.addEventListener('fetch', function (e) {
    const url = new URL(e.request.url);
    const isPrecachedRequest = precachedAssets.includes(url.pathname);
    const destination = e.request.destination;

    if (isPrecachedRequest) {
        return get_pre_cached(e);
    }

    switch (destination) {
        case "image":
            return response_and_store_cache(e, "image_cache");
        case "font":
            return response_and_store_cache(e, "font_cache");
        default:
            if (url.pathname == '/todos') {
                return response_and_store_cache(e, "api_cache", "stale_while_revalidate");
            }
            return response_and_store_cache(e, "extra_cache");
    }
});

function get_pre_cached(e) {
    e.respondWith(caches.open(asset_cache)
        .then((cache) => {
            return cache.match(e.request.url);
        })
    );
}

const response_and_store_cache = (e, cache_name, strategy) => {
    e.respondWith(caches.open(cache_name)
        .then((cache) => cache.match(e.request)
            .then((cachedResponse) => {

                function PreFetchedResponse(e) {
                    return fetch(e.request)
                        .then((fetchedResponse) => {
                            // if in same url then cache
                            let url = new URL(e.request.url);
                            if (url.origin === location.origin && e.request.method === "GET") {
                                // cache.put(e.request, fetchedResponse.clone());
                            }
                            return fetchedResponse;
                        });
                }

                if (strategy === "stale_while_revalidate") {
                    var pre_response = PreFetchedResponse(e);
                    return cachedResponse || pre_response;
                }

                if (cachedResponse) {
                    return cachedResponse;
                }

                return PreFetchedResponse(e);
            }))
    );
    return
}

async function post_data() {
    var data = await localforage.getItem("submit_application");

    let res = await fetch('/api/tests', {
        method: "POST",
        headers: {
            "content-type": "application/json",
        },
        body: JSON.stringify(data),
    })

    let resdata = await res.json();
    console.log(resdata);
}

self.addEventListener('sync', event => {

    let BACKGROUND_sync = "test_demo_sync"
    if (event.tag === BACKGROUND_sync) {
        event.waitUntil((async () => {
            await post_data();

            await localforage.removeItem("submit_application");

            // Let the user know, if they granted permissions before.
            self.registration.showNotification(`Your data is submitted`, {
                icon: '/logo.png',
                body: 'You can access the list of movies in the app',
                actions: [
                    {
                        action: 'view-results',
                        title: 'Open app'
                    }
                ]
            });
        })());
    }
});


// Respond to a server push with a user notification.
self.addEventListener('push', function (event) {
    if (Notification.permission === "granted") {
        const notificationText = event.data.text();
        const showNotification = self.registration.showNotification('Sample PWA', {
            body: notificationText,
            icon: '/logo.png'
        });
        // Make sure the toast notification is displayed.
        event.waitUntil(showNotification);
    }
});

// Respond to the user selecting the toast notification.
self.addEventListener('notificationclick', function (event) {
    console.log('On notification click: ', event.notification.tag);
    event.notification.close();

    // Display the current notification if it is already open, and then put focus on it.
    event.waitUntil(clients.matchAll({
        type: 'window'
    }).then(function (clientList) {
        for (var i = 0; i < clientList.length; i++) {
            var client = clientList[i];
            if (client.url == 'http://127.0.0.1:8000/' && 'focus' in client)
                return client.focus();
        }
        if (clients.openWindow)
            return clients.openWindow('/');
    }));
});

async function getDemoData() {
    let res = await fetch("/api/demodata");
    let data = await res.json();
    console.log(data);
    let saved_data = await localforage.getItem('periodic_demo_data');
    if (!saved_data) {
        saved_data = [];
    } else {
        saved_data = JSON.parse(saved_data);
    }
    saved_data.push(data);
    await localforage.setItem("periodic_demo_data", JSON.stringify(saved_data));

    const cache = await caches.open('periodic_demo_data');
    await cache.put('/api/demodata', new Response(JSON.stringify(data)));
}

self.addEventListener('periodicsync', event => {
    console.log(event.tag);
    if (event.tag === 'get-daily-news') {
        event.waitUntil(getDemoData());
    }
});
