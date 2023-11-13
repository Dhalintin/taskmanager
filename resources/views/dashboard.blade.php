<x-app-layout class="bg-gradient-to-r from-cyan-500 to-blue-500">
    <div class="py-12 bg-gradient-to-r from-cyan-300 to-blue-500 h-screen">
       <div class="grid grid-cols-3 ml-12 mr-12">
            <a href="{{ Route('history') }}">
                <div class="h-54 p-3 text-center hover-crosshair rounded-lg shadow-xl mr-3 ml-3 shadow-gray-400 hover:shadow-2xl hover:shadow-gray-600">
                    <img src="./../../images/viewtask.png" alt=""><span class="center font-cambria text-md font-bold text-gray-100">View Your task</span>
                </div>
            </a>
            
            <div x-data="{ isOpen: false, data:{} }"  x-on:keyup.esc="isOpen = false, editmodal = false" x-on:clickaway="isOpen = false">
                <div @click="isOpen = true" class="h-64 p-12 text-center hover-crosshair font-cambria rounded-lg shadow-lg mr-3 ml-3 shadow-gray-400 hover:shadow-xl hover:shadow-gray-500">
                    <img src="./../../images/addtask.png" alt="" class="block pl-20 mb-10"><span class="center text-md font-bold text-gray-100">Add A New Task</span>
                </div>
                @include('modals.addTaskModal')
            </div>
            
            <a href="{{ Route('stat', 'bar') }}">
                <div class="h-64 pl-12 p-5 text-center hover-crosshair  rounded-lg shadow-lg font-cambria mr-3 ml-3 shadow-gray-400 hover:shadow-xl hover:shadow-gray-500">
                    <img src="./../../images/stat.png" alt="" class="h-52 w-52 "><span class="center text-md font-bold text-gray-100">View Task Stat</span>
                </div>
            </a>
       </div>
    </div>
</x-app-layout>
