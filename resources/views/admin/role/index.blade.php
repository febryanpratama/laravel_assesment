@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- <h3 class="text-center">Manajemen Role</h3> --}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Manajemen Role</h5>
                    <div class="card-body">
                      <table class="table table-bordered">
                          <thead class="text-center">
                              <tr>
                                  <th class="p-2">Nama</th>
                                  <th class="p-2">Role</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($user as $item=>$key)
                              <tr>
                                  <td class="text-center p-2">{{ $key->name }} </td>
                                  <td>
                                      <div class="d-flex justify-content-center">
                                          <div class="p-2">
                                              <input type="radio" name="r{{ $item+1 }}" onClick="updateRole({{ $key->id }}, 'admin')" @if ($key->roles == 'admin')
                                                  checked
                                              @endif
                                              @if ($key->id == Auth::user()->id)
                                                  disabled
                                              @endif
                                              
                                              >
                                              <span>Admin</span>
                                          </div>
                                          <div class="p-2">
                                              <input type="radio" name="r{{ $item+1 }}" onClick="updateRole({{ $key->id }}, 'user')" @if ($key->roles == 'user')
                                                  checked 
                                              @endif
                                              @if ($key->id == Auth::user()->id)
                                                    disabled
                                            @endif
                                              >
                                              <span>User</span>
                                          </div>
                                      </div>
                                    {{-- <button type="button" class="btn btn-danger" onClick="updateRole({{ $key->id }})">click</button> --}}
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        updateRole = function(id,roles) {
            // console.log(id+role)
            
            $.ajax({
                url: '{{ url("api/role/update") }}',
                type: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                   id,
                   roles
                },
                success: (data)=>{
                    console.log(data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Well Done',
                        text: 'testt',
                    })
                }
            })
        };
    
        $('#btn').on('click', function(){
            console.log('ok');
        })
    </script>
@endsection
