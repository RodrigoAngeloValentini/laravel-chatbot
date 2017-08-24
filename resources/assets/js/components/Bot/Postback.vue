<template>
    <div>
        <h3>Postbacks</h3>

        <div>
            <router-link v-for="postback in postbacks.data" class="waves-effect btn-large waves-light light-green btn-postback" :to="{path: '/postback/' + postback.id}" :key="postback.id">
               <i class="material-icons" v-if="postback.get_started">done_all</i> {{ postback.value }}
            </router-link>
        </div>

        <form @submit.prevent="save" id="form-new-postback">
            <legend>Novo Postback</legend>
            <div class="input-field">
                <input type="text" id="value_to_postback" v-model="title" required>
                <label for="value_to_postback">Identificação do postback</label>
            </div>
            <input type="submit" value="+" class="btn">
        </form>
    </div>
</template>

<script>

    export default {
        data: function () {
            return {
                title: ''
            }
        },
        computed: {
            postbacks(){
                return this.$store.state.postback.listPostbacks
            }
        },
        mounted() {
            this.$store.dispatch('getPostbacks');
        },
        methods:{
            save(){
                this.$store.dispatch('newPostback', {'value': this.title}).then(() => {
                    this.$store.dispatch('getPostbacks');
                    this.title = '';
                })
            }
        }
    }
</script>

<style>
    .btn-postback{
        display: block;
        text-align: left;
        margin-bottom: 10px;
    }
    #form-new-postback{
        margin-top: 30px;
    }
</style>