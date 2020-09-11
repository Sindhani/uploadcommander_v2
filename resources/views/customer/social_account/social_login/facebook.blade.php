<div class="card-body card-dashboard">
    <div class="form-actions text-center border-top-0">
        <a class="btn btn-glow btn-bg-gradient-x-purple-blue round text-white" onclick="fbLogin();" id="fbLink">
            <i class="la la-check-square-o"></i> Add Account
        </a>
    </div>
</div>

@push('scripts')
<script>
    window.fbAsyncInit = function() {
        // FB JavaScript SDK configuration and setup
        FB.init({
            appId      : '{{ env('FACEBOOK_APP_ID')}}', // FB App ID
            cookie     : true,  // enable cookies to allow the server to access the session
            xfbml      : true,  // parse social plugins on this page
            version    : 'v3.2' // use graph api version 2.8
        });
    };

    // Load the JavaScript SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Facebook login with JavaScript SDK
    function fbLogin() {
        FB.login(function (response) {
            if (response.authResponse) {
                // Get and display the user profile data
                getFbUserData(response.authResponse.accessToken);
            } else {
                //--- when user close the facebook browser........
                //alert('User cancelled login or did not fully authorize.');
            }
        }, {scope: 'public_profile,email'});
    }

    // Fetch the user profile data from facebook
    function getFbUserData(accesstoken){
        FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
            function (response) {
                saveUserData(response, accesstoken);
                fbLogout();
            });
    }

    // Logout from facebook
    function fbLogout() {
        FB.logout();
    }

    function saveUserData(userData, accesstoken){
        $.ajax({
            url: '{{ url('customer/facebookcallback') }}',
            data: 'accessstoken='+accesstoken+'&id='+userData.id+'&first_name='+userData.first_name+'&last_name='+userData.last_name+'&email='+userData.email,
            type: 'GET',
            success: function (res) {
                if(res == 1 || res ==2) {
                    window.location.href='{{ url('customer/social_account') }}'
                } else  {
                    alert('Oops! There is problem in facebook login. Please try again later.');
                }
            },
            error: function () {
                alert('Oops! There is problem in facebook login. Please try again later.');
            }
        });
    }
</script>
@endpush
