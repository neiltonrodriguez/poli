@extends('backend.layout')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script type=”text/javascript” src=”https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js”> </script>
<script>
    $(document).ready(function() {
        carregarFotos();
        

        $('#abrirModalFotos').click(function() {
            $('#modalFotos').show();
        });

        $('#closedFotos').click(function() {
            $('#modalFotos').hide();
        });

        $('#formAddFoto').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '/backend/fotos/add',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    carregarFotos()
                }

            });

        });

        $(document).on('click', '#delFoto', function() {
            Swal.fire({
                icon: 'warning',
                title: 'atenção',
                text: 'Deseja deletar essa foto',
                showCancelButton: true,
                confirmButtonText: `Sim`,
                cancelButtonText: `Cancelar`
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).attr('data-id');
                    $.ajax({
                        url: '/backend/fotos/trash',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            carregarFotos()

                        }

                    });
                }
            })



        });

        $("#body-fotos").on("click", ".checkActive", function() {
            let id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url: '/backend/fotos/active/',
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

        function carregarFotos() {
            $.ajax({
                url: '/backend/fotos/get-all',
                type: 'GET',
                success: function(data) {
                    let html = '';
                    for (let i = 0; i < data.fotos.length; i++) {
                        html += '<tr>';
                        html += '<td> ' + data.fotos[i].id + '</td>';
                        html += '<td> <img src="../img/fotos/' + data.fotos[i].img + '" width="100"></td>';
                        html += '<td> ' + data.fotos[i].alt + '</td>';
                        html += data.fotos[i].active == 1 ? '<td><div class="form-check form-switch"><input data-id="' + data.fotos[i].id + '" class="form-check-input checkActive" type="checkbox" checked></div></td>' : '<td><div class="form-check form-switch"><input data-id="' + data.fotos[i].id + '"  class="form-check-input checkActive" type="checkbox"></div></td>';
                        html += '<td> ' + data.fotos[i].id_categoria + '</td>';
                        html += '<td><button type="button" id="delFoto" data-id="' + data.fotos[i].id + '" class="btn btn-white"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
                        html += '</tr>';

                    }

                    $('#body-fotos').html(html);


                }

            });

        }

    });
</script>
<button id="abrirModalFotos" type="button" class="btn btn-primary">
    Enviar fotos
</button>
<table class="table table-striped" id="tableID">
    <thead>
        <tr>
            <td>ID</td>
            <td>IMAGEM</td>
            <td>ALT</td>
            <td>ATIVO</td>
            <td>ID_CATEGORIA</td>
            <td>AÇÃO</td>
        </tr>
    </thead>
    
    <tbody id="body-fotos">
        
    </tbody>

</table>


@include('backend.modais.add_fotos')
@endsection