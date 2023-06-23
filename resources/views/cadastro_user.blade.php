<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Cadastro de usuário</title>
</head>

<body>
    <div class="container-fluid bg-primary">
        <div class="container p-5">
            <h2 class="text-center">Cadastro de usuário</h2>
            <div class="card">
                <div class="card-body py-5 px-md-5">
                    <form method="post" action="{{route('cadastrar')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="form-outline">
                                    <input type="text" id="nome" name="nome" class="form-control" />
                                    <label class="form-label" for="nome">Nome</label>
                                </div>
                            </div>
                        
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="email" name="email" class="form-control" />
                            <label class="form-label" for="email">E-mail</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" id="password" name="password" class="form-control" />
                            <label class="form-label" for="password">Senha</label>
                        </div>



                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block mb-4">
                                Cadastrar
                            </button>
                        </div>

                        <!-- Register buttons -->

                    </form>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>