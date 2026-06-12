var CACHE = 'uaera-v4';

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
            if (d.title) title = d.title;
            if (d.body)  body  = d.body;
            if (d.url)   url   = d.url;
        }
    } catch (err) {}

    // بدون icon/badge لتفادي فشل showNotification
    e.waitUntil(
        self.registration.showNotification(title, {
            body: body,
            dir:  'rtl',
            lang: 'ar',
            tag:  'uaer-push',
            data: { url: url }
        })
    );
});

self.addEventListener('notificationclick', function(e) {
    e.notification.close();
    var url = (e.notification.data && e.notification.data.url) ? e.notification.data.url : '/';
    e.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then(function(list) {
            for (var i = 0; i < list.length; i++) {
                if ('focus' in list[i]) return list[i].focus();
            }
            return clients.openWindow(url);
        })
    );
});
