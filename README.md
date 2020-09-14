This socurce code  is fire base cloud messaging ...

note:-

1. firebase-messaging-sw.js should be place in public_html follder

2. Replace Your Firebase Credential with this code ...


	var firebaseConfig = {
        apiKey: "YOUR_API_KEY",
        authDomain: "YOUR_FIREBASE_DOMAIN_NAME",
        databaseURL: "YOUR_FIREBASE_DATBASE_URL",
        projectId: "YOUR_FIREBASE_PROJECT_ID",
        storageBucket: "YOUR_FIREBASE_STORAGE_BUCKET END WITH appspot.com",
        messagingSenderId: "YOUR SENDER ID",
        appId: "YOUR APP ID",
        measurementId: "YOUR MEASUREMENT ID"
    };


3. For sending Push notification on ios phone we need  pushcert.pem file  it should be place in project root directory and include that file in ur code. 

