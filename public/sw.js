var CACHE = 'uaera-v5';

self.addEventListener('install', function(e) {
    self.skipWaiting();
});

self.addEventListener('activate', function(e) {
    e.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', function(e) {
    if (e.request.method !== 'GET') return;
    e.respondWith(fetch(e.request).catch(function() {
        return caches.match(e.request);
    }));
});

self.addEventListener('push', function(e) {
    var title = 'جمعية الإمارات للمتقاعدين';
    var body  = 'لديك إشعار جديد';
    var url   = '/';

    try {
        if (e.data) {
            var d = e.data.json();
            title = d.title || title;
            body  = d.body  || body;
            url   = d.url   || url;
        }
    } catch(err) {}

    e.waitUntil(
        self.registration.showNotification(title, { body: body, data: { url: url } })
    );
});

self.addEventListener('notificationclick', function(e) {
    e.notification.close();
    var url = e.notification.data ? e.notification.data.url : '/';
    e.waitUntil(clients.openWindow(url));
});
