<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Aginev\Datagrid\Datagrid;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $feedback_data = Feedback::all();

        $grid = new Datagrid($feedback_data, $request->get('f', []));

        $grid->setColumn('name', 'Meno')
        ->setColumn('email', 'Kontakt')
        ->setColumn('comment', 'Komentar')
        ->setColumn('created_at', 'Datum')
        ->setActionColumn([
            'wrapper' => function ($value, $row) {
                return '<a href="javascript:void(0)" onclick="editFeedback('.$row->id.')" title="Edit" class="btn btn-primary btn-sm">Upraviť</a> 
                <a href="javascript:void(0)" onclick="deleteFeedback('.$row->id.')" class="btn btn-danger btn-sm sid'.$row->id.'">Zmaž</a>'; 
            }
        ]);

        return view('feedbacks/index', ['grid' => $grid]);
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
        $valid_feedback = request()->validate([
            'email' => 'required|email',
            'comment' => 'required',
            'name' => 'required',
            'created_at' => '',
            'user_id' => ''
        ]);
        if (Auth::check()) {
            $valid_feedback['user_id'] = Auth::user()->id;
        }
        $fdbck = Feedback::create($valid_feedback);
        return response()->json($fdbck);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        return view('feedback');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        $feedback = Feedback::find($request->id);
        $feedback->email = $request->email;
        $feedback->comment = $request->comment;
        $feedback->name = $request->name;
        $feedback->created_at = now();
        $feedback->save();
        return response()->json($feedback);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Feedback::destroy($id);
        return response()->json(['success' => 'Komentar sa vymazal']);
    }

    public function getFeedbackById($id) {
        $feedback = Feedback::find($id);
        return response()->json($feedback);
    }
}
