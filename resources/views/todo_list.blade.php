<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Todo List</title>
</head>
<Style>
    body{
        font-family: 'Poppins', sans-serif;
    }
    .main {
        background: rgb(238,174,202);
        background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100vh;
    }
    .h1{
        color: white;
    }
    .input_list_wrappper{
        display:flex;
        justify-content: center;
    }
    .list{
        width: 450px;
        height: 50px;
        border-radius: 10px 0px 0px 10px;
        border: none;
        font-size: 20px; 
        padding: 0px 10px 0px 10px;
    }
    .list::placeholder{
        font-size: 20px; 
        color: #cfd0d1;
    }
    .list[type="text"]{
        border: none;
        outline: none;
    }
    .container{
        display: flex;
        flex-direction: column;
        width:350px;
        justify-content: center;
        margin: auto;
    }
    .btn_add_list, .btn_save_list{
        height: 50px;
        border: none;
        background-color:#94d4f2;
        font-size: 20px;
        border-radius: 0px 10px 10px 0px;
        color:white;
    }
    .btn_save_list{
        border-radius: 0px;
    }
    .todos{
        width: 350px;
        height: 50px;
        display: flex;
    }
    .todos .todo{
        width: 150px;
        font-size: 20px;
        padding: 0px 10px 0px 10px;
        border-radius: 10px;
        background-color: white;
        display: flex;
        align-items: center;
        transition: 0.3s;
        cursor: pointer;
    }
    .todos .btn_remove, .btn_cancel{
        display: none;
        transition: 0.3s;
    }
    .todos .btn_edit{
        display: none;
        transition: 0.3s;
    }
    .todos:hover .btn_edit{
        display: block;
        background-color: #94d4f2;
        height: 50px;
        width: 50px;
        border: none;
        font-size: 20px;
        color: white;
        cursor: pointer;
    }
    .todos:hover .btn_remove, .btn_cancel{
        display: block;
        background-color: #f57d81;
        height: 50px;
        width: 50px;
        border: none;
        font-size: 20px;
        color: white;
        border-radius: 0px 10px 10px 0px;
        cursor: pointer;
    }
    .todos:hover .todo{
        width: 250px;
        border-radius: 10px 0px 0px 10px;
    }

    .mt-1{
        margin-top: 1em;
    }

</Style>
<body>
    <div class="main">
        <h1 class="h1" style="text-align: center;">Todo List</h1>
        <div class="container">
            <!-- create -->
            <div class="">{{ session('success') }}</div>
            <form method="post" action="{{ route('todos.store') }}">
            @csrf
                <div class="input_list_wrappper">
                    <input type="text" name="title" class="list" placeholder="Enter Task">
                    <button type="submit" class="btn_add_list">Add</button>
                </div>
            </form> 
            
            @foreach ($todos as $key => $todo) 
                <div class="todos mt-1" id="{{ 'todo_'.$todo->id }}">
                    <input class="id" type="hidden" value="{{ $todo->id }}">
                    <div  id="{{ 'todo_title_'.$todo->id }}" class="todo">{{ $todo->title }}</div>
                   
                    <button class="btn_edit" id="{{ $todo->id }}">Edit</button>
                    <form method="post" action="{{ route('todos.delete',$todo->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn_remove">X</button>
                    </form>
                    
                </div>
                <form class="mt-1" method="post" action="{{ route('todos.update',$todo->id) }}" id="{{ 'edit_todo_'.$todo->id }}" style="display:none;">
                @csrf
                @method('PATCH')
                    <div class="input_list_wrappper">
                        <input type="hidden" class="edit_id" name="id" >
                        <input type="text" id="{{ 'edit_title_'.$todo->id }}" class="list" name="title" placeholder="Edit Task">
                        
                        <button type="submit" class="btn_save_list">Save</button>
                        <button class="btn_cancel">X</button>
                    </div>
                </form> 
            @endforeach

        </div>
    </div>
</body>
<script>
    $('.btn_edit').click(function(e){
    //    var todo_id = $(".id").val();
    //    var todo_title = $('.todo').text()
        let todo_id = e.target.getAttribute('id');
        let todo_title = $('#todo_title_'+todo_id).text();

        $('#todo_'+todo_id).hide();
        $('#edit_todo_'+todo_id).show();
        $('#edit_title_'+todo_id).val(todo_title);
        
    })


</script>
</html>