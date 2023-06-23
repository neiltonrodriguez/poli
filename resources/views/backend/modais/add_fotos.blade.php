<div class="modal" tabindex="0" id="modalFotos">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Envio de fotos</h5>
                <button type="button" id="closedFotos" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="formAddFoto" action="{{ route('fotos.add') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" class="form-control" id="id">
                    <div class="mb-3">
                        <label for="alt" class="form-label">Texto alternativo</label>
                        <input type="text" name="alt" class="form-control" id="alt">

                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Escolha a imagen</label>
                        <input type="file" class="form-control-file" id="imagen[]" name="imagen[]" multiple>
                    </div>
                    <div class="mb-3">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" name="descricao" placeholder="descricao" id="descricao"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="alt" class="form-label">Selecione a categoria</label>
                        <select class="form-select" id="id_categoria" name="id_categoria" aria-label="Default select example">
                            @foreach($categorias as $c)
                            <option value="{{$c->id }}">{{$c->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" name="active" id="active" value="1"> Ativo
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>

        </div>
    </div>
</div>