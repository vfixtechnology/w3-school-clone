@extends('adminlte::page')

@section('title', 'Trash Posts')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Deleted Topics</h1>
            <small>All deleted Topics - you can restore from delete permanently</small>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('service.create') }}">+ Add New</a> |</li>
                <li class=""> &nbsp; <a href="{{ route('service.index') }}">View All</a></li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="">
        @if (session('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="card py-2 px-2">

                            <div class="card-body p-0">
                                <table id="table-1" class="table table-striped projects">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">
                                                #
                                            </th>
                                            <th style="width: 35%">
                                                Title
                                            </th>
                                            <th style="width: 10%">
                                                Image
                                            </th>
                                            {{-- <th style="width: 10%">
                                                Category
                                            </th> --}}
                                            <th>
                                                Featured
                                            </th>
                                            {{-- <th>
                                                Comments
                                            </th> --}}
                                            <th style="width: 30%" class="text-center">
                                                Status
                                            </th>
                                            <th style="width: 20%">Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($services as $service)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    <a>
                                                        {{ $service->title }}
                                                    </a>
                                                    <br>
                                                    <small>
                                                        {{ $service->created_at->diffForHumans() }}
                                                    </small>
                                                </td>
                                                <td>
                                                    @if ($service->image)
                                                        <img style="width:75px;"
                                                            src="{{ asset('public/uploads/images/post/' . $service->image) }}"
                                                            alt="">
                                                    @else
                                                        <img style="width:75px;"
                                                            src="{{ asset('public/uploads/images/no-image.jpg') }}"
                                                            alt="">
                                                    @endif
                                                </td>
                                                {{-- <td>
                                                    @foreach ($service->scategories as $category)
                                                        {{ $category->title }}@if (!$loop->last)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                </td> --}}
                                                <td>
                                                    @if ($service->featured)
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </td>
                                                {{-- <td>
                                                    @if ($service->disable_comment)
                                                        Disabled
                                                    @else
                                                        Enabled
                                                    @endif
                                                </td> --}}
                                                <td class="project-state">
                                                    @if ($service->published)
                                                        <span class="badge badge-success">Published</span>
                                                    @else
                                                        <span class="badge badge-info">Draft</span>
                                                    @endif
                                                </td>
                                                <td class="project-actions text-right d-flex">
                                                    <div class="mr-2">
                                                        <a onclick="return confirm('Are you sure you want to Restore this item?');"
                                                            class="btn btn-primary btn-sm"
                                                            href="{{ route('service.restore', $service->id) }}"> <i
                                                                class="fas fa-folder">
                                                            </i> Restore </a>
                                                    </div>
                                                    <div>
                                                        <form action="{{ route('service.force.delete', $service->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button
                                                                onclick="return confirm('Are you sure you want to delete this item?');"
                                                                type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash">
                                                                </i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right pt-3">
                                    {{-- {{ $services->links() }} --}}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>

@stop

@section('css')

@stop

@section('js')
    {{-- hide notifcation --}}
    <script>
        $(document).ready(function() {
            $(".alert").delay(6000).slideUp(300);
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#table-1').DataTable();
        });
    </script>


    {{-- Sucess and error notification alert --}}
    <script>
        $(document).ready(function() {
            // show error message
            @if ($errors->any())
                //var errorMessage = @json($errors->any()); // Get the first validation error message
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5500
                });

                Toast.fire({
                    icon: 'error',
                    title: 'There are form validation errors. Please fix them.'
                });
            @endif

            // success message
            @if (session('success'))
                var successMessage = @json(session('success')); // Get the first sucess message
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5500
                });

                Toast.fire({
                    icon: 'success',
                    title: successMessage
                });
            @endif

        });
    </script>
@stop
