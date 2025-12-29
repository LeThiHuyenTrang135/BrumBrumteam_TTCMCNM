@extends('admin.layout.master')

@section('title', 'Edit User')

@section('body')
    <div class="app-main__inner">

        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Edit User
                        <div class="page-title-subheading">
                            Update user information
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="post" action="/admin/user/{{ $user->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @include('admin.components.notification')

                            <div class="position-relative row form-group">
                                <label for="image"
                                    class="col-md-3 text-md-right col-form-label">Avatar</label>
                                <div class="col-md-9 col-xl-8">
                                    <img style="height: 200px; cursor: pointer;"
                                        class="thumbnail rounded-circle" data-toggle="tooltip"
                                        title="Click to change the image" data-placement="bottom"
                                        src="{{ asset($user->avatar ?? 'front/img/user/default-avatar.png') }}" alt="Avatar">
                                    <input name="image" type="file" onchange="changeImg(this)"
                                        class="image form-control-file" style="display: none;" value="">
                                    <input type="hidden" name="image_old" value="{{ $user->avatar }}">
                                    <small class="form-text text-muted">
                                        Click on the image to change
                                    </small>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Name</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="name" id="name" placeholder="Name" type="text"
                                        class="form-control" value="{{ $user->name }}">
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="email"
                                    class="col-md-3 text-md-right col-form-label">Email</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="email" id="email" placeholder="Email" type="email"
                                        class="form-control" value="{{ $user->email }}">
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="password"
                                    class="col-md-3 text-md-right col-form-label">Password (leave blank to keep current)</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="password" id="password" placeholder="Password" type="password"
                                        class="form-control" value="">
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="password_confirmation"
                                    class="col-md-3 text-md-right col-form-label">Confirm Password</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" type="password"
                                        class="form-control" value="">
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="company_name" class="col-md-3 text-md-right col-form-label">
                                    Company Name
                                </label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="company_name" id="company_name"
                                        placeholder="Company Name" type="text" class="form-control"
                                        value="{{ $user->company_name }}">
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="country"
                                    class="col-md-3 text-md-right col-form-label">Country</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="country" id="country" placeholder="Country"
                                        type="text" class="form-control" value="{{ $user->country }}">
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="street_address" class="col-md-3 text-md-right col-form-label">
                                    Street Address
                                </label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="street_address" id="street_address"
                                        placeholder="Street Address" type="text" class="form-control"
                                        value="{{ $user->street_address }}">
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="postcode_zip" class="col-md-3 text-md-right col-form-label">
                                    Postcode Zip
                                </label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="postcode_zip" id="postcode_zip"
                                        placeholder="Postcode Zip" type="text" class="form-control"
                                        value="{{ $user->postcode_zip }}">
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="town_city" class="col-md-3 text-md-right col-form-label">
                                    Town City
                                </label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="town_city" id="town_city"
                                        placeholder="Town City" type="text" class="form-control"
                                        value="{{ $user->town_city }}">
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="phone" class="col-md-3 text-md-right col-form-label">Phone</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="phone" id="phone" placeholder="Phone"
                                        type="text" class="form-control" value="{{ $user->phone }}">
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="level" class="col-md-3 text-md-right col-form-label">Level</label>
                                <div class="col-md-9 col-xl-8">
                                    <select name="level" id="level" class="form-control">
                                        @foreach(\App\Utilities\Constant::$user_level as $key => $value)
                                            <option value="{{ $key }}" @if($user->level == $key) selected @endif>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="description"
                                    class="col-md-3 text-md-right col-form-label">Description</label>
                                <div class="col-md-9 col-xl-8">
                                    <textarea name="description" id="description" class="form-control">{{ $user->description }}</textarea>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <div class="col-md-9 col-xl-8 offset-md-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="/admin/user" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeImg(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.querySelector('.thumbnail').setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
