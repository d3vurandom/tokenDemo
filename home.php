<?php
    require_once('./include/authentication.class.php');
    require_once('./include/user.class.php');
    require_once('./include/config.php');

    global $maximumIdleTime;

    if(!authentication::isAuthenticated()){
        echo "You are not authenticated!";
        echo '<script>setTimeout(function(){
              window.location = "./index.php";
            }, 1000);</script>';
        exit(0);
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Token Authentication Login Demo Home</title>

        <script src="./javascript/jQuery_1.11.0.js" type="text/javascript"></script>
        <script src="./javascript/login.js" type="text/javascript"></script>
        <script src="./javascript/authentication.js" type="text/javascript"></script>
        <link href="./css/normalize_3.0.css" rel="stylesheet" type="text/css">
        <link href="./css/bootstrap_3.1.1.css" rel="stylesheet" type="text/css">
        <link href="./css/style.css" rel="stylesheet" type="text/css">

    </head>

    <body onLoad="authenticationTimer( <?php echo $maximumIdleTime ?> )">

        <div id='title'>
            <h2>Token Authentication Login Demo</h2>
        </div>

        <div id='homeBoxContainer'>

            <div id='homeBox'>
                <div id="countdownTimer">timer</div>
                <?php echo displayCookieInfo();?>
            </div>

        </div>

    </body>

</html>
<?php
    function displayCookieInfo(){

        global $cookieName, $maximumIdleTime;
        $token = $_COOKIE[$cookieName];


        $cookeData = authentication::verifyAuthenticationToken($cookieName,$token,true);

        //let make sure nothing fishy went on
        if($cookeData){
            echo "<h1>Hash Match!</h1>";

            if($_SERVER["REMOTE_ADDR"] == $cookeData['ipAddress']){
                echo "<h1>IP addresses Match!</h1>";
                echo "Cookie___IP = " . $cookeData['ipAddress']  . "<br>";
                echo "Actual____IP = " . $_SERVER["REMOTE_ADDR"] . "<br>";
            }
            else {
                echo "remote address does not match<br>";
            }

            if(sha1($_SERVER['HTTP_USER_AGENT']) == $cookeData['SHA1OfUserAgent']){
                echo "<h1>SHA1 of user agent Match!</h1>";
                echo "Cookie___SHA1 user agent = " . $cookeData['SHA1OfUserAgent'] . "<br>";
                echo "Actual____SHA1 user agent = " . sha1($_SERVER['HTTP_USER_AGENT']) . "<br>";
            }
            else {
                echo "user agent does not match<br>";
            }

            if($cookeData['timestamp'] >= (time() - $maximumIdleTime)){

                echo "<h1>Time difference in seconds</h1>";
                echo "Cookie___Time = " . $cookeData['timestamp'] . "<br>";
                echo "Actual____Time = " . time() . "<br>";
                echo "difference in seconds = " .  (time() - $cookeData['timestamp']) . "<br>";
            }
            else {
                echo "<h1>Time difference in seconds</h1>";
                echo "Cookie___Time = " . $cookeData['timestamp'] . "<br>";
                echo "Actual___Time = " . time() . "<br>";
                echo "<b>difference in seconds > " .$maximumIdleTime . "</b> = " .  (time() - $cookeData['timestamp']) . "<br>";
            }
        }
        else {
            echo "Hashes do not match, cookie was tampered with";
        }
    }
?>