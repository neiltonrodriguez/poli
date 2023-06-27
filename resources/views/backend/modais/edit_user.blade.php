<div id="modalEditUsuario" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuário</h5>
                <button type="button" id="closedEditUsuario" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <input type="hidden" name="idUserEdit" id="idUserEdit">
                    <div class="mb-3">
                        <label for="editNome" class="form-label">Nome</label>
                        <input type="text" name="editNome" class="form-control" id="editNome">
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">E-mail</label>
                        <input type="text" name="editEmail" class="form-control" id="editEmail">
                    </div>
                    <div class="mb-3">
                        <label for="passwordNew" class="form-label">Senha nova</label>
                        <input type="password" name="passwordNew" class="form-control" id="passwordNew">
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" id="editActive" name="editActive" type="checkbox">
                    </div>
                    <div class="mb-3">
                        <label for="editPerfil" class="form-label">Perfil</label>
                        <select class="form-select" name="editPerfil" id="editPerfil">
                            @foreach($perfis as $p)
                            <option value="{{$p->id}}">{{$p->perfil}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="updateUsuario" class="btn btn-white">Editar</button>
            </div>
        </div>
    </div>
</div>