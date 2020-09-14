<?php
function sendNotification(){
    $url ="https://fcm.googleapis.com/fcm/send";

    $fields=array(
        "to"=> trim($_GET['token']),
        "notification"=>array(
            "body"=>"test body",
            "title"=>"test title",
            "icon"=>"https://dummyimage.com/192X192/f200f2/0011ff.jpg",
            "click_action"=>"https://google.com"
        ),
        "priority"=> "high",
        // "apns" => [

        //             'payload' => [
        //                             'aps' => [ 
        //                                         'mutable-content' => 1 
        //                                     ] 
        //                         ],
        //             "fcm_options" => [
        //                                 "image"=> "https://dummyimage.com/192x192/f200f2/0011ff.jpg"
        //                             ]

        //          ]
    );

    $headers=array(
        'Authorization: key=AAAAMZe6rfY: YOUR_FCM_SERVER_KEY',
        'Content-Type:application/json'
    );

    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
    $result=curl_exec($ch);
    
    print_r($result);
     $actual_link = 'https://'.$_SERVER['HTTP_HOST'].'/fcmsend/index.php';
        echo "<br>";
    echo "<br>";
    echo '<button type="button"><a href="'.$actual_link.'">Send Notification Again!</a></button>';
    curl_close($ch);
}

if(isset($_GET)&& $_GET['token'] != ""){

sendNotification();


}else{
    echo "some think went wrong";
    $actual_link = 'https://'.$_SERVER['HTTP_HOST'].'/fcmsend/index.php';
    echo "<br>";
       echo "<br>";
    echo '<button type="button"><a href="'.$actual_link.'">Go Back and Try Again!</a></button>';
}