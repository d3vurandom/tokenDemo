function submitLogin() {
    var username = document.loginForm.username.value;
    var password = document.loginForm.password.value;
    var messageLocation = document.getElementById("loginErrorMessage");

    postAjaxRequest("./login.php","username=" + username + "&password=" + password, function (response) {
        if(response == "true"){

            messageLocation.innerHTML = "<center>Login Successful</center>";
            $('#loginErrorMessage').removeClass();
            $('#loginErrorMessage').addClass('loginSuccess');
            window.location.href = "./home.php";

        }
        else{
            messageLocation.innerHTML = "<center>Username or password is incorrect</center>";
            $('#loginErrorMessage').removeClass();
            $('#loginErrorMessage').addClass('loginFailure');
        }
    }) ;
}

function postAjaxRequest(file, data, onSuccess, onFailure){

    $.ajax({
        type: "POST",
        url: file,
        data: data,
        success: onSuccess,
        error: onFailure
    });

    if(onSuccess){
        return data;
    }
    if(onFailure){
        return data;
    }
}

function checkIfEnterKeyLogin(event){
    if(event.keyCode == 13){
        submitLogin();
    }
};