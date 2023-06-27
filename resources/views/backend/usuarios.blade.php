@extends('backend.layout')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        carregarUsuarios();
        $('#abrirModalUsuarios').click(function() {
            $('#modalUsuarios').show();
        });

        $('#closedUsuarios').click(function() {
            $('#modalUsuarios').hide();
        });

        $(document).on('click', '#delUsuario', function() {
            Swal.fire({
                icon: 'warning',
                title: 'atenção',
                text: 'Deseja deletar essa usuário',
                showCancelButton: true,
                confirmButtonText: `Sim`,
                cancelButtonText: `Cancelar`
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).attr('data-id');
                    $.ajax({
                        url: '/backend/usuarios/trash',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            carregarUsuarios()

                        }

                    });
                }
            })



        });

        $('#btnCadUsuario').on('click', function(e) {
            e.preventDefault();
            let active = 0;
            if ($("#active").is(':checked')) {
                active = 1
            }
            nome = $('#nome').val();
            perfil = $('#perfil').val();
            email = $('#email').val();
            password = $('#password').val();
            $.ajax({
                url: '/backend/usuarios/add',
                type: 'POST',
                data: {
                    nome: nome,
                    perfil: perfil,
                    email: email,
                    active: active,
                    password: password,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                enctype: "application/json",

                success: function(data) {
                    $('#modalUsuarios').hide();
                    carregarUsuarios()
                }

            });



        });

        function carregarUsuarios() {
            $.ajax({
                url: '/backend/usuarios/get',
                type: 'GET',
                success: function(data) {
                    let html = '';
                    for (let i = 0; i < data.usuarios.length; i++) {
                        html += '<tr>';
                        html += '<td> ' + data.usuarios[i].name + '</td>';
                        html += '<td> ' + data.usuarios[i].email + '</td>';
                        html += '<td> ' + data.usuarios[i].perfil_id + '</td>';
                        html += data.usuarios[i].ativo == 1 ? '<td><div class="form-check form-switch"><input data-id="' + data.usuarios[i].id + '" class="form-check-input checkActive" type="checkbox" checked></div></td>' : '<td><div class="form-check form-switch"><input data-id="' + data.usuarios[i].id + '"  class="form-check-input checkActive" type="checkbox"></div></td>';
                        html += '<td><button type="button" class="btn btn-white editUsuario" data-id="' + data.usuarios[i].id + '"><i class="fas fa-user-edit" aria-hidden="true"></i></button></td>';
                        html += '<td><button type="button" id="delUsuario" data-id="' + data.usuarios[i].id + '" class="btn btn-white"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
                        html += '</tr>';

                    }

                    $('#body-usuarios').html(html);

                    $(document).on('click', '.editUsuario', function() {
                        // Obter o userId a partir do atributo data-id do botão clicado
                        var userId = $(this).data('id');

                        // Limpar os campos do modal
                        $('#editNome').val('');
                        $('#editEmail').val('');
                        $('#editPerfil').val('');

                        // Atualizar o atributo "action" do formulário com o valor do parâmetro "id"
                        $('#modalEditUsuarios form').attr('action', '/backend/usuarios/' + userId + '/editar');

                        // Fazer uma requisição AJAX para obter os detalhes do usuário
                        $.ajax({
                            url: '/backend/usuarios/' + userId,
                            type: 'GET',
                            success: function(data) {
                                // Preencher os campos do formulário com os dados do usuário
                                $('#editNome').val(data.name);
                                $('#editEmail').val(data.email);
                                $('#editPerfil').val(data.perfil_id);
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText); // Exibe a resposta de erro no console
                            }
                        });

                        // Abrir o modal de edição
                        $('#modalEditUsuarios').modal('show');
                    });








                }

            });

        }

        $("#body-usuarios").on("click", ".checkActive", function() {
            let id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url: '/backend/usuarios/active/',
                type: 'POST',
                data: {
                    id: id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                enctype: "application/json",

                success: function(data) {
                    carregarFotos()
                }

            });
        });
    });
</script>
<button id="abrirModalUsuarios" type="button" class="btn btn-primary">
    Novo Usuário
</button>
<table class="table table-striped">
    <thead>
        <tr>
            <td>NOME</td>
            <td>EMAIL</td>
            <td>PERFIL</td>
            <td>ATIVO</td>
            <td>AÇÃO</td>
        </tr>
    </thead>
    <tbody id="body-usuarios">

    </tbody>

</table>
@include('backend.modais.add_user')
@include('backend.modais.edit_user')
@endsection
