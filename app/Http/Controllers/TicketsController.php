<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
  protected $redirectTo = '/home';

  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Get a validator for an incoming request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
      return Validator::make($data, [
          'ticket_reference' => 'required|string|max:10'
      ]);
  }


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $ticket_reference  = $this->getRequestID();
      $tickets     = $this->getTickets();

      return view('home', compact('tickets','ticket_reference'));
  }

  public function getRequestID()
  {
      $request_id = rand(1000,10000);
      return $request_id;
  }

  public function getTickets()
  {
      $user_id = Auth::user()->id;
      $tickets = DB::table('tickets')
             ->select(DB::raw('id,ticket_id'))
             ->where('id', '<>', $user_id)
             ->get();
      return $tickets;
  }

  public function chkTickets($id)
  {
      $tickets = DB::table('tickets')
             ->select(DB::raw('ticket_id'))
             ->where('id', '<>', $id)
             ->get();
      return $tickets;
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $user_id = Auth::user()->id;
      Ticket::create([
           'ticket_id' => $request->ticket_reference,
           'user_id' => $user_id
       ]);

      return redirect($this->redirectTo);
  }


  public function destroy($ticket_id)
  {
      Ticket::destroy($ticket_id);
  }
}
