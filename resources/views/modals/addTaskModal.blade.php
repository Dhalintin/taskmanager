<div x-show="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute w-full h-full bg-cyan-700 opacity-50" x-on:click="isOpen = false"></div>

    <div class="modal-container bg-blue-800 w-11/12 md:max-w-md mx-auto shadow-lg z-50 overflow-y-auto text-white rounded-lg">
        <!-- Modal content -->
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-end">
                <button class="font-bold text-red-600" @click="isOpen = false">X</button>
            </div>
            <div class="text-2xl font-bold mb-4 text-center">Add Task</div>
            
            <!-- Form -->
            <form action="{{ Route('add-Task') }}" method="POST" class="text-slate-600">
                @csrf
                  <div>
                      <label for="title" class="text-lg font-bold text-gray-200">Title</label>
                      <input type="text" name="title" placeholder="Task title" class="w-full rounded-lg shadow-md shadow-slate-400 focus:border-2 focus:border-slate-600 focus:shadow-gray-300 mb-2" required>
                  </div>
                  <div>
                    <label for="title" class="text-lg font-bold text-gray-200">Description</label>
                    <textarea name="description" placeholder="Description..." class="w-full rounded-lg shadow-md shadow-slate-400 focus:border-2 focus:border-slate-600 focus:shadow-gray-300 mb-3" required></textarea>
                </div>
                <div>
                    <label for="start_date" class="text-lg font-bold text-gray-200">Start Date</label>
                    <input type="date" name="start_date" min="@php echo date('Y-m-d') @endphp" class="w-full rounded-lg shadow-md shadow-slate-400 focus:border-2 focus:border-slate-600 focus:shadow-gray-300 mb-3" required>
                </div>
                <div>
                    <label for="due_date" class="text-lg font-bold text-gray-200">Due Date</label>
                    <input type="date" name="due_date" min="@php echo date('Y-m-d') @endphp" class="w-full rounded-lg shadow-md shadow-slate-400 focus:border-2 focus:border-slate-600 focus:shadow-gray-300 mb-3">
                </div>
                 
                <div class="flex justify-end">
                  <button type="submit" class="text-white border border-amber-200 px-4 py-2 rounded-md hover:bg-amber-900 hover:text-black transition mt-6">Submit</button>
                <button x-on:click="isOpen = false" class="text-white border border-amber-200 px-4 py-2 ml-3 rounded-md hover:bg-amber-900 hover:text-black transition mt-6" >Cancel</button>
                </div>   
            </form>              
        </div>
    </div>
</div>