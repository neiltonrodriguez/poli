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

        $('#cadastrarCategoria').submit(function(e) {
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
        $('#cadCategoria').on('click', function(e) {
            e.preventDefault();
            titulo = $('#titulo').val();
            imagen = $('#imagen').val();
            descricao = $('#descricao').val();
            $.ajax({
                url: '/backend/categorias/add',
                type: 'POST',
                data: {
                    titulo: titulo,
                    imagen: imagen,
                    descricao: descricao
                },
                enctype: "application/json",
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


        function carregarCategorias() {
            $.ajax({
                url: '/backend/categorias/get',
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    let html = '';
                    for (let i = 0; i < data.categorias.length; i++) {
                        html += '<tr>';
                        html += '<td> ' + data.categorias[i].id + '</td>';
                        html += '<td> <img src="../img/categorias/' + data.categorias[i].img + '" width="100"></td>';
                        html += '<td> ' + data.categorias[i].title + '</td>';
                        html += '<td> ' + data.categorias[i].active + '</td>';
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

        carregarFotos()

        function carregarFotos() {
            $.ajax({
                url: '/backend/fotos/get-all',
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    let html = '';
                    for (let i = 0; i < data.fotos.length; i++) {
                        html += '<tr>';
                        html += '<td> ' + data.fotos[i].id + '</td>';
                        html += '<td> <img src="../img/servicos/' + data.fotos[i].img + '" width="100"></td>';
                        html += '<td> ' + data.fotos[i].alt + '</td>';
                        html += '<td> ' + data.fotos[i].ativo + '</td>';
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