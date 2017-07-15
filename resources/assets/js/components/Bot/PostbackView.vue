<template>
    <div>
        <h3><small>Postback:</small> {{ postback.value }}</h3>

        <form @submit.prevent="save" id="form-new-postback" v-if="showEditForm">
            <div class="input-field">
                <input type="text" id="value_to_postback" v-model="postback.value" required>
                <label for="value_to_postback" class="active">Identificação do postback</label>
            </div>
            <input type="submit" value="Atualizar" class="btn">
        </form>

        <p>
            <router-link :to="{path: '/'}" class="btn waves-effect waves-light">Voltar</router-link>
            <a @click.prevent="showEditForm = !showEditForm" class="btn blue">Editar</a>
            <a @click.prevent="remove()" class="btn red">Remover</a>
        </p>
    </div>
</template>

<script>
    import swal from 'sweetalert';

    export default{
        data: function () {
            return {
                showEditForm: false
            }
        },
        methods: {
            save() {
                let data = {
                    id: this.$route.params.id,
                    data: {
                        value: this.postback.value
                    }
                };
                this.$store.dispatch('updatePostback', data).then(() => {
                    swal('Salvo com sucesso!', 'OK', 'success');
                    this.showEditForm = false;
                })
            },
            remove() {
                swal({
                    title: "Removendo!!!",
                    text: "Você está removendo este postback e não podera desfazer esta ação",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Remover",
                    cancelButtonText: "Cancelar"
                }, () => {
                    this.$store.dispatch('removePostback', this.$route.params.id).then(() => {
                       swal("Removido!", "Removido com sucesso", "success");
                        this.$router.push("/");
                    });
                })
            }
        },
        computed: {
            postback () {
                return this.$store.state.postback.postback
            }
        },
        mounted () {
            this.$store.dispatch('getPostback', this.$route.params.id);
        }
    }
</script>