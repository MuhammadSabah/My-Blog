@extends('layouts.app')

@section('content')
<div class="p-5 w-75 mx-auto">
    <h1>Account Settings</h1>

    <div>
        <div class="edit-container ">
            @if($auth_user->isAdmin == 'false')
            <form class="form-edit d-flex justify-content-between" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="image-box d-flex flex-column p-2 ">
                    <img id="uploadPreview" style="width: 260px; height: 260px;" src="{{ $user->imageUrl ? asset($user->imageUrl) : asset('') }}" />
                    <input class="mt-2" id="image" type="file" name="image" onchange="PreviewImage();" />
                    <script type="text/javascript">
                        function PreviewImage() {
                            var oFReader = new FileReader();
                            oFReader.readAsDataURL(document.getElementById("image").files[0]);

                            oFReader.onload = function(oFREvent) {
                                document.getElementById("uploadPreview").src = oFREvent.target.result;
                            };
                        };
                    </script>
                </div>

                <div class="form-edit save-changes-div d-flex gap-2 flex-column" style=" width: 400px;">
                    <h2 class="h4 mb-3 fw-normal">Basic Information</h2>
                    <input type="hidden" name="type" value="update">
                    <div class="form-floating ">
                        <input type="text" class=" form-control edit-name-field" name='name' id="name" value="{{$user->name}}">
                        <label for=" name">Full Name</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control edit-name-field" name='phoneNo' id="phoneNo" value="{{$user->phoneNo}}">
                        <label for="phoneNo">Phone No.</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control edit-email-field" name='email' id="email" value="{{$user->email}}">
                        <label for="email">Email address</label>
                    </div>
                    <button class="w-20 btn btn-sm btn-primary save-changes" id="btn-submit">Save Changes</button>
                </div>
            </form>
            @else
            <form class="form-edit d-flex justify-content-between">
                <div class="image-box d-flex flex-column p-2 ">
                    <img id="uploadPreview" style="width: 260px; height: 260px;" src="{{ $user->imageUrl ? asset($user->imageUrl) : asset('') }}" />
                </div>

                <div class="form-edit save-changes-div d-flex gap-2 flex-column" style=" width: 400px;">
                    <h2 class="h4 mb-3 fw-normal">Basic Information</h2>
                    <input type="hidden" name="type" value="update">
                    <div class="form-floating ">
                        <input type="text" class=" form-control edit-name-field" name='name' id="name" value="{{$user->name}}" readonly>
                        <label for=" name">Full Name</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control edit-name-field" name='phoneNo' id="phoneNo" value="{{$user->phoneNo}}" readonly>
                        <label for="phoneNo">Phone No.</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control edit-email-field" name='email' id="email" value="{{$user->email}}" readonly>
                        <label for="email">Email address</label>
                    </div>
                </div>
            </form>

            @endif
        </div>
        @if($auth_user->isAdmin == 'false')
        <div class="d-flex pass-container justify-content-end w-100 ">
            <form class="form-edit form-password ml-auto  d-flex gap-2 flex-column " style=" width: 400px;" method="POST" action="">
                @csrf
                @method('PUT')
                <h2 class="h4 mb-3 fw-normal">Security</h2>
                <input type="hidden" name="type" value="change">
                <input type="hidden" name='usersEmail' id="floatingInput">
                <div class="form-floating">
                    <input type="password" class="form-control signup-pass-field" name='usersPwd' id="floatingPassword">
                    <label for="floatingPassword">Current Password</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control signup-pass-field" name='usersPwdConfirm' id="floatingPasswordConfirm">
                    <label for="floatingPasswordConfirm">New Password</label>
                </div>
                <button class="w-20 btn btn-sm btn-primary" type="submit" name="save-password">Save Password</button>
            </form>
        </div>
        @else
        <div></div>
        @endif
    </div>
</div>

@endsection