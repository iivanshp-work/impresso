// firebase_subscribe.js
firebase.initializeApp({
    messagingSenderId: '1004791964834'
});

// check if browser support notifications
if ('Notification' in window) {
    var messaging = firebase.messaging();

    // granted permission auto subscribe

    if (Notification.permission === 'granted') {
        subscribe();
    }

    //TODO: add check for empty tokens
    if (user_id && !window.localStorage.getItem('sentFirebaseMessagingToken')) {
        subscribe();
    }
}

function subscribe() {
    // request permission to receive notifications
    messaging.requestPermission()
        .then(function () {
            // getting device id
            messaging.getToken()
                .then(function (currentToken) {
                    console.log(currentToken);
                    if (currentToken) {
                        sendTokenToServer(currentToken);
                    } else {
                        console.log('can not getting token.');
                        setTokenSentToServer(false);
                    }
                })
                .catch(function (err) {
                    console.log('error while getting token.', err);
                    setTokenSentToServer(false);
                });
        })
        .catch(function (err) {
            console.log('Failed to get permission to show notifications.', err);
        });
}

// send token id to server
function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer(currentToken)) {
        console.log('Sending a token to the server...');
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
                showError('An error occurred while Send Push Notification Token To Server. Please try again later.');
            },
            complete: function(){
                loadingEnd();
            }
        });
    } else {
        console.log('Token already sent to server.');
    }
}

// save token to localstorage to check if user send it to server
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

        // register empty ServiceWorker every time
        /*messaging.onMessage(function(payload) {
            console.log('Message received. ', payload);
            new Notification(payload.notification.title, payload.notification);
        });*/

        navigator.serviceWorker.register('/firebase-messaging-sw.js');

        // request permission to receive notifications
        Notification.requestPermission(function(result) {
            if (result === 'granted') {
                navigator.serviceWorker.ready.then(function(registration) {
                    // Show Notification
                    payload.notification.data = payload.notification; // params
                    return registration.showNotification(payload.notification.title, payload.notification);
                }).catch(function(error) {
                    console.log('ServiceWorker registration failed', error);
                });
            }
        });

    });
}
