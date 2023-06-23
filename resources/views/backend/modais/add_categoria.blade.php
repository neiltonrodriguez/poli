<div class="modal" tabindex="0" id="addCategoria">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" id="closedCategorias" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="cadastrarcategoria" action="{{ route('add.categoria') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" class="form-control" id="id">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" name="titulo" class="form-control" id="titulo">

                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Escolha a imagen</label>
                        <input type="file" class="form-control-file" id="imagen" name="imagen">
                    </div>
                    <div class="mb-3">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" name="descricao" placeholder="descricao" id="descricao"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>

        </div>
    </div>
</div>