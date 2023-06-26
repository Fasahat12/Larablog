<x-layout :$pageTitle>

    <div class='w-75 mx-auto'>
    <!-- Post content-->
    <article class='mb-2 mt-4'>
        <!-- Post header-->
        <header class="mb-4">
            <!-- Post title-->
            <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
            <!-- Post meta content-->
            <div class="text-muted fst-italic mb-2">Posted on {{ $post->created_at->format('F,d Y') }} by {{ $post->user->name }}</div>
            <!-- Post categories-->
            {{-- <a class="badge bg-secondary text-decoration-none link-light" href="#!">Web Design</a>
            <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a> --}}
        </header>
        <!-- Preview image figure-->
        <figure class="mb-4"><img style="width:900px;height:auto;object-fit:cover;" class="img-fluid rounded" src="{{ asset('storage/'.$post->image) }}" alt="..." /></figure>
        <!-- Post content-->
        <section class="mb-5">
            <p class="fs-5 mb-4">
                {!! $post->description !!}
            </p>
        </section>
    </article>

    <!-- Reactions section -->
    <section id='reaction-section' class='pb-4 mb-4'>
        <div class="btn-group  btn-group-lg" role="group" aria-label="Basic mixed styles example">
            <button id="like" type="button" class="btn btn-outline-dark position-relative {{ ($post->reactions->where('reaction','like')->where('user_id',auth()->id())->count() > 0)?'active':'' }}" style="font-size: 30px;">&#128077;<span class="badge bg-danger rounded-circle position-absolute" style="font-size: 11px;left:40px;top:3px;">{{ $post->reactions->where('reaction','like')->count(); }}</span></button>
            <button id="dislike" type="button" class="btn btn-outline-dark position-relative {{ ($post->reactions->where('reaction','dislike')->where('user_id',auth()->id())->count() > 0)?'active':'' }}" style="font-size: 30px;">&#128078;<span class="badge bg-danger rounded-circle position-absolute" style="font-size: 11px;left:40px;top:3px;">{{ $post->reactions->where('reaction','dislike')->count(); }}</span></button>
            <button id="funny" type="button" class="btn btn-outline-dark position-relative {{ ($post->reactions->where('reaction','funny')->where('user_id',auth()->id())->count() > 0)?'active':'' }}" style="font-size: 30px;">&#128516;<span class="badge bg-danger rounded-circle position-absolute" style="font-size: 11px;left:40px;top:3px;">{{ $post->reactions->where('reaction','funny')->count(); }}</span></button>
            <button id="insightful" type="button" class="btn btn-outline-dark position-relative {{ ($post->reactions->where('reaction','insightful')->where('user_id',auth()->id())->count() > 0)?'active':'' }}" style="font-size: 30px;">&#128161;<span class="badge bg-danger rounded-circle position-absolute" style="font-size: 11px;left:40px;top:3px;">{{ $post->reactions->where('reaction','insightful')->count(); }}</span></button>
          </div>           
    </section>

    <!-- Comments section-->
    <section id="comment-section" class="pb-4 mb-5 pb-4 ">
        <div class="card bg-light">
            <div class="card-body">
                <!-- Comment form-->
                <form id="comment-form" class="mb-4">
                    @csrf
                    <textarea id="comment" class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea>
                    <input name="submit" class="btn btn-primary btn-sm mt-2 d-none" type="submit" value="Post">
                </form>
                <!-- Single comments-->
                @foreach ($post->comments()->latest()->get() as $comment)
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0"><img style="width:50px;height:50px;" class="rounded-circle" src="{{ asset('images/user-profile.jpg') }}" alt="..." /></div>
                    <div class="ms-3 w-100">
                        @if (auth()->id() == $comment->user->id)
                            <div class="fw-bold d-flex">
                                <div class="flex-grow-1">
                                    {{ $comment->user->name }} <small class="fw-normal text-muted"> . You</small>
                                </div>    
                                <small class='fw-normal'>
                                    <a href="" class="text-decoration-none text-dark edit-comment"><i class="fas fa-edit"></i> Edit</a> | <a href="" class="text-decoration-none text-dark delete-comment"><i class="fa fa-trash"></i> Delete</a>
                                </small>
                            </div>
                            <span class='editable' id="{{ $comment->id }}">{{ $comment->comment }}</span>
                            <div>
                                <button class="edit-btn btn btn-primary btn-sm py-1 px-2 mt-2 d-none" type="button">Edit</button>
                                <button class="cancel-btn btn btn-danger btn-sm py-1 px-2 mt-2 d-none" type="button">Cancel</button>
                            </div>
                        @else
                            <div class="fw-bold">{{ $comment->user->name }}</div>
                            <span>{{ $comment->comment }}</span>
                        @endif
                    </div>
                </div>    
                @endforeach
                
            </div>
        </div>
    </section>

    </div>

    @section('scripts')
        <script>
            var editableComment = [];
            $(document).ready(function() {
                $('#comment').on('input',function() {
                    if($(this).val() !== ""){
                        $('[name=submit]').removeClass('d-none');
                    } 
                    else {
                        $('[name=submit]').addClass('d-none');
                    }    
                });

                $('#comment-form').on('submit',function(event){
                    event.preventDefault();
                    $('[name=submit]').addClass('d-none');
                    let post_id = {{ $post->id }};
                    let user_id = {{ auth()->id() }};
                    let comment = $('#comment').val();
                    $.ajax({
                        type: "POST",
                        url: '/api/comments',
                        dataType: 'json',
                        data: {post_id:post_id,user_id:user_id,comment:comment},
                        success: function(data){
                                     $('#comment').val("");
                                     let comment = data.comment; 
                                     let comment_id = data.id;
                                    $("#comment-form").after(`
                                                             <div class="d-flex mb-4">
                                                                <div class="flex-shrink-0"><img style="width:50px;height:50px;" class="rounded-circle" src="{{ asset('images/user-profile.jpg') }}" alt="..." /></div>
                                                                    <div class="ms-3 w-100">
                                                                        <div class="fw-bold d-flex">
                                                                            <div class="flex-grow-1">
                                                                                {{ auth()->user()->name }} <small class="fw-normal text-muted"> . You</small>
                                                                            </div>    
                                                                            <small class='fw-normal'>
                                                                                <a href="" class="text-decoration-none text-dark edit-comment"><i class="fas fa-edit"></i> Edit</a> | <a href="" class="text-decoration-none text-dark delete-comment"><i class="fa fa-trash"></i> Delete</a>
                                                                            </small>
                                                                        </div>
                                                                        <span class='editable' id="${comment_id}">${comment}</span>
                                                                        <div>
                                                                            <button class="edit-btn btn btn-primary btn-sm py-1 px-2 mt-2 d-none" type="button">Edit</button>
                                                                            <button class="cancel-btn btn btn-danger btn-sm py-1 px-2 mt-2 d-none" type="button">Cancel</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            `);                       
                                }
                    });
                });


                $('#comment-section').on('click','.edit-comment',function(event){
                    event.preventDefault();
                    $(this).parent().parent().siblings('.editable').attr('contenteditable','true');
                    $(this).parent().parent().siblings('.editable').trigger('focus');
                    $(this).parent().parent().siblings('div').children('.edit-btn').removeClass('d-none');
                    $(this).parent().parent().siblings('div').children('.cancel-btn').removeClass('d-none');
                });

                $('#comment-section').on('focus','.editable',function(event){
                    editableComment[$(this).attr('id')] = $(this).text();
                });

                $('#comment-section').on('click','.cancel-btn',function(){
                    let commentId = $(this).parent().siblings('.editable').attr('id');
                    let editableSpan = $(`#${commentId}`);
                    editableSpan.text(editableComment[commentId]);
                    editableSpan.siblings('div').children('.edit-btn').addClass('d-none');
                    editableSpan.siblings('div').children('.cancel-btn').addClass('d-none');
                    editableSpan.attr('contenteditable','false');
                });

                $('#comment-section').on('click','.edit-btn',function(event){
                    let commentId = $(this).parent().siblings('.editable').attr('id');   
                    let comment = $(`#${commentId}`).text();

                    $.ajax({
                        type: "PUT",
                        url: `/api/comments/${commentId}`,
                        dataType: 'json',
                        data: {comment:comment},
                        success: function(data){
                                    $(`#${commentId}`).text(data.comment);
                                    editableComment[commentId] = data.comment;
                                    $(`#${commentId}`).siblings('div').children('.edit-btn').addClass('d-none');
                                    $(`#${commentId}`).siblings('div').children('.cancel-btn').addClass('d-none');
                                    $(`#${commentId}`).attr('contenteditable','false');
                                }
                    });

                });

                $('#comment-section').on('click','.delete-comment',function(event){
                    event.preventDefault();
                    let commentId = $(this).parent().parent().siblings('.editable').attr('id');
                    let cancelBtn = $(this).parent().parent().siblings('div').children('.edit-btn');
                    let editBtn = $(this).parent().parent().siblings('div').children('.cancel-btn');

                    if (!cancelBtn.hasClass('d-none')) {
                        cancelBtn.addClass('d-none');
                    }

                    if(!editBtn.hasClass('d-none')) {
                        editBtn.addClass('d-none');
                    }
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result) {
                            if (result.value == true) {
                                $.ajax({
                                        type: "DELETE",
                                        url: `/api/comments/${commentId}`,
                                        dataType: 'json',
                                        success: function(data){
                                                console.log(data);
                                                $(`#${commentId}`).parent().parent().addClass('d-none');  
                                                }
                                    });

                                Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                );
                            }
                        }
                        })


                });

            
                $('#reaction-section .btn-group .btn').on('click',function(){
                    let user_id = {{ auth()->id() }};
                    let post_id = {{ $post->id }};
                    let reaction = $(this).attr('id');
                    let user_reaction = $('#reaction-section .btn-group .active');
                    if(user_reaction.length > 0 && user_reaction.attr('id') == reaction) {
                        $.ajax({
                            type: "DELETE",
                            url: "/api/reactions/{{$post->id}}/{{auth()->id()}}",
                            success: function(data) {
                                        let current_reaction = $('#reaction-section .btn-group .active');
                                        current_reaction.removeClass('active');
                                        let counter = current_reaction.children('.badge').text();
                                        counter--;
                                        current_reaction.children('.badge').text(counter);
                                    }
                        });                                    
                        return;
                    }
                    $.ajax({
                            type: "POST",
                            url: '/api/reactions',
                            dataType: 'json',
                            data: {post_id:post_id,user_id:user_id,reaction:reaction},
                            success: function(data) {
                                        let current_reaction_id = $('#reaction-section .btn-group .active').attr('id');
                                        if(current_reaction_id !== data.reaction) {
                                            $(`#${current_reaction_id}`).removeClass('active');
                                            let counter = $(`#${current_reaction_id}`).children('.badge').text();
                                            counter--;
                                            $(`#${current_reaction_id}`).children('.badge').text(counter);
                                            counter = $(`#${data.reaction}`).children('.badge').text();
                                            counter++;
                                            $(`#${data.reaction}`).children('.badge').text(counter);
                                            $(`#${data.reaction}`).addClass('active');
                                        }
                                    }
                        });
                    });            
                
            });
        </script>
    @endsection

</x-layout>