<div class="card-header">
    <div class="row d-flex">
        <div class="col-9 pt-2">
            Task Index
        </div>
    </div>
</div>
<div class="card-body">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Project Name</th>
            <th scope="col">Project Code</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse($tasks as $key => $task)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{ $task->name }}</td>
                <td>{{ $task->project ? $task->project->name : $task->project_id }}</td>
                <td>{{ $task->project ? $task->project->code : $task->project_code }}</td>
                <td>{{ $task->status }}</td>
                <td>
                    <div class="row">
                        <div class="col-3">
                            <a href="{{ route('status_edit', $task->id) }}" class="btn btn-primary">Status Update</a>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="5"><span class="text-center"> There is no Task</span></td></tr>
        @endforelse
        </tbody>
    </table>
</div>
