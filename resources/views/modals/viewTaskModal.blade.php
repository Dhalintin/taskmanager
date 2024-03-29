<div x-show="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute w-full h-full bg-blue-700 opacity-25" x-on:click="isOpen = false"></div>

    <div class="modal-container bg-gray-100 md:max-w-md mx-auto w-11/12 z-50 h-11/12 border rounded-2xl m-5 p-3">
        <div x-text="data.title"  class="text-2xl font-bold mb-4 text-center"></div>
        <div x-text="data.description" class="text-gray-300"></div>
        <div x-text="data.date"></div>
        <div class="float-right block">
            <button class="border-2 border-blue-500 text-white bg-blue-700 px-3 py-2 rounded-lg bg-#3cb371 ">Update Task</button>
        </div>        
    </div>
</div>