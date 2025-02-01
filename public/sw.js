self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open('event-reminder-v1').then((cache) => {
            return cache.addAll([
                '/',
                `/build/assets/app-Xaw6OIO1.js`,
                `/build/assets/app-BE6pjQnU.css`
            ]);
        })
    );
});

self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request).then((response) => {
            return response || fetch(event.request);
        })
    );
});
