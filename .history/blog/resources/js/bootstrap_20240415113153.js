

// 使用 Echo 对象
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

const firebaseConfig = {
    apiKey: "AIzaSyDnY37byXfJH6EDSovfolM27bYV_k1r7ko",
    authDomain: "project-410302.firebaseapp.com",
    projectId: "project-410302",
    storageBucket: "project-410302.appspot.com",
    messagingSenderId: "956395546338",
    appId: "1:956395546338:web:f10b15015d724ab9a020bb",
    measurementId: "G-HY8KVX12J0"
  };
  
  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
  
  import { getAuth } from "firebase/auth";
  
  const auth = getAuth();
  auth.languageCode = 'it';
  // To apply the default browser preference instead of explicitly setting it.
  // auth.useDeviceLanguage();