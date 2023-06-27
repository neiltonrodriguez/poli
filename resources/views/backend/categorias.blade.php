@extends('backend.layout')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        carregarCategorias()
        $('#abrirModalCategoria').click(function() {
            $('#addCategoria').show();
        });

        $('#closedCategorias').click(function() {
            $('#addCategoria').hide();
        });

        $('#closedCategoriasUp').click(function() {
            $('#upCategoriaModal').hide();
        });

        $('#cadastrarcategoria').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '/backend/categorias/add',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    carregarCategorias()
                }

            });

        });

        $(document).on('click', '#editCategoria', function() {
            let id = $(this).attr('data-id');
            carregarCategoria(id)
        });

        $(document).on('click', '#delCategoria', function() {
            Swal.fire({
                icon: 'warning',
                title: 'atenção',
                text: 'Deseja deletar essa categoria',
                showCancelButton: true,
                confirmButtonText: `Sim`,
                cancelButtonText: `Cancelar`
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).attr('data-id');
                    $.ajax({
                        url: '/backend/categorias/trash',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            carregarCategorias()

                        }

                    });
                }
            })



        });

        $('#upCategoria').on('click', function(e) {
            e.preventDefault();
            let active = 0;
            if ($("#active").is(':checked')) {
                active = 1
            }

            id = $('#id').val();
            title = $('#tituloUp').val();
            img = $('#imagenUp').val();
            description = $('#descricaoUp').val();
            $.ajax({
                url: '/backend/categorias/update/',
                type: 'POST',
                data: {
                    id: id,
                    title: title,
                    img: img,
                    active: active,
                    description: description,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                enctype: "application/json",

                success: function(data) {
                    $('#upCategoriaModal').hide();
                    carregarCategorias()
                }

            });

        });


        $("#body-categorias").on("click", ".checkActive", function() {
            let id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url: '/backend/categorias/active/',
                type: 'POST',
                data: {
                    id: id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                enctype: "application/json",

                success: function(data) {
                    carregarCategorias()
                }

            });
        });


        function carregarCategorias() {
            $.ajax({
                url: '/backend/categorias/get',
                type: 'GET',
                success: function(data) {
                    let html = '';
                    for (let i = 0; i < data.categorias.length; i++) {
                        html += '<tr>';
                        html += '<td> ' + data.categorias[i].id + '</td>';
                        html += '<td> <img src="../img/categorias/' + data.categorias[i].img + '" width="100"></td>';
                        html += '<td> ' + data.categorias[i].title + '</td>';
                        html += data.categorias[i].active == 1 ? '<td><div class="form-check form-switch"><input data-id="' + data.categorias[i].id + '" class="form-check-input checkActive" type="checkbox" checked></div></td>' : '<td><div class="form-check form-switch"><input data-id="' + data.categorias[i].id + '"  class="form-check-input checkActive" type="checkbox"></div></td>';
                        html += '<td><button type="button" id="delCategoria" data-id="' + data.categorias[i].id + '" class="btn btn-white"><i class="fa fa-trash" aria-hidden="true"></i></button> <button type="button" id="editCategoria" data-id="' + data.categorias[i].id + '" class="btn btn-white"><i class="fa fa-edit" aria-hidden="true"></i></button></td>';
                        html += '</tr>';

                    }

                    $('#body-categorias').html(html);


                }

            });

        }

        function carregarCategoria(id) {
            $.ajax({
                url: '/backend/categorias/get-by-id/' + id,
                type: 'GET',
                success: function(data) {
                    $('#upCategoriaModal').show();
                    $('#id').val(data.categoria.id);
                    if (data.categoria.active == 1) {
                        $("#active").prop("checked", true);
                    } else {
                        $("#active").prop("checked", false);
                    }
                    $('#tituloUp').val(data.categoria.title);
                    $('#imagenUp').val(data.categoria.img);
                    $('#descricaoUp').val(data.categoria.description);
                }

            });

        }

    });
</script>
<button id="abrirModalCategoria" type="button" class="btn btn-primary">
    Nova Categoria
</button>
<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>IMAGEM</td>
            <td>TITLE</td>
            <td>ATIVO</td>
            <td>AÇÃO</td>
        </tr>
    </thead>
    <tbody id="body-categorias">

    </tbody>

</table>

@include('backend.modais.add_categoria')
@include('backend.modais.up_categoria')
@endsection