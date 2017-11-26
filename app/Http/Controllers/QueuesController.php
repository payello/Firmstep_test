<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queue;
use Validator;

class QueuesController extends Controller
{
    protected $fillable = [
        'firstName',
        'lastName',
        'organization',
        'type',
        'service'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        show all Queued items
        $queues = Queue::all();
        return response()->json($queues);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
        'type'=>'required'
    ]);

        if($validator->fails()){
            $response = array('response'=>$validator->messages()->success=false);
        }
        else {


            //post method add queue item

            $queue = new Queue;

            $queue->firstName = $request->input('firstName');
            $queue->lastName = $request->input('lastName');
            $queue->organization = $request->input('organization');
            $queue->type = $request->input('type');
            $queue->service = $request->input('service');

            $queue->save();

            return response()->json('$queue');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        show a single item
        $queue = Queue::find($id);
        return response()->json($queue);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'type'=>'required'
        ]);

        if($validator->fails()){
            $response = array('response'=>$validator->messages()->success=false);
        }
        else {


            //post method add queue item

            $queue = Queue::find($id);


            $queue->firstName = $request->input('firstName');
            $queue->lastName = $request->input('lastName');
            $queue->organization = $request->input('organization');
            $queue->type = $request->input('type');
            $queue->service = $request->input('service');

            $queue->save();

            return response()->json('$queue');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $queue = Queue::find($id);

        $queue->delete();




    }
}
