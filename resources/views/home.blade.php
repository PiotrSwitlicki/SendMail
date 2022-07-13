

@extends('layouts.app')

@section('content')

            @if(Session::has('success'))
                <div class="alert alert-success">
                  {{ Session::get('success') }}
                </div>
            @endif

<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
            <div class="col-12 text-right">
            </div>
            </div>
            <div class="row" style="clear: both;margin-top: 18px;">
                <div class="col-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Do kogo</th>
                            <th>Tytuł maila</th>
                            <th><button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Dodaj</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                        <tr id="todo_{{$message->id}}">
                            <td>{{ $message->email  }}</td>
                            <td>{{ $message->title }}</td>
                            <td>
                                <a data-id="{{ $message->id }}" data-toggle="modal" data-target="#showModal{{ $message->id }}" class="btn btn-info">Show</a>
                                <form action="{{ route('destroy', $message->id)}}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="showModal{{ $message->id }}" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title">Zobacz mail</h1>
                                </div>

                                <div class="container">
                                   {{ $message->message }}
                                </div>
                            </div>
                          </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    
</div>
<div class="modal fade" id="addModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title">Dodaj mail</h1>
        </div>

        <div class="container">
            


            {!! Form::open(['route'=>'todostore']) !!}


                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    {!! Form::label('Do kogo:') !!}
                    {!! Form::text('email', old('email'), ['class'=>'form-control', 'placeholder'=>'email']) !!}
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>


                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    {!! Form::label('Tytuł:') !!}
                    {!! Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>'Tytuł maila']) !!}
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>


                <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                    {!! Form::label('Treść maila:') !!}
                    {!! Form::textarea('message', old('message'), ['class'=>'form-control', 'placeholder'=>'Treść maila w formie WYSIWYG']) !!}
                    <span class="text-danger">{{ $errors->first('message') }}</span>
                </div>


                <div class="form-group">
                    <button class="btn btn-success">Zapisz</button>
                </div>


            {!! Form::close() !!}


        </div>
    </div>
  </div>
  
</div>


  
</div>
<div class="modal fade" id="editTodoModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Todo</h4>
        </div>
        <div class="modal-body">

               <input type="hidden" name="todo_id" id="todo_id">
                <div class="form-group">
                    <label for="name" class="col-sm-2">Task</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="edittask" name="todo" placeholder="Enter task">
                        <span id="taskError" class="alert-message"></span>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="updateTodo()">Save</button>
        </div>
    </div>
  </div>
<script>

</script>
@endsection
