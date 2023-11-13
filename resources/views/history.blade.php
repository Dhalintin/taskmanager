<x-app-layout>
    <div class="bg-gradient-to-r from-cyan-300 to-blue-500 h-screen">
        <div class="pt-12">
            <!--Notification -->
        @if(Session::has('sucess'))
            {{ Session('success') }}
        @elseif(Session::has('failed'))
            {{ Session('failed') }}
        @endif
        <!-- Task -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3  dark:bg-gray-800" x-data="{ isOpen: false, data:{} }"  x-on:keyup.esc="isOpen = false, editmodal = false" x-on:clickaway="isOpen = false">
                @if (count($tasks) > 0)
                    @foreach ($tasks as $task)
                        @if ($task->statuses->name === 'Completed')
                            <div class="p-6 text-gray-900 dark:text-gray-100 bg-green-400 mr-3 shadow-lg shadow-gray-400 rounded-xl hover:shadow-gray-600" 
                            @click="
                                isOpen = true;
                                data = { 
                                    title: '{{ $task->title }}',
                                    description: '{{ $task->description }}',
                                    status: '{{ $task->statuses->name }}',
                                    date: '{{ $task->start_date }}',
                                    created: '{{ $task->created_at }}'
                                }
                            ">
                                <div class="text-center text-slate-600 font-bold text-cambria">{{ $task->title }}</div>
                                <div>Description: {{ $task->description }}</div>
                                <div>{{ $task->statuses->name }}</div>
                            </div>
                        @else
                            <div class="p-6 text-gray-900 dark:text-gray-100 bg-white mr-3 shadow-lg shadow-gray-400 rounded-xl hover:shadow-gray-600" 
                            @click="
                                isOpen = true;
                                data = { 
                                    title: '{{ $task->title }}',
                                    description: '{{ $task->description }}',
                                    status: '{{ $task->statuses->name }}',
                                    date: '{{ $task->start_date }}',
                                    created: '{{ $task->created_at }}'
                                }
                            ">
                                <div class="text-center text-slate-600 font-bold text-cambria">{{ $task->title }}</div>
                                <div>Description: {{ $task->description }}</div>
                                <div>{{ $task->statuses->name }}</div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div>You don't have any task</div>
                @endif
   
                @include('modals.viewTaskModal')

            </div>
        </div>
        <!-- End of Task -->
   
        <!-- Add Task form -->
        <div x-data="{ isOpen: false }"  x-on:keyup.esc="isOpen = false, uploadModal = false" x-on:clickaway="isOpen = false">
            <!-- Button to open the modal -->
            <div @click="isOpen = true" class="float-right mt-12 mr-6 px-3 py-2 bg-gray-300 rounded-lg  shadow-lg shadow-slate-700 z-50">Add Task</div>
            
            <!-- Add Task Modal -->
            @include('modals.addTaskModal')
            
            
        </div>
        </div>
         
   
    </div>
</x-app-layout>