<div class="modal" tabindex="0" id="upCategoriaModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" id="closedCategoriasUp" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('add.categoria') }}">
                    @csrf
                    <input type="hidden" name="id" class="form-control" id="id">
                    <div class="mb-3">
                        <label for="tituloUp" class="form-label">Título</label>
                        <input type="text" name="tituloUp" class="form-control" id="tituloUp">

                    </div>
                    <div class="mb-3">
                        <label for="imagenUp" class="form-label">Imagen</label>
                        <input type="text" class="form-control" id="imagenUp" name="imagenUp">
                    </div>
                    <div class="mb-3">
                        <label for="descricaoUp">Descrição</label>
                        <textarea class="form-control" name="descricaoUp" placeholder="descricao" id="descricaoUp"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" name="active" id="active" value="1"> Ativo       
                    </div>
                    <button type="submit" id="upCategoria" class="btn btn-primary">Atualizar</button>
                </form>
            </div>

        </div>
    </div>
</div>