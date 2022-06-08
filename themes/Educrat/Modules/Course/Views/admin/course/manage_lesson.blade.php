@if($row->id)
    <a class="btn btn-warning btn-sm" href="{{route('course.admin.lesson.index',['id'=>$row->id])}}" >{{__("Manage Lessons")}}</a>
@endif
