@extends('backend.layout')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        carregarUsuarios();
              

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
                        html += '<td> ' + data.usuarios[i].ativo + '</td>';
                        html += '<td><button type="button" id="delUsuario" data-id="' + data.usuarios[i].id + '" class="btn btn-white"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
                        html += '</tr>';

                    }

                    $('#body-usuarios').html(html);


                }

            });

        }
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
@endsection