<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Million</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/app.css">
</head>
<body>
    <nav class="navbar w-100 navbar-light navbar-expand-lg mb-5 position-fixed" style="background-color:#000000; z-index:111;top:0">
        <div class="container">
            <a class="navbar-brand mr-auto text-light" href="/"><img src="/milli.png" alt="" style="width:50px"></a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-light" href="{{ route('register') }}">Register</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link  text-light" href="{{ route('signout') }}">Logout</a>
                    </li>
                   
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <!-- @yield('content') -->
    <div class="container mt-5">
      <div class="profile-page tx-13">
        <div class="row">
          <div class="row profile-body gap-3 pt-5">
            <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
              <div class="card rounded ">
                <div class="card-body">
                  <div class="row">
                      <h1 class="text-light">{{ auth()->user()->firstname}}</h1>
                      
                        <div class="input-group mb-3">
                          <input type="text" name="search" id="search_input" class="form-control input-text mx-2" placeholder="Search By Categories..." >
                          <div class="input-group-append">
                              <button class=" btn btn-outline-light btn-lg" type="submit"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                  </div>
                    
                    <p class="text-light" style="font-size:22px">Most searched :</p>
                    <div class="searched d-flex text-light" style="gap:10px;flex-wrap:wrap;">
                        <button type="button" class="btn btn-dark btn-rounded">Sport</button>
                        <button type="button" class="btn btn-dark btn-rounded">finance</button>
                        <button type="button" class="btn btn-dark btn-rounded">photography</button>
                        <button type="button" class="btn btn-dark btn-rounded">science</button>
                        <button type="button" class="btn btn-dark btn-rounded">technologie</button>
                        <button type="button" class="btn btn-dark btn-rounded">other</button>  
                    </div>
                </div>  
              </div>
            </div>
            <!-- ___________middle__wrapper_____________ -->
            <div class="col-md-8 col-xl-6 middle-wrapper rounded" style="padding:20px;background-color:#212121">
              <div class="row">
                <div class="col-md-12 grid-margin">
                  <div class="new-post d-flex mb-5 align-items-center">
                    <div>
                        <img class="img-xs rounded-circle"
                        src="https://i.pinimg.com/564x/2b/60/da/2b60da63e0ac554c8d3e190bdb65714d.jpg" alt=""/>
                    </div>
                    <div class="postarea w-100 mx-2">
                      <input class="w-100 p-4 rounded" type="text" placeholder="What's going on inside your head" readonly
                      data-bs-toggle="modal" data-bs-target="#newPost">
                    </div>
                  </div>
                  @foreach($posts as $post)
                  <div class="middle-card rounded">
                    <div class="card-header mb-5" style="background-color:#2b2b2d">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center justify-content-between">
                          <div class="d-flex align-items-center">
                            <img class="img-xs rounded-circle"
                            src="https://i.pinimg.com/564x/2b/60/da/2b60da63e0ac554c8d3e190bdb65714d.jpg" alt=""/>
                          </div>
                          <div class="mx-3 text-light">
                            <p style="margin-bottom:0px;font-size:24px">{{ $post->user->firstname }}</p>
                            <p style="margin-bottom:0px;font-size:12px;opacity:0.8">{{ $post->created_at->format('Y-m-d') }}</p>
                          </div></div>
                          @if($post->id_user == auth()->user()->id )
                          
                          <div class="dropdown">
                              <button class="bg-transparent border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="btn bi bi-three-dots-vertical text-light"></i>
                              </button>
                              <ul class="dropdown-menu" style="background-color:#303030">
                                <li><a id="{{$post->id}}" class="editPost dropdown-item text-primary" data-bs-toggle="modal" data-bs-target="#editPost" ><i class="bi bi-pencil"></i>edit</a></li>
                                <li><a href="{{ url('delete/'.$post->id) }}" class="dropdown-item text-danger"><i class="bi bi-trash-fill"></i>delete</a></li>
                              </ul>
                          </div>
                          @endif
                        </div>
                        
                        <div class="card-body rounded" style="background-color:#2b2b2d">
                            <p class="mb-3 tx-14 text-light" style="font-size:20px"> {{ $post->body }} </p>
                            <img class="img-fluid w-100"
                            src="{{asset('storage/'.$post->image)}}" alt="" />
                            @foreach($post->category as $cat)
                            <p class="categories btn btn-dark btn-rounded mt-2">{{$cat->name_category}}</p>
                            @endforeach
                        </div>
                        <div class="card-footer" style="background-color:#2b2b2d">
                          <div class="d-flex post-actions justify-content-around">
                            <div href="" class="d-flex align-items-center text-light mr-4 gap-2" style="text-decoration:none">
                            <svg
                              style="cursor:pointer"
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              class="heart_icon feather feather-heart icon-md"
                              >
                              <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                              </path>
                            </svg>
                              <div 
                              id="like_number"> 0
                              </div>
                          </div>
                          
                            <svg
                            style="text-decoration:none;cursor: pointer"
                            data-bs-toggle="modal" data-bs-target="#comments"
                              id="{{$post->id}}"
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              class="comment_icon feather feather-message-square icon-md text-light"
                            >
                              <path
                                d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"
                              ></path>
                            </svg>
                          
                        </div>
                      </div>
                    </div>
                  </div>
      


                   <!-- _____________comments__modal__________________ -->

                   <div class="modal fade" id="comments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" style="max-width:660px">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Comments</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="row d-flex">
                            <div class="container">
                              <div class="row">
                              <div class="commentaires">
                               <!-- js -->
                              </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <form action="{{ route('newcomment') }}"  method="post" id="newcomment">
                        @csrf
                          <div class="modal-footer">
                            <input type="hidden" name="id_post" class="modal_comment_id">
                            <input class="form-control" name="comment" placeholder="Write a comment..." style="width:90%" type="text">
                            <button type="submit" class="btn btn-dark"><i class="bi bi-send-fill"></i></button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- ___________________________end___________________________ -->
               
            
                  @endforeach
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div> 


