@extends('adminlte::page')

@section('title', 'Главная страница')

@section('content_header')
    <h1>Событие
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
    Создать 
</button>
    </h1>
@stop

@section('content')
@include('message')
<table id="table_id" class="display">
    <thead>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Банк</th>
            <th>Цель</th>
            <th>Статус</th>
            <th>Кол-во ставок</th>
            <th>Создана</th>
        </tr>
    </thead>
    <tbody>
        @if($event->count() > 0)
            @foreach($event as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        <a href="{{ route('event-detail.show', $item->id)}}">
                            {{ $item->title }}
                        </a>
                    </td>
                    <td>{{ $item->bank }}</td>
                    <td>{{ $item->goal }}</td>
                    <td>{{ $item->status == 1 ? 'Открыто' : 'Закрыто' }}</td>
                    <td>{{ $item->details_count }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        @endif    
        
       
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Создать событие</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="{{ route('event.store') }}" method="POST">
        @csrf
      <div class="modal-body">
       
            <div class="form-group">
                <label >Название</label>
                <input type="text" class="form-control"  name="title">
            </div>
            <div class="form-group">
                <label >Банк</label>
                <input type="text" class="form-control"  name="bank">
            </div>
            <div class="form-group">
                <label >Цель</label>
                <input type="text" class="form-control"  name="goal">
            </div>
            <input type="hidden" name="status" value="1">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="submit" class="btn btn-primary">Создать</button>
      </div>
      </form>
    </div>
  </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

@stop

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    });
    </script>
@stop