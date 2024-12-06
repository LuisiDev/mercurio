var staticCacheName = 'pwa';
var contentToCache = ["/",  // Significa que todo el contenido de la raíz de la web será almacenado en la cache
    "/*", // Significa que todo el contenido de la web será almacenado en la cache
];

self.addEventListener('install', function(e) {
    e.waitUntil(
        caches.open(staticCacheName).then(function(cache){
            return cache.addAll(contentToCache);
        })
    );
});

self.addEventListener('fetch', function(e){ // Evento que se dispara cada vez que se realiza una petición a la web
    e.respondWith(
        caches.match(e.request).then(function(response){
            return response || fetch(e.request).then(function(respuesta){
                return caches.open(staticCacheName).then(function(cache){
                    cache.put(e.request, respuesta.clone());
                    return respuesta;
                })
            })
        })
    )    
});