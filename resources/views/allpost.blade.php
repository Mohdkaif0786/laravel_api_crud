<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
<script src="bootstrap5/js/bootstrap.min.js"></script>
  <style>
    .post-image{
      width:90px !important;

    }
  </style>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="bg-primary py-2 text-white px-3">All Posts</h2>    
            </div>
            <div class="col-12 my-4 d-flex gap-2">
                <a href="/addpost"><button class="btn btn-primary" id="addpost_btn">Add Post</button></a>
                 <button class="btn btn-danger" id="logout_btn">Logout</button>
            </div>
            <div class="col-11">
                <table class="table mx-4">
                    <thead>
                      <tr class="bg-dark text-white py-2">
                        <th scope="col">Id</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">View</th>
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                  </table>
            </div>
        </div>
    </div> 


    {{-- single post view model box --}}
    <div class="modal fade" id="singlepostModel" tabindex="-1" aria-labelledby="singlepostLable" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="singlepostLable">View Post</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="singlepostModal_body">
              Loading...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Send message</button>
          </div>
        </div>
      </div>
    </div>

      {{-- update post model box --}}
     <div class="modal fade" id="updatepostModel" tabindex="-1" aria-labelledby="updatepostLable" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="updatepostLable">Update Post</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id='updatepostmodel_body'>
            <div class="form-group">
              <input type="hidden"  readonly class="form-control"  aria-describedby="emailHelp" placeholder="Enter title" id="pid" >
            </div>
            <div class="form-group my-3">
              <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter title" id="title">
            </div>
            <div class="form-group  my-3">
                <textarea name="" class="form-control"  cols="10" rows="4" placeholder="Enter Description" id="description"></textarea>
            </div>
            <div class="custom-file form-group">
                <input type="file" class="form-control" id="image" >
            </div>
            <div class="form-group my-2">
                <img src="/uplods/1721883431.webp" class="fluid" style="width:100%;height:110px" id="imgshow" alt="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" id="updatPostBtn" class="btn btn-primary">Update Post</button>
          </div>
        </div>
      </div>
    </div>

    {{-- <button ></button> --}}

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>  
    <script>
        document.getElementById('logout_btn').addEventListener('click',function(e){
          const tokent=localStorage.getItem('api_token');
          fetch('/api/logout',{
            method:'POST',
            headers:{
                  "Authorization":`Bearer ${tokent}`,
            }

          }).then(resp=>resp.json()).then(result=>{

            console.log(result);
              window.localtion.href('/');
          })

       
        })

        function getPostsData(){
          const tokent=localStorage.getItem('api_token');
          console.log(tokent)
          fetch('/api/posts',{
               headers:{
                  "Authorization":`Bearer ${tokent}`,
               }
            }).then((resp)=>resp.json()).then((data)=>{
              console.log(data);
              let posts=data?.data?.posts;
              
              posts.forEach((post,ind) => {
                console.log(ind);
                let newElm=` <tr>
                        <th scope="row">${ind+1}</th>
                        <td><img class='post-image' src="uplods/${post.image}" alt=""></td>
                        <td>${post.title}</td>
                        <td>${post.description}</td>
                        <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#singlepostModel" data-bs-postid="${post.id}">View</button></td>
                        <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updatepostModel" data-bs-postid="${post.id}">Update</button></td>
                        <td><button class="btn btn-danger del-btn" onclick="deletePost(${post.id})" id='del-btn' data-toggle="modal" data-target="#deletepostModal" >Delete</button></td>
                      </tr>
                      `;
                      document.getElementById('tbody').innerHTML+=newElm;
              });
            })


        }
      
        getPostsData();

        let singlepostModel=document.getElementById('singlepostModel');
          // console.log(singlepostModel);
        if (singlepostModel) {
            singlepostModel.addEventListener('show.bs.modal', event => {
              
              const button = event.relatedTarget    
              const postid = button.getAttribute('data-bs-postid')
              console.log(postid);
              const tokent=localStorage.getItem('api_token');
            fetch(`api/posts/${postid}`,{
                headers:{
                  //  "Authentication":`Bearer ${tokent}`,
                   "Authorization":`Bearer ${tokent}`,
                }
            }).then(resp=>resp.json()).
            then(result=>{
              let singlePost=result?.data?.posts[0];
              let dataTable=` <table class="table table-striped">
              <tr>
                <th>Title</th>
                <td>${singlePost['title']}</td>
              </tr>

              <tr>
               <th>Description</th>
               <td>${singlePost['description']}</td>
             </tr>
           </table>`;
           document.querySelector('#singlepostModal_body').innerHTML=dataTable;
            })})


          ////////////////////////////////////////////////////////////////
          // fetch data submit in update model 
          let updatepostModel=document.querySelector('#updatepostModel');
          console.log(updatepostModel);
          if (updatepostModel) {
            updatepostModel.addEventListener('show.bs.modal', event => {
              
              const button = event.relatedTarget    
              const postid = button.getAttribute('data-bs-postid')
              console.log(postid);
              const tokent=localStorage.getItem('api_token');
              console.log(tokent);

              fetch(`/api/posts/${postid}`,{
                 headers:{
                    "Authorization":`Bearer ${tokent}`
                 }
              }).then(resp=>resp.json()).then(data=>{
                 let singlePost=data?.data?.posts[0];
                 document.querySelector('#pid').value=postid;
                 document.querySelector('#title').value=singlePost['title'];
                 document.querySelector('#description').value=singlePost['description'];
                    
              })
            }
            
         )}
        //////////////////////////////////////////////////////////////////////////
        // update post code here
          let updateBtn=document.querySelector('#updatPostBtn');
          console.log(updateBtn);
          updateBtn.addEventListener('click',(e)=>{
              let pid=document.querySelector('#pid').value;
                 console.log(pid)

              let titleElm=document.querySelector('#title').value;
              let descriptionElm=document.querySelector('#description').value;
              
              // console.log(descriptionElm)
              
              // let formData=new FormData();
              let formData=new FormData();
              
              formData.append('title',titleElm);
              formData.append('description',descriptionElm);

              // let imageElm=null;
              console.log(document.querySelector('#image').files[0]);
                let imageElm=document.querySelector('#image').files[0];
                console.log(imageElm);
                formData.append('image',imageElm); 
              
                
               let jsonData=JSON.stringify({title:titleElm,description:descriptionElm,image:imageElm});
                 console.log('json:',jsonData);
               const tokent=localStorage.getItem('api_token');

               fetch(`/api/posts/${pid}`,{
                method:"POST",
                body:formData,
                headers:{
                    'Authorization':`Bearer ${tokent}`,
                    'X-HTTP-Method-Override':'PUT'
                }
            }).then(resp=>resp.json()).then(data=>{
                // window.location.href="/allpost";
                console.log(data);
            });

              
          })
  }

///////////////////////////////////////////////////////////////////////////
// delete post code here
let delPostBtn=document.querySelector('.del-btn');
  console.log(delPostBtn);
  // delPostBtn.addEventListener('click',function(){
  //    alert('hlelo jj;lkj;lkjh ;lkj;lkjhj;lkjhj;lkjhj ')
  // })

  function deletePost(pid){
    const tokent=localStorage.getItem('api_token');
    fetch(`/api/posts/${pid}`,{
      method:"DELETE",
      headers:{
          "Authorization":`Bearer ${tokent}`,
          "X-HTTP-Method-Override":"DELETE"
      }
    }).then(resp=>resp.json()).then(res=>{
      if(res.status==true){
         window.href='/allposts';
      }
      console.log(res);
    });
  }


    </script>


</body>
</html>