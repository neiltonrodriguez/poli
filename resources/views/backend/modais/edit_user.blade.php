<div id="modalEditUsuarios" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="mb-3">
                        <label for="editNome" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" id="editNome">
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">E-mail</label>
                        <input type="text" name="email" class="form-control" id="editEmail">
                    </div>
                    <div class="mb-3">
                        <label for="editPerfil" class="form-label">Perfil</label>
                        <select class="form-select" name="perfil" id="editPerfil">
                            @foreach($perfis as $p)
                            <option value="{{$p->id}}">{{$p->perfil}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white editUsuario" data-id="{{ $id ?? '' }}">Editar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
