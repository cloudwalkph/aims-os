<template>
    <div class="row">
        <div class="col-md-12">
            <v-select :on-change="userSelected" :options="userOptions"></v-select>
        </div>
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" @onclick="saveProject" >
                <i class="fa fa-plus"></i> Add AE
            </button>
        </div>
    </div>
</template>

<script>
    import vSelect from 'vue-select'

    Vue.component('v-select', vSelect)
    export default {
        data() {
            return {
                user_id: "",
                users: [],
                userOptions: []
            }
        },
        mounted() {
            this.getUsers()
        },
        methods: {
            resetForm() {
                this.user_id = ''
            },
            userSelected(val) {
                this.user_id = val.value
            },
            getUsers() {
                // the department id of ae == 7
                this.$http.get('/api/v1/users/7').then(response => {
                    this.users = response.data;
                for (let user of this.users) {
                    this.userOptions.push({label: `${user.profile.first_name} ${user.profile.last_name}`, value: user.id});
                }
            }, error => {
                    console.log(error)
                });
            },
            saveProject(e) {

                let data = {
                    user_id: this.user_id
                }

                let url = `/api/v1/`;
                this.$http.post(url, data).then(response => {
                    console.log(response)

                    this.resetForm()
                }, error => {
                    console.log(error)
                })
            }
        }
    }
</script>
