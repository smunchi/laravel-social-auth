<html>
    <head>
        <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

        <style>
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
                margin-bottom: 40px;
            }

            .quote {
                font-size: 24px;
            }
        </style> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>         
    </head>
    <body>        
        <script> 
            function statusChangeCallback(response) { 
                if (response.status === 'connected') {
                    // Logged into your app and Facebook.
                    loggedInToApplication();
                } else {
                    // The person is not logged into your app or we are unable to tell.
                    document.getElementById('status').innerHTML = 'Please log ' +
                            'into laravel social app.';
                }
            }
        
            function checkLoginState() {             
                FB.getLoginStatus(function (response) {
                    statusChangeCallback(response);
                });
            }

            window.fbAsyncInit = function () {
                FB.init({
                    appId: '1839134542795889',
                    cookie: true, // enable cookies to allow the server to access 
                    // the session
                    xfbml: true, // parse social plugins on this page
                    version: 'v2.8' // use graph api version 2.8
                });

                FB.getLoginStatus(function (response) {
                    statusChangeCallback(response);
                });
            };

            // Load the SDK asynchronously
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
           
            function loggedInToApplication() {                 
                FB.api('/me', function (response) { 
                    addUserDataToAppDb(response);
                    document.getElementById('status').innerHTML =
                            'Thanks for logging in, ' + response.name + '!';
                });
            }
            
            function addUserDataToAppDb(response) {                
                $.ajax({
                    url: "add_facebook_user", 
                    type:'POST',
                    dataType: 'JSON',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": response.id,
                        "fullname":response.fullname
                    },                   
                    success: function(result) {                       
                    }
                });
            }
            
            function processData(noOfTerms) {
              var t1 = 1; t2 = 1;
              data = new Array();            
              
              for(var i = 1; i<=noOfTerms; i++) {                 
                  data.push(t1);                  
                  var nextTerm = t1 + t2;                  
                  t1 = t2;
                  t2 = nextTerm;
              }
              
              var dataWithComma = data.join();
              $('.prcess_data').html(dataWithComma);             
            }
        </script>        

    <div class="container">
        <div class="content">
            <div class="title">Laravel 5 Social Auth With Facebook and Google</div>
            <div>
                <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                </fb:login-button>
            </div>
            <div id="status"></div>
            <fieldset style="width:500px; margin: 0 auto;">
                <legend>
                    Calculate no of terms
                </legend>
                <input type="text" class="no_of_terms" placeholder="Enter no of terms"/>
                <input type="button" value="process" onclick="processData($('.no_of_terms').val())">            
            <p class="prcess_data"></p>
            </fieldset>            
        </div>        
    </div>
</body>
</html>
