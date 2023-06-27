<div class="modal" tabindex="0" id="modalUsuarios">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Usuário</h5>
                <button type="button" id="closedUsuarios" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('usuarios.add') }}">
                    @csrf
                    <input type="hidden" name="id" class="form-control" id="id">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" id="nome">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" name="email" class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="alt" class="form-label">Selecione o perfil</label>
                        <select class="form-select" id="perfil" name="perfil" aria-label="Default select example">
                            @foreach($perfis as $p)
                            <option value="{{$p->id }}">{{$p->perfil }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" id="active" name="active" type="checkbox">
                        <label class="form-check-label" for="active">ativo</label>
                    </div>


                    <button type="submit" id="btnCadUsuario" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>

        </div>
    </div>
</div>