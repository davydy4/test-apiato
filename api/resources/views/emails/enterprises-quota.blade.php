<p><strong>Превышена квота на сотрудников для следующих предприятий: </strong></p>
@foreach($enterprises as $enterprise)
    <p>{{ $enterprise['objsname'] }}</p>
@endforeach
