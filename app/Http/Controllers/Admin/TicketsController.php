<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Models\tickets;
use App\Models\ticket_history;
use App\User;
use App\Models\Customer;
use App\Models\TicketReplies;
use File;

class TicketsController extends Controller
{
    public function index(Request $request){

        $recent_tickets = tickets::where('ticket_status','Pending')->where('supporter','LIKE',Auth::user()->id.'%')->orderBy('created_at','DESC')->get()->take(5);
        // dd($recent_tickets);
    	$data = tickets::where('ticket_status','!=','complete')->where('ticket_status','!=','no answer')->join('customers', 'tickets.customer_id', '=', 'customers.id')->select('tickets.*','customers.first_name','customers.last_name','customers.photo')->get();
        // dd($data);
        $arch_tickets = tickets::where('ticket_status','=','complete')->orwhere('ticket_status','=','no answer')->join('customers', 'tickets.customer_id', '=', 'customers.id')->get();
        // dd($arch_tickets);
        return view('admin.tickets.index',compact('data','recent_tickets','arch_tickets'));
    }

    public function ticketDetail(Request $request){

    	$ticket_id = $request->Ze3pBwnG0pQwrZi;
    	// dd($ticket_id);
        $array = array();
        Session::put('files', $array); 

    	$data = tickets::where('ticket_id',$ticket_id)->first();
        // dd($data);
        $user_id = $data->customer_id;
        // dd($user_id);
        // $user = User::where('id',$user_id)->first();
        $customer = Customer::where('customers.id',$user_id)->join('packages','customers.package_id','packages.id')->select('customers.*', 'packages.subscription_name')->first();
        // dd($user);
        // dd($customer);
        // dd($data);
        $supporters = User::join('model_has_roles','users.id','model_has_roles.model_id')->join('roles','model_has_roles.role_id','roles.id')->select('users.*','roles.name as supporter_role')->get();
        // dd($supporters);
        $ticket_history = ticket_history::where('ticket_id',$ticket_id)->get();
        // dd($ticket_history);
        if(!empty($data->supporter)){
            $tocket_replies = TicketReplies::where('ticket_replies.ticket_id',$ticket_id)->join('users','ticket_replies.supporter_id','users.id')->join('customers','ticket_replies.customer_id','customers.id')->join('model_has_roles','ticket_replies.supporter_id','model_has_roles.model_id')->join('roles','model_has_roles.role_id','roles.id')->select('ticket_replies.*','users.first_name as supporter_firstname','users.surname as supporter_lastname','customers.first_name as customer_firstname','customers.last_name as customer_lastname','customers.company_name as customer_company','customers.photo as customer_pic','model_has_roles.role_id as supporter_role','roles.name as supporter_roleName','users.photo as sup_photo')->get();
        }else{

            $tocket_replies = TicketReplies::where('ticket_replies.ticket_id',$ticket_id)->join('customers','ticket_replies.customer_id','customers.id')->select('ticket_replies.*','customers.first_name as customer_firstname','customers.last_name as customer_lastname','customers.company_name as customer_company','customers.photo as customer_pic')->get();
        }
        // dd($tocket_replies);

    	return view('admin.tickets.ticket_detail', compact('data','customer','tocket_replies','ticket_history','supporters'));
    }

    public function changeTicketSstatus(Request $request){
        // dd($request->all());

        $user = $request->id.', '.$request->userName;
        $ticket_id = $request->ticketID;
        // dd($user);
        $supporter = explode(",",$user);
        $status = "Pending";
        tickets::where('ticket_id',$ticket_id)->update(['supporter'=>$user, 'ticket_status'=>$status]);
        $detail1 = 'Ticket assigned to '.$supporter[1];
        $detail = 'Ticket Status Changed to ('.$status.')';
        ticket_history::create(['ticket_id'=>$ticket_id,'detail'=>$detail1]);
        ticket_history::create(['ticket_id'=>$ticket_id,'detail'=>$detail]);
        return $supporter[1];

    }

    public function updateTicketSstatus(Request $request){

        $status = $request->option;
        $ticket_id = $request->ticket_id;

        tickets::where('ticket_id',$ticket_id)->update(['ticket_status'=>$status]);
        $detail = 'Ticket Status Changed to ('.$status.')';
        ticket_history::create(['ticket_id'=>$ticket_id,'detail'=>$detail]);

        return "true";
    }

