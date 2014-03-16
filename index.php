<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Token Authentication Login Demo</title>
        <script src="./javascript/jQuery_1.11.0.js" type="text/javascript"></script>
        <script src="./javascript/login.js" type="text/javascript"></script>
        <link href="./css/normalize_3.0.css" rel="stylesheet" type="text/css">
        <link href="./css/bootstrap_3.1.1.css" rel="stylesheet" type="text/css">
        <link href="./css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id='loginBoxContainer'>
            <div id='loginBox'>
                    <span>Please login to continue</span>
                    <form name='loginForm'>
                    <table id='loginTable' class='table'>
                        <tr>
                            <td>
                                Username:
                            </td>
                            <td>
                                <input type="text" class='form-control' name="username" autocomplete="off" placeholder  = 'Username = "admin"'>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Password:
                            </td>
                            <td>
                                <input id='passwordField' type="password" class='form-control' name="password" autocomplete="off" placeholder  = 'Password = "admin"' onkeyup="checkIfEnterKeyLogin(event)">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input id='submitButton' class='btn btn-primary' value="Login" onclick="submitLogin()" onkeypress="submitLogin()">
                            </td>
                        </tr>
                        <tr>
                            <td id='loginErrorMessage' colspan="2">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>

