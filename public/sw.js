var CACHE = 'uaera-v1';

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

// استقبال Push من السيرفر وإظهار الإشعار حتى لو التطبيق مغلق
self.addEventListener('push', function(e) {
    var data = {};
    try { data = e.data ? e.data.json() : {}; } catch(err) {}

    var title   = data.title || 'جمعية الإمارات للمتقاعدين';
    var options = {
        body:    data.body  || 'لديك إشعار جديد',
        icon:    data.icon  || '/assets/images/new-logo.png',
        badge:   '/assets/images/new-logo.png',
        dir:     'rtl',
        lang:    'ar',
        data:    { url: data.url || '/' }
    };

    e.waitUntil(self.registration.showNotification(title, options));
});

// فتح الرابط عند الضغط على الإشعار
self.addEventListener('notificationclick', function(e) {
    e.notification.close();
    var url = e.notification.data && e.notification.data.url ? e.notification.data.url : '/';
    e.waitUntil(clients.openWindow(url));
});
