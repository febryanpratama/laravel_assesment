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
                    <span class="text-center mt-2"><button class="btn btn-primary" id="TambahModal">Tambah Data</button></span>
                    <div class="card-body">
                      <table class="table table-bordered">
                          <thead class="text-center">
                              <tr>
                                  <th class="p-2">Nama</th>
                                  <th class="p-2">Email</th>
                                  <th class="p-2">Roles</th>
                                  <th class="p-2">Aksi</th>
                              </tr>
                          </thead>
                          <tbody id="list_data" class="text-center">
                             
                          </tbody>
                      </table>
                    </div>
                  </div>
            </div>
        </div>
    </div>


    <div class="modal" id="tambahData" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Data User</h5>
            </div>
            <form id="form_tambah">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Nama</label>
                                <input type="text" class="form-control" name="name" placeholder="Masukkan Nama.." id="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Masukkan Email.." id="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm-password" id="confirm-password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="CloseTambah">Close</button>
                </div>
            </form>
          </div>
        </div>
    </div>

    <div class="modal" id="updateData" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Data User</h5>
            </div>
            <form id="form_edit">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Nama</label>
                                <input type="text" class="form-control" name="name" placeholder="Masukkan Nama.." id="name_edit" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Masukkan Email.." id="email_edit" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password_edit" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm-password" id="confirm-password_edit" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit_edit">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="CloseEdit">Close</button>
                </div>
            </form>
          </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        $(document).ready(function(){
            // $('#list_data').html()
            getData()
        });
        getData = ()=>{
            $('#list_data').html('')
            $.ajax({
                    'url': '{{ url("api/user") }}',
                    'type': 'get',
                    success: (data)=>{
                        let data_list = data.data
                        // console.log(data_list);
                        $.each(data_list,function(index){
                            $('#list_data').append(`
                            <tr>
                                <td>`+data_list[index].name+`</td>
                                <td>`+data_list[index].email+`</td>
                                <td>`+data_list[index].roles+`</td>
                                <td>
                                    <span class="btn btn-warning" onClick="edit(`+data_list[index].id+`)">edit</span>    
                                    <span class="btn btn-danger" onClick="hapus(`+data_list[index].id+`)">delete</span>
                                </td>
                            </tr>
                            `)
                        })
                    }
            })
        }

        $('#submit').on('click', function(){
            // let data = $('#form_tambah').serialize();
            let name = $('#name').val() 
            let email = $('#email').val() 
            let password = $('#password').val() 
            let confirm_password = $('#confirm-password').val() 

            // console.log(data);

            $.ajax({
                url: '{{ url("api/user/create") }}',
                type: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    name, email, password, confirm_password
                },
                success: (data)=>{
                    // console.log(data)
                    if (data.code == 200) {
                        Swal.fire({
                                icon: 'success',
                                title: 'Well Done',
                                text: data.data,
                            })
                            $('input[name=todo').val('')
                            $('#form_tambah')[0].reset();
                            $('#tambahData').modal('hide')
                            getData()
                        }else{

                            Swal.fire({
                                    icon: 'error',
                                    title: 'oops!!!',
                                    text: data.data,
                                })
                                getData()
                                // $('#form_tambah').trigger("reset");
                        }
                }
            })

        })
    

        $('#TambahModal').on('click', function(){
            $('#tambahData').modal('show');
        })
        $('#CloseTambah').on('click', function(){
            $('#tambahData').modal('hide');
            $('#form_tambah')[0].reset();
        })
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

        edit = (id)=>{

            $.ajax({
                
            url: '{{ url("api/user/detail") }}',
                type: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    id
                },
                success: (data)=>{
                    console.log(data)
                    if (data.code == 200) {
                        $('#updateData').modal('show')
                        $('#name_edit').val(data.data.name)
                        $('#email_edit').val(data.data.email)
                }
            }
            })

            $('#submit_edit').on('click', function(){

                let name = $('#name_edit').val() 
                let email = $('#email_edit').val() 
                let password = $('#password_edit').val() 
                let confirm_password = $('#confirm-password_edit').val() 


                $.ajax({
                url: '{{ url("api/user/update") }}',
                type: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    id, name, email, password, confirm_password
                },
                success: (data)=>{
                        if (data.code == 200) {
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Well Done',
                                    text: data.data,
                                })
                                $('input[name=todo').val('')
                                $('#form_edit')[0].reset();
                                $('#updateData').modal('hide')
                                getData()
                            }else{

                                Swal.fire({
                                        icon: 'error',
                                        title: 'oops!!!',
                                        text: data.data,
                                    })
                                    getData()
                                    // $('#form_tambah').trigger("reset");
                            }
                    }
                })
            })
        }

        $('#CloseEdit').on('click', function(){
            $('#updateData').modal('hide')
            $('#form_edit')[0].reset();
        });
    </script>
@endsection
