<?php 
  
namespace App\Http\Controllers; 
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Validator,Redirect,Response;
use DB; 
use Carbon\Carbon; 
use App\Models\Member;
use App\Models\newMembership;
use Mail; 
use Hash;
use Illuminate\Support\Str;
  
class ForgotPasswordApiController extends Controller
{       
      
      public function submitForgetPasswordForm(Request $request)
      {
          
          $validator = Validator::make($request->all(), [
              'email' => 'required|email|exists:user',
          ]);
   
          if($validator->fails())
          {
              return response()->json([
                  'validate_err' => $validator->messages(),
              ]);
          }
          else
          {
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('emailforgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });

          return response()->json([
            'message' => 'We have e-mailed your password reset link!', 
          ]);          
          }
        
          
      }
      /**

       *
       * @return response()
       */
      
  
      /**

       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {

          $request->validate([
              'email' => 'required|email|exists:user',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
          try{
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
          }
          catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
          }
          catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
          }
          
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
          try{
          $user = newMembership::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
          }
          catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
          }
          catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
          }
          return redirect('/ct-dashboard')->with('message', 'Your password has been changed!');
          //^^Will be dashboard
      }
}