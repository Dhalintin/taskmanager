<x-app-layout>
    <div class="bg-gradient-to-r from-cyan-300 to-blue-500">
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
                        @if ($task->status->name === 'Income')
                            <div class="p-6 text-gray-900 mb-3 dark:text-gray-100 bg-green-400 mr-3 shadow-lg shadow-gray-400 rounded-xl hover:shadow-gray-600" 
                            @click="
                                isOpen = true;
                                data = { 
                                    title: '{{ $task->title }}',
                                    description: '{{ $task->description }}',
                                    status: '{{ $task->status->name }}',
                                    date: '{{ $task->start_date }}',
                                    created: '{{ $task->created_at }}'
                                }
                            ">
                                <div class="text-center text-slate-600 font-bold text-cambria">{{ $task->title }}</div>
                                <div>Description: {{ $task->description }}</div>
                                <div>{{ $task->status->name }}</div>
                            </div>
                        @else
                            <div class="p-6 text-gray-900 dark:text-gray-100 mb-3 bg-white mr-3 shadow-lg shadow-gray-400 rounded-xl hover:shadow-gray-600" 
                            @click="
                                isOpen = true;
                                data = { 
                                    title: '{{ $task->title }}',
                                    description: '{{ $task->description }}',
                                    status: '{{ $task->status->name }}',
                                    date: '{{ $task->start_date }}',
                                    created: '{{ $task->created_at }}'
                                }
                            ">
                                <div class="text-center text-slate-600 font-bold text-cambria">{{ $task->title }}</div>
                                <div>Description: {{ $task->description }}</div>
                                <div>{{ $task->status->name }}</div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div>You don't have any task</div>
                @endif
                @include('modals.viewTaskModal')
            </div>
        </div>
    </div>
    <div class="p-4 space-evenly">{{ $tasks->links() }}</div>
</x-app-layout>