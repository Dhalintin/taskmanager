<div x-show="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute w-full h-full bg-blue-700 opacity-25" x-on:click="isOpen = false"></div>

    <div class="modal-container bg-blue-800 w-11/12 md:max-w-md mx-auto shadow-lg z-50 overflow-y-auto text-white rounded-lg">
        <!-- Modal content -->
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-end">
                <button class="font-bold text-red-600" @click="isOpen = false">X</button>
            </div>
            <div x-text="data.title"  class="text-2xl font-bold mb-4 text-center"></div>

            <div class="text-gray-300"><span class="text-md font-semibold text-white">Description:</span>
                <span x-text="data.description" class="text-gray-300"></span>
            </div>
            <div><span class="text-md font-semibold text-white">Date:</span>
                <span x-text="data.date"></span>
            </div>
            
            <div>
                <span class="text-md font-semibold text-white">Status:</span> <span x-text="data.status" class="text-gray-300"></span>
            </div>

            <div class="float-right block">
                <button class="border-2 border-blue-500 text-white bg-blue-700 px-3 py-2 rounded-lg">Update Task</button>
            </div>

            <div class="float-end mt-5">
                Created at: <span x-text="data.created"></span>
            </div>
                         
        </div>
    </div>
</div>