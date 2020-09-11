<?php

namespace App\Http\Controllers\Customer;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Input;
use App\Models\tickets;
use App\Models\ticket_history;
use App\Models\TicketReplies;
use App\Mail\TicketRemindermail;
use App\Models\Customer;
use App\User;
use File;
use DB;
use Mail;
// use Session;


class TicketsController extends Controller
{
    protected $ticket_id;
    public function index(Request $request){

    	$data = tickets::where('customer_id',Auth::guard('customers')->user()->id)->get();
        // $array = array();
        // Session::put('files', $array); 
    	// dd($data);
        $last_id = tickets::where('customer_id',Auth::guard('customers')->user()->id)->orderBy('created_at','DESC')->first();
        // dd($last_id);
        if($data->count() >= 1){
            // dd('here...');
            $ticketID = explode('-',$last_id->ticket_id);
            $ticket_id = $ticketID[1] + 1;
            // dd($ticket_id);
        }else{
    	   $ticket_id = getToken(5);
        }

        $last_ticket = tickets::where('customer_id',Auth::guard('customers')->user()->id)->orderBy('created_at','DESC')->first();
        // dd($last_ticket);
        if(!is_null($last_ticket)){

            $data1 = tickets::where('ticket_id', $last_ticket->ticket_id)->first();

            $supporter = explode(',', $data1->supporter);

            $ticket_supporter = $supporter[0];

            $sup = User::where('id',$ticket_supporter)->first();

            $sup_role = DB::table('model_has_roles')->join('roles', 'model_has_roles.role_id', 'roles.id')->where('model_has_roles.model_id',$ticket_supporter)->select('roles.name')->first();

            if(!empty($data1->supporter)){

            $tocket_replies = TicketReplies::where('ticket_replies.ticket_id',$last_ticket->ticket_id)->join('users','ticket_replies.supporter_id','users.id')->join('customers','ticket_replies.customer_id','customers.id')->join('model_has_roles','ticket_replies.supporter_id','model_has_roles.model_id')->join('roles','model_has_roles.role_id','roles.id')->select('ticket_replies.*','users.first_name as supporter_firstname','users.surname as supporter_lastname','users.photo as supporter_photo','customers.first_name as customer_firstname','customers.last_name as customer_lastname','customers.company_name as customer_company','customers.photo as customer_pic','model_has_roles.role_id as supporter_role','roles.name as supporter_roleName')->get();
            }else{

                $tocket_replies = TicketReplies::where('ticket_replies.ticket_id',$last_ticket->ticket_id)->join('customers','ticket_replies.customer_id','customers.id')->select('ticket_replies.*','customers.first_name as customer_firstname','customers.last_name as customer_lastname','customers.company_name as customer_company','customers.photo as customer_pic')->get();
            }

            return view('customer.tickets.index',compact('ticket_id','data','data1','sup','last_ticket','sup_role','tocket_replies'));

        }else{
            $data1='';
            $sup = '';
            $sup_role = '';
            $tocket_replies = '';
            $last_ticket = '';
            return view('customer.tickets.index',compact('ticket_id','data','data1','sup','last_ticket','sup_role','tocket_replies'));
        }
    }

