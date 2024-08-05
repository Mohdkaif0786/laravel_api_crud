<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

<link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
<script src="bootstrap5/js/bootstrap.min.js"></script>

<body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="bg-primary py-2 text-white px-3">All Posts</h2>    
            </div>
            <div class="col-12 my-2">
                <form class="px-2" id="addform">
                    <div class="form-group my-3">
                      <input type="text" name="title" id="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">
                    </div>
                    <div class="form-group  my-3">
                        <textarea name="description" id="description" class="form-control" id="" cols="10" rows="4" placeholder="Enter Description"></textarea>
                    </div>
                    <div class="custom-file form-group">
                        <input type="file" name='image' id="image" class="form-control" id="customFile">
                      </div>
                    <button type="submit" id="submit" class="btn btn-primary my-2">Submit</button>
                    <button  class="btn btn-secondary my-2">Back</button>
                 </form> 
            </div>
        </div>
    </div> 

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        let addForm=document.querySelector('#addform');
        addForm.addEventListener('submit',async(e)=>{
            e.preventDefault();
            const tokent=localStorage.getItem('api_token');
            console.log('token:',tokent);
            let title=document.querySelector('#title').value;
            let description=document.querySelector('#description').value;
            let image=document.querySelector('#image').files[0];
            console.log({title,description,image})



            let formData=new FormData();
            formData.append('title',title);
            formData.append('description',description);
            formData.append('image',image);

            let response=await fetch('/api/posts',{
                method:"POST",
                body:formData,
                headers:{
                    'Authorization':`Bearer ${tokent}`
                }
            }).then(resp=>resp.json()).then(data=>{
                // window.location.href="/allpost";
                console.log(data);
            });
            
              
        })
        

    </script>
</body>
</html>