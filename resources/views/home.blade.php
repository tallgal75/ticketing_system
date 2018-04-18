@extends('layouts.main')

@section('title')
   @parent
@endsection

@section('header')
    @parent
@endsection

@section('sidebar')
  @parent
@endsection

@section('content')
  <div class="col-md-12">
    <h1>Home Page</h1>
     <h2>My Tickets</h2>
     <div class="row">
       <div class="col-md-6">
         <h2>Simple Ticketing</h2>
         <p>Your ticket reference is: {{ $ticket_reference }}. Enter it in the form below to generate tickets.</p><br>
         <form action="/tickets/store" method="post">
           {{ csrf_field() }}
           <div class="input-group{{ $errors->has('ticket_reference') ? ' has-error' : '' }}">
             <span class="input-group-addon">Request ID</span>
             <input type="text" class="form-control" name="ticket_reference" required>
             @if ($errors->has('ticket_reference'))
                 <span class="help-block">
                     <strong>{{ $errors->first('ticket_reference') }}</strong>
                 </span>
             @endif
         	</div>
           <br>
         	<button type="submit" class="btn btn-primary">Get Tickets</button>
         </form>
       </div>
      <div id="ticketCount" class="col-md-6">
        <h2>My Tickets</h2>
        <?php
        $queue_counter =0;
        $queued_tickets = [];
       ?>
        @foreach ($tickets AS $ticket)
          <p>{{ $ticket->id}} : {{ $ticket->ticket_id}}</p>
          <?php
          $queue_counter++;
          $queued_tickets[$queue_counter] = $ticket->id;
          if($queue_counter%10 == 0) {
            //log the file
            $myfile = fopen("ticket_queue.log", "w");
            fwrite($myfile, $queued_tickets);
            fclose($myfile);
          }
          ?>
        @endforeach
      </div>

  </div>
@endsection
