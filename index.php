<!DOCTYPE html>
<html lang="en">
<head>
    <title>Send Notification</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>


<div class="container">
     
 <h2>Send Push notification by click send Button</h2>
  <form action="<?php echo $actual_link = 'https://'.$_SERVER['HTTP_HOST'].'/fcmsend/sendYourNotification.php' ?>" method="get">
    <div class="form-group">
      <label for="token">Device Token:</label>
      <input required="required" type="text" readonly class="form-control" id="token" placeholder="Wait for Token it take 7-8 second ..." name="token">
    </div>
   
    <button type="submit" id="getButton" class="btn btn-default"></button>
  </form>
  
</div>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
<script>
  $('#getButton').prop('disabled', true);
   $('#getButton').html("Wait we get token..");
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
   
    firebase.initializeApp(firebaseConfig);
    const messaging=firebase.messaging();

    function IntitalizeFireBaseMessaging() {
        messaging
            .requestPermission()
            .then(function () {
                console.log("Notification Permission");
                return messaging.getToken();
            })
            .then(function (token) {
                console.log("Token : "+token);
                $.ajax({
                      type: "post",
                      url: '<?php echo $actual_link = "https://".$_SERVER['HTTP_HOST']."/fcmsend/db.php" ?>',
                      data: {token:token},
                      success: function(data) 
                      {
                      $('#getButton').html('Send Notification');
                        $('#getButton').prop('disabled', false);
                        
                      },
                      error: function(){
                        alert('some thing went wrong');
                      }
                  });
                $('#token').val(token);
            })
            .catch(function (reason) {
                console.log(reason);
            });
    }

    messaging.onMessage(function (payload) {
        console.log(payload);
        const notificationOption={
            body:payload.notification.body,
            icon:payload.notification.icon
        };

        if(Notification.permission==="granted"){
            var notification=new Notification(payload.notification.title,notificationOption);

            notification.onclick=function (ev) {
                ev.preventDefault();
                window.open(payload.notification.click_action,'_blank');
                notification.close();
            }
        }

    });
    messaging.onTokenRefresh(function () {
        messaging.getToken()
            .then(function (newtoken) {
                console.log("New Token : "+ newtoken);
            })
            .catch(function (reason) {
                console.log(reason);
            })
    })
    IntitalizeFireBaseMessaging();
</script>
</body>
</html>