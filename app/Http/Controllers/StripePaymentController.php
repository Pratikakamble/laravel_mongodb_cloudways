<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\Category;
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe($amount)
    {
        $categories = Category::all();
        return view('stripe', ['amount' => $amount, 'categories' => $categories]);
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
       /* Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment" 
        ]);
*/


        $customer = \Stripe\Customer::create(array(
            'name' => 'test',
            'description' => 'test description',
            'email' => 'name@gmail.com',
            'source' => $request->stripeToken,
            "address" => ["city" => "hyd", "country" => "india", "line1" => "adsafd werew", "postal_code" => "500090", "state" => "telangana"]
        ));


        $charge = \Stripe\Charge::create(array( 
                'customer' => $customer->id, 
                'amount'   => '100', 
                'currency' => 'inr', 
                'description' => "Test payment", 
            )); 

      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }
}
