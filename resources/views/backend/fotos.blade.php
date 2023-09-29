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
                success: function(result) {
                    let html = '';
                    for (let i = 0; i < result.data.length; i++) {
                        html += '<tr>';
                        html += '<td> ' + result.data[i].id + '</td>';
                        html += '<td> <img src="../img/fotos/' + result.data[i].img + '" width="100"></td>';
                        html += '<td> ' + result.data[i].alt + '</td>';
                        html += result.data[i].active == 1 ? '<td><div class="form-check form-switch"><input data-id="' + result.data[i].id + '" class="form-check-input checkActive" type="checkbox" checked></div></td>' : '<td><div class="form-check form-switch"><input data-id="' + result.data[i].id + '"  class="form-check-input checkActive" type="checkbox"></div></td>';
                        html += '<td> ' + result.data[i].id_categoria + '</td>';
                        html += '<td><button type="button" id="delFoto" data-id="' + result.data[i].id + '" class="btn btn-white"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
                        html += '</tr>';

                    }

                    $('#body-fotos').html(html);
                    // let pag = '';
                    // for (let i = 0; i < result.links.length; i++) {
                    //     pag += '<li><a href="' + result.links[i].url + '">' + result.links[i].label + '</a> </li>';
                    // }
                    // $('#linksPag').html(pag);


                }

            });

        }
        $(document).on('click', '#btnFiltrar', function(e) {
            e.preventDefault();
            let id_categoria = $('#catFiltro').val();
            let search = $('#searchFiltro').val();
            let active = 0;
            if ($("#activeFiltro").is(':checked')) {
                active = 1
            }
            let activeQuery = '?active=' + active;
            let searchQuery = '';
            if (search != "") {
                searchQuery = '&search=' + search;
            }
            let categoriaQuery = '';
            if (id_categoria != 0) {
                categoriaQuery = '&categoria=' + id_categoria;
            }


            $.ajax({
                url: '/backend/fotos/get-by-filter' + activeQuery + searchQuery + categoriaQuery,
                type: 'GET',
                success: function(result) {
                    let html = '';
                    for (let i = 0; i < result.data.length; i++) {
                        html += '<tr>';
                        html += '<td> ' + result.data[i].id + '</td>';
                        html += '<td> <img src="../img/fotos/' + result.data[i].img + '" width="100"></td>';
                        html += '<td> ' + result.data[i].alt + '</td>';
                        html += result.data[i].active == 1 ? '<td><div class="form-check form-switch"><input data-id="' + result.data[i].id + '" class="form-check-input checkActive" type="checkbox" checked></div></td>' : '<td><div class="form-check form-switch"><input data-id="' + result.data[i].id + '"  class="form-check-input checkActive" type="checkbox"></div></td>';
                        html += '<td> ' + result.data[i].id_categoria + '</td>';
                        html += '<td><button type="button" id="delFoto" data-id="' + result.data[i].id + '" class="btn btn-white"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
                        html += '</tr>';

                    }

                    $('#body-fotos').html(html);
                    // let pag = '';
                    // for (let i = 0; i < result.links.length; i++) {
                    //     pag += '<li class="page-item"><a href="' + result.links[i].url + '" class="page-link">' + result.links[i].label + '</a> </li>';
                    // }
                    // $('#linksPag').html(pag);


                }

            });
        });


    });
</script>
<div id="filtro" class="container-fluid border">
    <h2>Filtro de fotos</h2>
    <form>
        @csrf
        <div class="row mb-5 mt-5">
            <div class="col-md-2">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" id="btnFiltrar" type="button">Filtrar</button>

                </div>
            </div>
            <div class="col-md-4">
                <input type="text" name="searchFiltro" class="form-control" id="searchFiltro" placeholder="Pesquisa">
            </div>
            <div class="col-md-4">
                <select class="form-select" id="catFiltro" name="catFiltro">
                    <option value="0">Todas as fotos</option>
                    @foreach($data['categorias'] as $c)
                    <option value="{{$c->id }}">{{$c->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">

                <div class="form-check form-switch">
                    <input class="form-check-input" id="activeFiltro" name="activeFiltro" type="checkbox">
                    <label class="form-check-label" for="active">ativo</label>

                </div>

            </div>



        </div>
    </form>
</div>
<div class="mt-5 mb-5">
    <button id="abrirModalFotos" type="button" class="btn btn-primary">
        Enviar fotos
    </button>
</div>
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

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end" id="linksPag">

    </ul>
</nav>


@include('backend.modais.add_fotos')
@endsection