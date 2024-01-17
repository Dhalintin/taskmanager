<x-app-layout class="bg-gradient-to-r from-cyan-500 to-blue-500">
    <div class="py-12 bg-gradient-to-r from-cyan-300 to-blue-500 h-screen">
       <div class="grid grid-cols-4 ml-20 mr-20 mt-2 border-2 rounded-lg bg-blue-300" x-data="{ isOpen: false, data:{} }"  x-on:keyup.esc="isOpen = false, editmodal = false" x-on:clickaway="isOpen = false">
        <div class="grid col-span-4 row-h-4 text-center  float-center pt-2 mb-2 text-2xl font-semibold font-cambria uppercase text-blue-800">Budget for {{ date('Y') }}</div>
        <div class="month" @click="isOpen = true;">January</div>
        <div class="month" id="openModalButton" >February</div>
        <div class="month" @click="isOpen = true;">March</div>
        <div class="month" @click="isOpen = true;">April</div>
        <div class="month" @click="isOpen = true;">May</div>
        <div class="month" @click="isOpen = true;">June</div>
        <div class="month" @click="isOpen = true;">July</div>
        <div class="month" @click="isOpen = true;">August</div>
        <div class="month" @click="isOpen = true;">September</div>
        <div class="month" @click="isOpen = true;">October</div>
        <div class="month" @click="isOpen = true;">November</div>
        <div class="month" @click="isOpen = true;">December</div>
        @include('modals.budgetModal')
       </div>
       {{-- data = { month: 'January', amount: '10000', status: '', date: '', created: ''}" --}}
       {{-- 
        <a href="{{ route('budgetApi', ['mon'=>'01', 'year'=> '2024']) }}"></a>
<a href="{{ route('budgetApi', ['mon'=>'02', 'year'=> '2024']) }}"></a>
<a href="{{ route('budgetApi', ['mon'=>'03', 'year'=> '2024']) }}"></a>
<a href="{{ route('budgetApi', ['mon'=>'04', 'year'=> '2024']) }}"></a>
<a href="{{ route('budgetApi', ['mon'=>'05', 'year'=> '2024']) }}"></a>
<a href="{{ route('budgetApi', ['mon'=>'06', 'year'=> '2024']) }}"></a>
<a href="{{ route('budgetApi', ['mon'=>'07', 'year'=> '2024']) }}"></a>
<a href="{{ route('budgetApi', ['mon'=>'08', 'year'=> '2024']) }}"></a>
<a href="{{ route('budgetApi', ['mon'=>'09', 'year'=> '2024']) }}"></a>
<a href="{{ route('budgetApi', ['mon'=>'10', 'year'=> '2024']) }}"></a>
<a href="{{ route('budgetApi', ['mon'=>'11', 'year'=> '2024']) }}"></a>
<a href="{{ route('budgetApi', ['mon'=>'12', 'year'=> '2024']) }}"></a> --}}
    </div>

    <div id="myBtn" onclick="getBudget('01', '2024')">Open</div>
   
</x-app-layout>

<script>
// $(document).ready(function() {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

    var x = document.getElementById("myBtn");

    function getBudget(mon, year) {
      $.ajax({
        url: "/budget/" + mon + "/" + year,
        method: "GET",
        dataType: 'json',
        success: function(data) {
          console.log("Data retrieved:", data); // Log retrieved data for debugging
          // Process and display data here
        },
        error: function(error) {
          console.error("Error details:", error); // Log error details for debugging
          alert("Failed to retrieve budget. Please try again later."); // User-friendly error message
        }
      });
    };

// });  

</script>