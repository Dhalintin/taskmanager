{{-- <x-app-layout class="bg-gradient-to-r from-cyan-500 to-blue-500">
    <div class="py-12 bg-gradient-to-r from-cyan-300 to-blue-500 h-screen">
       
    </div>
</x-app-layout> --}}
<!DOCTYPE html>
<html lang="en">
 <head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>My Charts</title>
 {!! Charts::styles() !!}
 </head>
 <body>
 
 <div class="app">
 <center>
 {!! $chart->html() !!}
 </center>
 </div>
 
 {!! Charts::scripts() !!}
 {!! $chart->script() !!}
 </body>
</html>