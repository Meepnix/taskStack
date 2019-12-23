
<div class="card">
    <div class="card-header" role="tab" id="heading">
        <h4>Slot {{ $loop->iteration }}</h4>
                           
                                    
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Task Set:</h5>
                <p> {{ optional($slot->task)->title ? $slot->task->title : "--SLOT EMPTY--" }} </p>
            </div>
                                
            <div class="col-md-6">
                <h5>Days Set:</h5>          
            @if ($slot->mon)
                <strong><span class="badge badge-info">Monday</span></strong>
            @endif

            @if ($slot->tue)
                <strong><span class="badge badge-info">Tuesday</span></strong>
            @endif

            @if ($slot->wed)
                <strong><span class="badge badge-info">Wednesday</span></strong>
            @endif

            @if ($slot->thu)
                <strong><span class="badge badge-info">Thursday</span></strong>
            @endif

            @if ($slot->fri)
                <strong><span class="badge badge-info">Friday</span></strong>
            @endif

            @if ($slot->all)
                <strong><span class="badge badge-info">All</span></strong>
            @endif

            </div>
        </div>

        <a href="{{ route('admin.slot.edit', [$slot->id]) }}" class="btn btn-secondary">
            <i class="fa fa-btn fa-edit" aria-hidden="true"></i>Edit
        </a>

        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteUser{{ $loop->index }}">
            <i class="fa fa-btn fa-trash" aria-hidden="true"></i>Delete
        </a>

        

        <!-- Delete User Modal -->
        <div 
        class="modal fade" 
        id="deleteUser{{ $loop->index }}" 
        tabindex="-1" 
        role="dialog" 
        aria-labelledby="exampleModalLabel" 
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Slot</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Do you wish to continue and delete Slot {{ $loop->iteration }} ?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('admin.slot.delete', [$slot->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                                                
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No
                            </button>
                            <button type="submit" class="btn btn-danger">Yes
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<br>


                            