<!-- _____________new__post__modal__________________ -->

<div class="modal fade" id="newPost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">New Post</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('newpost') }}" method="post" enctype="multipart/form-data">
      @csrf
        <div class="new-post d-flex mb-5 align-items-center">
                  <div>
                        <img
                          class="img-xs rounded-circle"
                          src="https://i.pinimg.com/564x/2b/60/da/2b60da63e0ac554c8d3e190bdb65714d.jpg"
                          alt=""/>
                  </div>
                  <div class="postarea w-100 mx-2">
                      <textarea class="w-100 p-2 rounded" name="body" placeholder="What's going on inside your head"></textarea>
                    </div>
                

                  <div>
                        <label class="btn btn-primary" for="imageBtn" style="cursor:pointer"><i class="bi bi-camera"></i></label>
                        <input class="d-none" type="file" name="image" id="imageBtn">
                  </div>
                </div>
                <div>
                    <img id="imagePost" style="width:100%" 
                     src="" alt="">
                </div>
                <h4>categories</h4>
                <div class="d-flex" style="gap:10px;flex-wrap:wrap">

                @foreach($categories as $category)
                  <button type="button" class="btn btn-dark btn-rounded">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" value="{{$category->id}}" name="category[]"/>
                      <label class="form-check-label">{{$category->name_category}}</label>
                    </div>
                  </button>
                  @endforeach
                </div>
                </div>
      <div class="modal-footer">
        <button type="submit" value="Save" class="btn btn-primary">Post</button>
      </div>
    </div>
    </form>
  </div>
</div>



<!-- _____________edit__post__modal__________________ -->

<div class="modal fade" id="editPost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Post</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{ url('edit') }}" method="post" enctype="multipart/form-data">
      @csrf
        <input type="text" name="postId" class="id_post_input">
        <div class="new-post d-flex mb-5 align-items-center">
                  <div>
                        <img
                          class="img-xs rounded-circle"
                          src="https://i.pinimg.com/564x/2b/60/da/2b60da63e0ac554c8d3e190bdb65714d.jpg"
                          alt=""/>
                  </div>
                  <div class="postarea w-100 mx-2">
                      <textarea class="w-100 p-2 rounded" name="body" placeholder="What's going on inside your head"></textarea>
                    </div>
                

                  <div>
                        <label class="btn btn-primary" for="imageBtn_edit" style="cursor:pointer"><i class="bi bi-camera"></i></label>
                        <input class="d-none" type="file" name="image" id="imageBtn_edit">
                  </div>
                </div>
                <div>
                    <img id="imagePost_edit" style="width:100%" 
                     src="" alt="">
                </div>
                <h4>categories</h4>
                <div class="d-flex" style="gap:10px;flex-wrap:wrap">
                @foreach($categories as $category)
                  <button type="button" class="btn btn-dark btn-rounded">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" value="{{$category->id}}" name="category[]"/>
                      <label class="form-check-label">{{$category->name_category}}</label>
                    </div>
                  </button>
                  @endforeach
                </div>
                </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Edit</button>
      </div>
    </div>
    </form>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="/script.js"></script>
</body>
</html>