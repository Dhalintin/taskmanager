<x-app-layout class="bg-gradient-to-r from-cyan-500 to-blue-500">
    <div class="py-12 bg-gradient-to-r from-cyan-300 to-blue-500 h-full">
        <div class="text-center mx-8" id="calendar">
        </div>
    </div>
  
  <!-- Modal -->
  <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Task</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <div class="text-slate-600">
                    <div>
                        <label for="title" class="text-lg font-bold text-gray-600">Transaction Title</label>
                        <input type="text" name="title" id="title" placeholder="Task title" class="w-full rounded-lg shadow-md shadow-slate-400 focus:border-2 focus:border-slate-600 focus:shadow-gray-300 mb-2 task-input" required>
                        <span id="titleError" class="text-red-400"></span>
                    </div>
                    <div>
                        <label for="amount" class="text-lg font-bold text-gray-600">Transaction amount</label>
                        <input type="number" name="amount" id="amount" placeholder="Task amount" class="w-full rounded-lg shadow-md shadow-slate-400 focus:border-2 focus:border-slate-600 focus:shadow-gray-300 mb-2 task-input" required min="1">
                        <span id="amountError" class="text-red-400"></span>
                    </div>
                    <div>
                        <label for="title" class="text-lg font-bold text-gray-600">Description</label>
                        <textarea name="description" id="description" placeholder="Description..." class="w-full rounded-lg shadow-md shadow-slate-400 focus:border-2 focus:border-slate-600 focus:shadow-gray-300 mb-3 task-input" required></textarea>
                        <span id="desError" class="text-red-400"></span>
                    </div>
                    <div>
                        <input type="radio" name="type" id="income" value="1">Income
                        <input type="radio" name="type" id="expen" value="2">Expenses<br>
                        <span id="typeError" class="text-red-400"></span>
                    </div>
                    <div>
                        <input type="hidden" name="start_date" id="start_date" placeholder="Task title..."  required readonly>
                        <input type="hidden" name="end_date" id="end_date" placeholder="Task title..."  required readonly>
                    </div>
                </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="saveBtn"class="btn btn-primary">Save changes</button>
            </div>
      </div>
    </div>
  </div>

    
</x-app-layout>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const tasks = @json($events);
        var calendarHeight = $(window).height();
        
        $('#calendar').fullCalendar({
            height: calendarHeight,
            header: {
                left: 'prev, day, month',
                center: 'title',
                right: 'agendaWeek, agendaDay next '
            },
            visibleRange: {
                start: moment().startOf('month'),
                end: moment().endOf('month')
            },
            events: tasks,
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDays){
                $('#addTaskModal').modal('toggle')
                    var start_date = moment(start).format('YYYY-MM-DD');
                    var end_date = moment(end).format('YYYY-MM-DD');
                    $('#start_date').val(start_date);
                    $('#end_date').val(end_date)
                    

                $('#saveBtn').click(function() {
                    var title = $('#title').val();
                    var description = $('#description').val();
                    var amount = $('#amount').val();
                    var start_date = moment(start).format('YYYY-MM-DD');
                    var end_date = moment(end).format('YYYY-MM-DD');
                    var income = document.getElementById("income");
                    var expen = document.getElementById("expen");
                    if(income.checked === true){
                        var type = income.value;
                    }else if(expen.checked === true){
                        var type = expen.value;
                    }
                    
                    $.ajax({
                        url:"{{ route('add-Task') }}",
                        type:"POST",
                        dataType: 'json',
                        data:{
                            start_date, end_date, title, description, type, amount
                        },
                        success:function(response)
                        {
                            $('#calendar').fullCalendar('renderEvent', {
                                'title': response.title,
                                'start': response.start_date,
                                'end': response.end_date
                            });
                            $('.task-input').val('');
                            $('#addTaskModal').modal('hide');
                        },
                        error: function(error) {
                            if (error.responseJSON.errors) {
                                $('#titleError').html(error.responseJSON.errors.title);
                                $('#desError').html("Please add a short description");
                                $('#typeError').html(error.responseJSON.errors.type);
                                $('#amountError').html(error.responseJSON.errors.amount);
                            }
                            setTimeout(function(){
                                $('#titleError').text("");
                                $('#desError').text("");
                                $('#typeError').text("");
                                $('#amountError').text("");
                            },3000)
                        },
                    });
                });
            },
            editable: true,
            eventDrop: function(event){
                var id = event.id;
                var start_date = moment(event.start).format('YYYY-MM-DD');
                var end_date = moment(event.end).format('YYYY-MM-DD');

                $.ajax({
                    url:"{{ route('edit-Task', '') }}"+'/'+id,
                    type:"PATCH",
                    dataType: 'json',
                    data:{
                        start_date, end_date
                    },
                    success:function(response)
                    {
                        console.log(response)
                    },
                    error: function(error) {
                        console.log(error)
                    },
                });
            },

            eventClick: function(event){
                
                var id = event.id;
                var taskTitle = event.title;
                var taskDesc = event.description;
                Swal.fire({
                    title: taskTitle,
                    text: taskDesc,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url:"{{ route('delete-Task', '') }}"+'/'+id,
                            type:"DELETE",
                            dataType: 'json',
                            success:function(response)
                            {
                                var id = response;
                                $('#calendar').fullCalendar('removeEvents', response);
                                Swal.fire({
                                    title: "Good job!",
                                    text: "Event deleted successfully",
                                    icon: "success"
                                });
                            },
                            error: function(error) {
                                swal("", error, "");
                            },
                        });
                    }
                });
            },

            
        });

        $('#addTaskModal').on("hidden.bs.modal", function(){
            $("#saveBtn").unbind();
        });
    })
</script>
