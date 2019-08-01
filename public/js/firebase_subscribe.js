// firebase_subscribe.js
firebase.initializeApp({
    messagingSenderId: '1004791964834'
});

// браузер поддерживает уведомления
// вообще, эту проверку должна делать библиотека Firebase, но она этого не делает
if ('Notification' in window) {
    var messaging = firebase.messaging();

    // пользователь уже разрешил получение уведомлений
    // подписываем на уведомления если ещё не подписали
    //TODO: add check for empty tokens
    if (Notification.permission === 'granted') {
        //subscribe();
    }

    // по клику, запрашиваем у пользователя разрешение на уведомления
    // и подписываем его
    $('#subscribe').on('click', function () {
        subscribe();
    });
}

function subscribe() {
    // запрашиваем разрешение на получение уведомлений
    messaging.requestPermission()
        .then(function () {
            // получаем ID устройства
            messaging.getToken()
                .then(function (currentToken) {
                    console.log(currentToken);

                    if (currentToken) {
                        sendTokenToServer(currentToken);
                    } else {
                        console.log('Не удалось получить токен.');
                        setTokenSentToServer(false);
                    }
                })
                .catch(function (err) {
                    console.log('При получении токена произошла ошибка.', err);
                    setTokenSentToServer(false);
                });
        })
        .catch(function (err) {
            console.log('Не удалось получить разрешение на показ уведомлений.', err);
        });
}

// отправка ID на сервер
function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer(currentToken)) {
        console.log('Отправка токена на сервер...');
        let targetLink = base_url + '/save-push-notification-token';
        loadingStart();
        $.ajax({
            url: targetLink,
            type: 'post',
            dataType: 'json',
            data: {
                token: currentToken
            },
            success: function(response){
            },
            error: function(){
                setTokenSentToServer(currentToken);
                showError('An error occurred. Please try again later.');
            },
            complete: function(){
                loadingEnd();
            }
        });
    } else {
        console.log('Токен уже отправлен на сервер.');
    }
}

// используем localStorage для отметки того,
// что пользователь уже подписался на уведомления
function isTokenSentToServer(currentToken) {
    return window.localStorage.getItem('sentFirebaseMessagingToken') == currentToken;
}

function setTokenSentToServer(currentToken) {
    window.localStorage.setItem(
        'sentFirebaseMessagingToken',
        currentToken ? currentToken : ''
    );
}

if ('Notification' in window) {
    var messaging = firebase.messaging();

    messaging.onMessage(function(payload) {
        console.log('Message received. ', payload);

        // регистрируем пустой ServiceWorker каждый раз
        /*messaging.onMessage(function(payload) {
            console.log('Message received. ', payload);
            new Notification(payload.notification.title, payload.notification);
        });*/

        navigator.serviceWorker.register('/firebase-messaging-sw.js');

        // запрашиваем права на показ уведомлений если еще не получили их
        Notification.requestPermission(function(result) {
            if (result === 'granted') {
                navigator.serviceWorker.ready.then(function(registration) {
                    // теперь мы можем показать уведомление
                    payload.notification.data = payload.notification; // параметры уведомления
                    return registration.showNotification(payload.notification.title, payload.notification);
                }).catch(function(error) {
                    console.log('ServiceWorker registration failed', error);
                });
            }
        });

    });

    // ...
}