    public function addTicket(Request $request){
        
        // dd(Session::get('files'));
        // dd($request->all());
        $files = $request->msg_pic;
        // dd($files);
        $ticket_id = $request->ticket_no;
        $ticket_subject = $request->subject;
        $ticket_message = $request->message;
        $attachment1 = '';
        $attachment2 = '';
        $attachment3 = '';
        $attachment4 = '';
        $attachment5 = '';
        // dd(count($files));


        if(empty($ticket_subject)){
        	return redirect()->back()->with('danger','Tiecket Subject is required');
        }else if(empty($ticket_message)){
        	return redirect()->back()->with('danger','Ticket Message  is required');
        }else if(empty($ticket_subject) && empty($ticket_message)){
        	return redirect()->back()->with('danger','Tiecket Subject and Ticket Message  is required');
        }else{
            if(!empty($files)){
                $i = 1;
                $x = 'attachment';
                foreach($files as $key => $file){
                // dd($file);
                    $ext=$file->getClientOriginalExtension();
                    $fileName = md5(rand(1111111111,999999999)).'.'.$ext;
                    $file->move(public_path().'/user-attachments/' , $fileName);

                    ${$x.$i} = $fileName;
                    $i++;
                }  
            }

            $image_msg = null;
            // if($request->msg_pic){
            //     $file = input::file('msg_pic');
            //     // dd($file);
            //     $ext=$file->getClientOriginalExtension();
            //     $image_msg = md5(rand(1111111111,999999999)).'.'.$ext;
            //     $file->move(public_path().'/replies-attachments/' , $image_msg);
            // }
            // else{
            //     $image_msg = null;
            // }

        $sql = tickets::create(['ticket_id'=>$ticket_id, 'customer_id'=>Auth::guard('customers')->user()->id, 'ticket_subject'=>$ticket_subject, 'ticket_body'=>$ticket_message, 'attachment1'=>$attachment1, 'attachment2'=>$attachment2, 'attachment3'=>$attachment3, 'attachment4'=>$attachment4, 'attachment5'=>$attachment5,'image_msg'=>$image_msg, 'status'=>'open']);
        $detail = 'Ticket created by '.Auth::guard('customers')->user()->first_name.' '.Auth::guard('customers')->user()->last_name;
        ticket_history::create(['ticket_id'=>$ticket_id, 'detail'=>$detail]);
        if($sql){
            Session::forget('files');
        	return Redirect::to('customer/tickets?last_ticket=')->with('success','Tiecket Submitted Successfully!');
        }else{
        	return redirect()->back()->with('danger','something wents wrong please try again later.');

        }
      }
    }

    public function getDetail(Request $request){

        if(!$request->Ze3pBwnG0pQwrZi){
            return redirect()->back()->with('danger','something wents wrong please try again later.');
        }
        else{
            // Session::forget('files');
            // dd($files);
            // $array = array();
            // Session::put('files', $array); 
            $data = tickets::where('customer_id',Auth::guard('customers')->user()->id)->get();

//             dd($data);
            $ticket_id = getToken(5);

            $id = $request->Ze3pBwnG0pQwrZi;
//             dd($id);
            $data1 = tickets::where('ticket_id', $id)->first();
            $last_ticket = tickets::where('ticket_id', $id)->first();

            $supporter = explode(',', $data1->supporter);

            $ticket_supporter = $supporter[0];

            $sup = User::where('id',$ticket_supporter)->first();

            $sup_role = DB::table('model_has_roles')->join('roles', 'model_has_roles.role_id', 'roles.id')->where('model_has_roles.model_id',$ticket_supporter)->select('roles.name')->first();

            if(!empty($data1->supporter)){

            $tocket_replies = TicketReplies::where('ticket_replies.ticket_id',$id)->join('users','ticket_replies.supporter_id','users.id')->join('customers','ticket_replies.customer_id','customers.id')->join('model_has_roles','ticket_replies.supporter_id','model_has_roles.model_id')->join('roles','model_has_roles.role_id','roles.id')->select('ticket_replies.*','users.first_name as supporter_firstname','users.surname as supporter_lastname','users.photo as supporter_photo','customers.first_name as customer_firstname','customers.last_name as customer_lastname','customers.company_name as customer_company','customers.photo as customer_pic','model_has_roles.role_id as supporter_role','roles.name as supporter_roleName')->get();
            }else{

                $tocket_replies = TicketReplies::where('ticket_replies.ticket_id',$id)->join('customers','ticket_replies.customer_id','customers.id')->select('ticket_replies.*','customers.first_name as customer_firstname','customers.last_name as customer_lastname','customers.company_name as customer_company','customers.photo as customer_pic')->get();
            }

            // dd($tocket_replies);

            // dd($sup_role);
            // dd($sup);

            // dd($data);
            return view('customer.tickets.index',compact('data','data1','sup','sup_role','tocket_replies','last_ticket'))->with('Ze3pBwnG0pQwrZi', str_replace('#','',$ticket_id).'&'.'OikgHtobntCsd8oF');
        }
        // return json_decode(json_encode($data),true);
    }

