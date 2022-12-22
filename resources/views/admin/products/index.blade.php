@extends('admin.master')
@section('title', 'index page')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex justify-content-between mb-4 align-items-center">
            <h1 class="h3 text-gray-800">{{ __('site.All Products') }}</h1>
            <a href="{{ route('admin.products.create') }}"
                class="btn btn-outline-primary px-5">{{ __('site.Add New') }}</a>
        </div>
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr class="bg-dark text-white">
                    <th>ID</th>
                    <th>{{ __('site.Name') }}</th>
                    <th>{{ __('site.Image') }}</th>
                    <th>{{ __('site.Parent') }}</th>
                    <th>Price</th>
                    <th>{{ __('site.Created At') }}</th>

                    <th>{{ __('site.Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $item)
                    @php
                        $src = 'https://via.placeholder.com/80';
                        if (file_exists(public_path('uploads/images/products/' . $item->image))) {
                            $src = asset('uploads/images/products/' . $item->image);
                        }
                    @endphp
                    <tr class="table-row" data-name="{{ $item->name }}" data-id="{{ $item->id }}">
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->trans_name }}</td>
                        <td class="text-center"><img width="80" src="{{ $src }}" alt=""></td>
                        <td>{{ $item->category->trans_name ?? '' }}</td>
                        <td>{{ $item->final_price }}</td>
                        <td>{{ $item->created_at->diffForHumans() }}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <a class="btn btn-primary mx-3 " href="{{ route('admin.products.edit', $item->id) }}"><i
                                        class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $item->id) }}"
                                    class="submit_delete_form" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <td colspan="6" class="text-center">{{ __('site.No Data Found') }}</td>
                @endforelse
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@stop
@section('scripts')
    {{-- <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        $('.submit_delete_form').submit(function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var tr = $(this).parents('tr');
            var table_body = $(this).parents('tbody');
            var tr_name = $(this).parents('tr').data('name');
            var tr_id = $(this).parents('tr').data('id');
            var parent_name = $(this).parents('tr').find('.parent_td').text();
            var empty_tr = `<td colspan="6" class="text-center">{{ __('site.No Data Found') }}</td>`
            $.ajax({
                type: "post",
                url: url,
                data: {
                    _method: 'delete',
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    //when delete a prime product change the parent id to its children to prime
                    // document.querySelectorAll('.table-row').forEach(element => {
                    //     let td_text=$(element).find('.parent_td').text();
                    //     if(td_text===tr_name){
                    //         $(element).find('.parent_td').text('{{ __('site.Prime Product') }}');
                    //     }
                    // });

                    tr.remove();
                    var tr_count = document.querySelectorAll('.table-row').length;
                    Toast.fire({
                        icon: 'success',
                        title: response
                    });
                    //if the deleted tr is prime tr then reload the page
                    if (parent_name === 'Prime Product') {
                        location.reload();
                    }
                    if (tr_count == 0) {
                        table_body.append(empty_tr);
                    }


                }
            });
        });
    </script> --}}
@endsection
