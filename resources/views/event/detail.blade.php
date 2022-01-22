@extends('adminlte::page')

@section('title', $event->title)

@section('content_header')
    <h1>{{ $event->title }} 
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
    Добавить 
</button>
    </h1>
    <p><h5>Начальный банк:<span class="badge badge-info">{{ $event->bank}} </span> KZT</h5></p>
    <p><h5>Осталось заработать:<span class="badge badge-warning">{{ $event->bank - $event->countSum($event->id, 'win','show')}} </span> KZT</h5></p>
    <p><h5>Чистая прибыль:  <span class="badge badge-success">  {{ $event->countSum($event->id, 'win')}}</span> KZT</h5></p>
    <p><h5>Минус:   <span class="badge badge-danger">  {{ $event->countSum($event->id, 'failed')}}</span> KZT</h5></p>

@stop

@section('content')
 @include('message')
<table id="table_id" class="display">
    <thead>
        <tr>
            <th>#</th>
            
            <th>Сумма ставки</th>
            <th>Коэффициент</th>
            <th>Возможный выигрыш</th>
            <th>Котировки</th>
            <th>Статус</th>
            <th>Действие</th>
            <th>Создана</th>
        </tr>
    </thead>
    <tbody>
        @if($event->details()->count() > 0)
            @foreach($event->details as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->bank }}</td>
                    <td>{{ $item->odds }}</td>
                    <td>
                        @if($item->type == 'win')
                            <h5><span class="badge badge-success"> {{ $item->bank * $item->odds }} KZT</span></h5>
                        @elseif($item->type == 'failed')
                            <h5><span class="badge badge-danger"> {{ $item->bank }} KZT</span></h5>
                        @else 
                            <h5><span class="badge badge-secondary"> {{ $item->bank * $item->odds }} KZT</span></h5>
                        @endif
                   
                    </td>
                    <td>{{ $item->quotes }}</td>
                    <td>
                        @switch($item->type)
                            @case('win')
                                <h5><span class="badge badge-success">Выигрыш</span></h5>
                            @break
                            @case('failed')
                                <h5><span class="badge badge-danger">Проигрыш</span></h5>
                            @break
                            @case('process')
                                <h5><span class="badge badge-secondary">В игре</span></h5>
                            @break
                        @endswitch
        
                    </td>
                    <td>
                        <form action="{{ route('event-detail.changeStatus', $item->id)}}" method="POST">
                            @csrf 

                            <div class="form-group">
                                <label >Статус</label>
                                <select name="type">
                                    <option value='win'>Выигрыш</option>
                                    <option value='failed'>Проигрыш</option>
                                    
                                </select>
                                 <button type="submit" >Изменить</button>
                            </div>
                            
                        </form>
                    </td>
                    
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
        <h5 class="modal-title" id="exampleModalLabel">Добавить</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="{{ route('event-detail.store') }}" method="POST">
        @csrf
      <div class="modal-body">
       
            <div class="form-group">
                <label >Сумма</label>
                <input type="text" class="form-control"  name="bank">
            </div>
            <div class="form-group">
                <label >Коэффициент</label>
                <input type="text" class="form-control"  name="odds">
            </div>
            <div class="form-group">
                <label >Котировки</label>
                <input type="text" class="form-control"  name="quotes">
            </div>
            
            <input type="hidden" name="event_id" value="{{ $event->id }}">
        
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