<template>
    <div class="row">
        <div class="col-md-12">
            <v-select :on-change="userSelected" :options="userOptions"></v-select>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary" @click="saveProject">Add AE</button>
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
                console.log(val)
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
                let jobOrderId = $('#jobOrderId').val();
                let data = {
                    job_order_id: jobOrderId,
                    user_id: this.user_id
                }
                console.log(data)

                let url = `/api/v1/job-orders/add-ae`;
                this.$http.post(url, data).then(response => {
                    console.log(response)

                    toastr.success('Successfully added AE', 'Success')
                    this.resetForm()
                }, error => {
                    toastr.error('Failed in adding AE', 'Error')
                    console.log(error)
                })
            }
        }
    }
</script>
