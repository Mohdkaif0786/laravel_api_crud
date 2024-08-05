<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}
<link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
<script src="bootstrap5/js/bootstrap.min.js"></script>

<body>

    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="card pb-3 my-4">
                    <div class="card-header">
                        <h2>Login</h2>
                    </div>
                        <div class="form-group my-3">
                          <input type="email" id="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group  my-3">
                          <input type="password" id="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
    </div> 

    <script>
        $('#submit').click(function(e){
            e.preventDefault();
            let email=$('#email').val();
            let password=$('#password').val();
            // console.log(email)
            // ,"_token":"{{csrf_token()}}"
            console.log({email,password})
            $.ajax({
                url:'/api/login',
                type:'POST',
                contentType:'application/json',
                data:JSON.stringify({email,password}),
                success:function(response){
                  localStorage.setItem('api_token',response.token);
                  window.location.href="/allpost";
                },
                error:function(xhr,status,error){
                    alert('Error'+xhr.responseText)
                }
            })

        })
    

    </script>
</body>
</html>