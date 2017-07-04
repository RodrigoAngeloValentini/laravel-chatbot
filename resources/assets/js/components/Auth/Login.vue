<template>
    <div class="row">
        <div class="col s8 push-s2">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Acessar</span>
                    <form @submit.prevent="login()">
                        <div class="input-field">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" required autofocus v-model="credentials.email">
                        </div>

                        <div class="input-field">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required v-model="credentials.password">
                        </div>

                        <div>
                            <input id="remenber" type="checkbox" name="remenber" v-model="credentials.remenber">
                            <label for="remenber">Lembrar de min</label>
                        </div>

                        <hr>

                        <button type="submit" class="btn">
                            Login
                        </button>

                        <a href="#/register" class="btn green">Cadastre-se</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert';

    export default{
        data: function(){
            return {
                credentials: {
                    email: 'schaefer.reed@example.net'
                }
            }
        },
        methods: {
            login(){
                window.axios.post('/login', this.credentials).then((res) => {
                    if (res.data.status == 'success') {
                        swal('Autenticado com sucesso', 'Redirecionando para o painel', 'success');
                        this.$router.push({path: '/'});
                    } else {
                        swal('Falha ao autenticar', 'Usuário ou senha inválidos', 'error');
                    }
                }).catch(() => {
                    swal('Falha ao autenticar', 'Usuário ou senha inválidos', 'error');
                });
            }
        }
    }
</script>