    public function addTicketReplies(Request $request){
        // dd($request->all());

        $files = $request->msg_pic;
        // dd($files);
        $customer_id = $request->customerID;
        $reply_body  = $request->message;
        $ticket_id = $request->ticketID;
        $supporter_id = $request->supporterID;

        $customer_attachment1 = '';
        $customer_attachment2 = '';
        $customer_attachment3 = '';
        $customer_attachment4 = '';
        $customer_attachment5 = '';
        if(!empty($files)){
            if(count($files) >= 1){
                $i = 1;
                $x = 'customer_attachment';
                foreach($files as $key => $file){
                // dd($file);
                    $ext=$file->getClientOriginalExtension();
                    $fileName = md5(rand(1111111111,999999999)).'.'.$ext;
                    $file->move(public_path().'/replies-attachments/' , $fileName);

                    // File::move(public_path('images/'.$file), public_path('replies-attachments/'.$file));
                    ${$x.$i} = $fileName;
                    $i++;
                }  
            }
        }
        
        $image_msg = null;
        // if($request->msg_pic){
        //     $file = input::file('msg_pic');
        //     // dd($file);
        //     $ext=$file->getClientOriginalExtension();
        //     $image_msg = md5(rand(1111111111,999999999)).'.'.$ext;
        //     $file->move(public_path().'/replies-attachments/' , $image_msg);
        // }
        // else{
        //     $image_msg = null;
        // }

        $sql = TicketReplies::create(['ticket_id'=>$ticket_id, 'customer_id'=>$customer_id,'supporter_id'=>$supporter_id,'reply_body'=>$reply_body, 'customer_attachment1'=>$customer_attachment1, 'customer_attachment2'=>$customer_attachment2, 'customer_attachment3'=>$customer_attachment3, 'customer_attachment4'=>$customer_attachment4, 'customer_attachment5'=>$customer_attachment5,'image_msg'=>$image_msg,'is_customer_replied'=>1]);
        if($sql){
            $ticket_status = tickets::where('ticket_id',$ticket_id)->first();
            $status = $ticket_status->ticket_status;
            if($status == 'open'){
                // return 'true';
            }
            else if($status == 'Pending'){
                // return 'true';
            }
            else{
                tickets::where('ticket_id',$ticket_id)->update(['ticket_status'=>'Pending']);
                $detail = 'Ticket status changed to (Pending)';
                ticket_history::create(['ticket_id'=>$ticket_id, 'detail'=>$detail]);
            }
            return redirect()->back()->with('success','Reply Posted Successfully!');
        }else{
            return redirect()->back()->with('danger','something wents wrong please try again later.');
        }

    }

    public function checkTickets(){
        $mailable = tickets::where('ticket_status','waiting for customer reply')->get();
        foreach($mailable as $mail){
            $date = $mail->updated_at;
            $current = \Carbon\Carbon::now();
            // dd($current); 
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $date);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $current);
            $diff_in_days = $to->diffInDays($from);
            // print_r($diff_in_days);
            if($diff_in_days = 3){
                $user = Customer::where('id',Auth::guard('customers')->user()->id)->first();
                $receiverEmail = $user->email;
                $subject = "Ticket ID ".$mail->ticket_id." need your attention. Please login and check Support Ticket.";
                $massage = [
                    'ticket_message' => $mail->ticket_body

                ];

                $emails = [$receiverEmail];
                Mail::to($emails)->send(new TicketRemindermail($massage, $subject));

            }
            if($diff_in_days > 4){
                tickets::where('ticket_id',$mail-> ticket_id)->update(['ticket_status'=>'no answer']);
                $detail = 'Ticket status changed to (no answer)';
                ticket_history::create(['ticket_id'=> $ticket_id , 'detail'=>$detail]);
            }
        }
    }
}