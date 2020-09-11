<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\Instagram;
use App\Models\SocialAccountOptions;
use App\Models\SocialAccounts;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Redirect;

class SocialAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fbAccounts = SocialAccounts::where('customer_id', Auth::guard('customers')->user()->id)->where('provider_name','facebook')->get();
        $twitterAccounts = SocialAccounts::where('customer_id', Auth::guard('customers')->user()->id)->where('provider_name','twitter')->get();
        $instragramAccounts = SocialAccounts::where('customer_id', Auth::guard('customers')->user()->id)->where('provider_name','instagram')->get();
        return view('customer.social_account.index',compact('fbAccounts','twitterAccounts','instragramAccounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SocialAccounts::find($id)->delete();
        return redirect()->to('customer/social_account')
            ->with('success','Account has been deleted.');
    }

    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookcallback(Request $request)
    {
        $facebookId = $request->get('id');
        $firstName = $request->get('first_name');
        $lastName = $request->get('last_name');
        $email = $request->get('email');
        $accessToken = $request->get('accessstoken');

        $checkFacebookAccount = SocialAccounts::where('customer_id',Auth::guard('customers')->user()->id)->where('provider_id',$facebookId)->count();

        if(!$checkFacebookAccount) {
            $socialAccount = new SocialAccounts;
            $socialAccount->customer_id = Auth::guard('customers')->user()->id;
            $socialAccount->provider_id = $facebookId;
            $socialAccount->provider_name = 'facebook';
            $socialAccount->save();

            $options = [
                'facebook_token'=>$accessToken,
                'facebook_refresh_token' => '',
                'facebook_expiresin' => '',
                'facebook_id' => $facebookId,
                'facebook_name' => $firstName.' '.$lastName,
                'facebook_email' => $email,
                'facebook_avatar' => 'https://graph.facebook.com/'.$facebookId.'/picture?type=normal',
            ];

            $socialAccount->createOptions($options);

            Session::flash('success','Your facebook account has been connected.');
            return response(1, 200)
                ->header('Content-Type', 'text/plain');
        }

        Session::flash('success','Your facebook account has already been connected.');
        return response(2, 200)
            ->header('Content-Type', 'text/plain');
    }

    public function twitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function twittercallback(Request $request)
    {
        if ($request->has('denied')) {
            return redirect()->to('customer/social_account')
                ->with('success','Twitter account has not connected..');
        }

        try {
            $twitter = Socialite::driver('twitter')->user();
            $checkFacebookAccount = SocialAccounts::where('customer_id',Auth::guard('customers')->user()->id)->where('provider_id',$twitter->id)->count();

            if(!$checkFacebookAccount) {
                $socialAccount = new SocialAccounts;
                $socialAccount->customer_id = Auth::guard('customers')->user()->id;
                $socialAccount->provider_id = $twitter->id;
                $socialAccount->provider_name = 'twitter';
                $socialAccount->save();

                $options = [
                    'twitter_token'=>$twitter->token,
                    'twitter_token_secret'=>$twitter->tokenSecret,
                    'twitter_id' => $twitter->id,
                    'twitter_nickname' => $twitter->nickname,
                    'twitter_name' => $twitter->name,
                    'twitter_email' => $twitter->email,
                    'twitter_avatar' => $twitter->avatar,
                ];

                $socialAccount->createOptions($options);

                return redirect()->to('customer/social_account')
                    ->with('success','Your twitter account has been connected.');
            }
            return redirect()->to('customer/social_account')
                ->with('success','Your twitter account has already been connected.');


        } catch (Exception $e) {
            Session::flush('error','There is issue in facebook login. Please try again later.');
            return redirect('customer/social_account');
        }
    }

    public function instagram()
    {
        $appId = config('services.instagram.client_id');
        $redirectUri = urlencode(config('services.instagram.redirect'));
        //return redirect()->to("https://api.instagram.com/oauth/authorize?app_id={$appId}&redirect_uri={$redirectUri}&scope=user_profile,user_media&response_type=code");
        return redirect()->to("https://instagram.com/accounts/logoutin/?force_classic_login=&next=".urlencode('/oauth/authorize/?response_type=code&scope=user_profile,user_media&client_id='.$appId.'&redirect_uri='.$redirectUri));
    }

    public function instagramcallback(Request $request)
    {
        $code = $request->code;
        if (empty($code)) return redirect()->to('customer/social_account')->with('error', 'Failed to login with Instagram.');

        $objInstagram = new Instagram();

        $content = $objInstagram->getAccessToken($code);
        if(!$content)
        {
            return redirect()->to('customer/social_account')
                ->with('error','Error in getting instagram access token. Please try again later.');
        }

        $content = json_decode($content);
        $accessToken = $content->access_token;

        $objUserInfo = $objInstagram->getUserInfo($accessToken);
        if(!$objUserInfo)
        {
            return redirect()->to('customer/social_account')
                ->with('error','Error in getting instagram user information. Please try again later.');
        }

        $instagram = json_decode($objUserInfo);

        $checkFacebookAccount = SocialAccounts::where('customer_id',Auth::guard('customers')->user()->id)->where('provider_id',$instagram->id)->count();

        if(!$checkFacebookAccount) {
            $socialAccount = new SocialAccounts;
            $socialAccount->customer_id = Auth::guard('customers')->user()->id;
            $socialAccount->provider_id = $instagram->id;
            $socialAccount->provider_name = 'instagram';
            $socialAccount->save();

            $options = [
                'instagram_token'=>$accessToken,
                'instagram_id' => $instagram->id,
                'instagram_account_type' => $instagram->account_type,
                'instagram_username' => $instagram->username,
            ];

            $socialAccount->createOptions($options);
            return redirect()->to('customer/social_account')
                ->with('success','Your instagram account has been connected.');
        }
        return redirect()->to('customer/social_account')
            ->with('success','Your instagram account has already been connected.');
    }
}
