<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Orders;
use App\Models\Transactions;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FunctionsController extends Controller
{
    public function index(Request $request){

        $status         = 1;
        $submit_count   = 0;
        $msg            = null;

        return view('question1')->with('status', $status)->with('msg', $msg)->with('submit_count', $submit_count);
    }

    public function checkDownload(Request $request){

        // dd($request);
        
        $memberType     = $request->memberType;
        $fileType       = strtolower($request->fileType);
        $submit_count   = $request->submit_count;

        $status         = 1;
        
        $msg            = "";

        // dd($memberType, $fileType);

        if($memberType == 'member'){
            if($fileType == 'jpeg' && $submit_count < 2 && $status == 1){
                $msg = "Your download is starting...";
                $submit_count += 1;
                $status = 1;

            } else {
                $msg = "Too many downloads";
                $status = 0;
                $submit_count = 0;
            }
        } 

        if ($memberType == 'nonMember' && $status == 1){
            if($submit_count == 0){
                $msg = "Your download is starting...";
                $submit_count += 1;
                $status = 1;

            } else {
                $msg = "Too many downloads";
                $status = 0;
                $submit_count = 0;
            }
        }

        if($request->status == 0){
            sleep(5);
        }

        return view('question1')->with('msg', $msg)->with('status', $status)->with('submit_count', $submit_count);
        

    }

    public function index2(){

        $msg = null;

        return view('question2')->with('msg', $msg);
    }

    public function analyzeMsg(Request $request){

        $input      = $request->input;
        $output     = $request->output;

        $inputLen   = strlen($input);
        $outputLen  = strlen($output);

        // dd($inputLen, $outputLen);

        if($inputLen != $outputLen){
            return Redirect::back()->withErrors(['msg' => 'Invalid data']);
        }

        $inputArray     = str_split($input);
        $outputArray    = str_split($output);

        $sum_of_ten = 0;
        $minus_one = 0;
        $plus_three = 0;

        $msg = "";

        foreach($inputArray as $ia){
            foreach ($outputArray as $oa){
                if(intVal($ia) + intVal($oa) == 10){
                    $sum_of_ten += 1;

                    if($sum_of_ten == $inputLen){
                        // dd('Encrypted characters sum up to 10');
                        $msg = 'Encrypted characters sum up to 10';
                    }

                } else if(intVal($ia) - intVal($oa) == 1){
                    $minus_one += 1;

                    if($minus_one == $inputLen){
                        $msg = 'Encrypted characters add -1';

                    }
                } else if(intVal($oa) - intVal($ia) == 3){
                    $plus_three += 1;

                    if($plus_three == $inputLen){
                        $msg = 'Encrypted characters add 3';
                    }
                } else {
                    $msg = 'patterns not found';
                }
            }
        }
        


        return view('question2')->with('msg', $msg);
    }

    public function index3(){

        $msg = null;

        return view('question3')->with('msg', $msg);
    }

    public function testSummary(Request $request){

        $name               = $request->name;
        $gender             = $request->gender;
        $mathScore          = $request->mathScore;
        $scienceScore       = $request->scienceScore;

        $average = ($mathScore + $scienceScore)/2 ;

        if ($gender == 'male'){
            $genMsg = "he";
        } else {
            $genMsg = "she";
        }

        if($mathScore > 50 && $scienceScore > 50){
            $scoreMsg = " is performing very well in this test.";

        } else if (($mathScore > 50 && $scienceScore < 50) || ($mathScore < 50 && $scienceScore > 50)) {
            if($mathScore < 50){
                $subject = "Mathematics";
            } 

            if($scienceScore < 50) {
                $subject = "Science";
            }

            $scoreMsg = " is not doing well for " . $subject . " subject.";

        } else {
            $scoreMsg = " is not doing well for Mathematics and Science subjects." ;
        }


        $msg = $name . " has an average score of " . $average . ". Overall, " . $genMsg . $scoreMsg;

        return view('question3')->with('msg', $msg);

    }

    public function question5(){

    //Question A.
        $transactions = Transactions::select('transactions.*', 'ord.customerId')
            ->leftJoin('orders as ord', 'ord.orderId', 'transactions.id')
            ->get();

        
        $total_spent_array = [];
            
        foreach($transactions as $transaction){
            
            $quantity = $transaction->quantity;
            $unit_price = $transaction->unit_price;

            $total = $quantity * $unit_price;
            $total_spent_array[$transaction->id] = $total;

        }

        $max = array_keys($total_spent_array, max($total_spent_array));
        $top_spender_order = Orders::where('orderId', $max)->first();
        $top_spender = Customers::Select('name')->where('id', $top_spender_order->customerId)->first();

    //Question B.
        $start = Transactions::select('transaction_date')->orderBy('transaction_date')->first();
        $end = Transactions::select('transaction_date')->orderBy('transaction_date', 'DESC')->first();


        $date1 = $start->transaction_date;
        $date2 = $end->transaction_date;

        // dd($date1, $date2);

        $period = new DatePeriod(
            new DateTime($date1),
            new DateInterval('PT1H'),
            new DateTime($date2),
        );

        $date_array = []; 
        $all_hours = [];
        $dayHours = [];

        foreach($period as $date){
            array_push($date_array, $date);
        }

        foreach($date_array as $da){
            $dayHour = $da->format('Y-m-d H');
            array_push($dayHours, $dayHour);

            $count = 0;

            foreach($transactions as $transaction){
                // dd($transaction);
                $transDate = new DateTime($transaction->transaction_date);
                $transDayDate = $transDate->format('Y-m-d H');

                if($dayHour == $transDayDate){
                    $count += 1;
                } 
            }

            $all_hours[$dayHour] = $count;

        }

        // dd($all_hours);
        // dd($date_array);




    //Question C.
        $Adamtransactions = Transactions::select('transactions.*', 'ord.customerId')
            ->leftJoin('orders as ord', 'ord.orderId', 'transactions.id')
            ->where('customerId', 1)
            ->get();

        // dd($Adamtransactions);
        
        $adam_fruits = [];

        foreach($Adamtransactions as $at){
            if(!in_array($at->item, $adam_fruits)){
                array_push($adam_fruits, $at->item);
            }
        }




        return view('question5')->with('top_spender', $top_spender)->with('adam_fruits', $adam_fruits)->with('dayHours', $dayHours)->with('all_hours', $all_hours);

    }




}
