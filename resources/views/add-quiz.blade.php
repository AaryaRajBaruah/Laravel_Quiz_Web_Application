<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Quiz Page</title>
    @vite('resources/css/app.css')
</head>
<body>
     <x-navbar name={{$name}}></x-navbar> 
   
     <div  class=" bg-gray-100 flex  flex-col  items-center min-h-screen pt-5">
    <div class=" bg-white p-8 rounded-2xl shadow-lg w-full max-w-md  ">

            @if(!Session('quizDetails'))

    <h2 class="text-2xl text-center text-gray-800 mb-6 ">Add Quiz</h2>
          
    <form action="/add-quiz " method="get" class="space-y-4">
        
        <div>
            <input type="text" placeholder="Enter quiz here" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none " name="quiz">
        </div>
        <div>
            <select type="text"   class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none " name="category_id">
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="w-full bg-blue-600 text-white rounded-xl px-4 py-2 " > Add </button>
    </form>
    @else
    <span class="text-green-500 font-bold">Quiz : {{Session('quizDetails')->name}}</span>
    <h2 class="text-2xl text-center text-gray-800 mb-6 ">Add MCQs</h2>
    <form action="" method="get" class="space-y-4">
        <div>
            <Textarea type="text" placeholder="Enter your question name" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none " name="quiz" ></Textarea>
        </div>  
        <div>
            <input type="text" placeholder="Enter first option" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none " name="quiz">
        </div>
        <div>
            <input type="text" placeholder="Enter second option" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none " name="quiz">
        </div>
        <div>
            <input type="text" placeholder="Enter third option" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none " name="quiz">
        </div>
        <div>
            <input type="text" placeholder="Enter fourth option" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none " name="quiz">
        </div>
        <select name="Right asnwer" id="" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none " name="quiz">
            <option value="">Select Right Answer</option>
            <option value="">A</option>
            <option value="">B</option>
            <option value="">C</option>
            <option value="">D</option>
            
        </select>
        <button type="submit" class="w-full bg-blue-600 text-white rounded-xl px-4 py-2 " > Add More </button>
        <button type="submit" class="w-full bg-green-600 text-white rounded-xl px-4 py-2 " > Add and Submit  </button>

    </form>
    @endif
    </div>
    </div>


</body>
</html>