    public function addTicketReplies(Request $request){
        // dd($request->all());
        $files = $request->msg_pic;
        // dd($files);
        $supporter_id = $request->supporterID;
        $reply_body  = $request->message;
        $ticket_id = $request->ticketID;
        $customer_id = $request->customerID;
        $supporter = $request->supporter;

        $supporter_attachment1 = '';
        $supporter_attachment2 = '';
        $supporter_attachment3 = '';
        $supporter_attachment4 = '';
        $supporter_attachment5 = '';

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

        if(!empty($files)){
            $i = 1;
            $x = 'supporter_attachment';
            foreach($files as $key => $file){
            // dd($file);
                $ext=$file->getClientOriginalExtension();
                $fileNmae = md5(rand(1111111111,999999999)).'.'.$ext;
                $file->move(public_path().'/replies-attachments/' , $fileNmae);

                // File::move(public_path('images/'.$file), public_path('replies-attachments/'.$file));
                ${$x.$i} = $fileNmae;
                $i++;
            }
        }

        $sql = TicketReplies::create(['ticket_id'=>$ticket_id,'customer_id'=>$customer_id, 'supporter_id'=>$supporter_id,'reply_body'=>$reply_body, 'supporter_attachment1'=>$supporter_attachment1, 'supporter_attachment2'=>$supporter_attachment2, 'supporter_attachment3'=>$supporter_attachment3, 'supporter_attachment4'=>$supporter_attachment4, 'supporter_attachment5'=>$supporter_attachment5,'image_msg'=>$image_msg,'is_supporter_replied'=>1,'supporter'=>Auth::user()->id]);
        if($sql){
            // TicketReplies::where('ticket_id',$ticket_id)->update([ 'supporter_id'=>$supporter_id]);
            $current_ticket = tickets::where('ticket_id',$ticket_id)->first();
            $current_ticket_supporter = $current_ticket->supporter;
            if(empty($current_ticket_supporter) || $current_ticket_supporter = NULL){

                tickets::where('ticket_id',$ticket_id)->update(['supporter'=>$supporter]);
                $sup_name = explode(',', $supporter);
                $sup = $sup_name[0];
                $supporter_detail = User::where('users.id',$sup)->join('model_has_roles','users.id','model_has_roles.model_id')->join('roles','model_has_roles.role_id','roles.id')->select('users.*','roles.name as supporter_role')->first();
                $detail= 'Ticket assigned to '.$supporter_detail->first_name.' '.$supporter_detail->surname.' | '.$supporter_detail->supporter_role;
                ticket_history::create(['ticket_id'=>$ticket_id,'detail'=>$detail]);
            }
            $ticket_status = tickets::where('ticket_id',$ticket_id)->first();
            $status = $ticket_status->ticket_status;
            if($status == 'waiting for customer reply'){

            }else{
                // tickets::where('ticket_id',$ticket_id)->update(['ticket_status'=>'waiting for customer reply']);
                // $detail = 'Ticket status changed to (waiting for customer reply)';
                // ticket_history::create(['ticket_id'=>$ticket_id,'detail'=>$detail]);
            }
            return redirect()->back()->with('success','Reply Posted Successfully!');
        }else{
            return redirect()->back()->with('danger','something wents wrong please try again later.');
        }

    }

    public function changeSupporter(Request $request){
        // dd($request->all());

        $supporter = $request->supporter;
        $ticket_id = $request->ticket_id;
        $sup_name = explode(',', $supporter);
        $sup = $sup_name[0];
        $supporter_detail = User::where('users.id',$sup)->join('model_has_roles','users.id','model_has_roles.model_id')->join('roles','model_has_roles.role_id','roles.id')->select('users.*','roles.name as supporter_role')->first();
        $detail= 'Supporter changed to '.$supporter_detail->first_name.' '.$supporter_detail->surname.' | '.$supporter_detail->supporter_role;

        tickets::where('ticket_id',$ticket_id)->update(['supporter'=>$supporter]);
        ticket_history::create(['ticket_id'=>$ticket_id,'detail'=>$detail]);

        return "true";
    }

    public function ticketsArchive(Request $request){

        $arch_tickets = tickets::where('ticket_status','=','complete')->orwhere('ticket_status','=','no answer')->join('customers', 'tickets.customer_id', '=', 'customers.id')->get();
         return view('admin.tickets.archive_tickets',compact('arch_tickets'));
    }

}