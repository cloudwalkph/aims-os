<template>
    <div class="modal fade" id="editTypeModal" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update User</h4>
                </div>
                <div class="modal-body">
                    <form id="clientForm">

                        <div class="row">
                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">User Roles</label>
                                <v-select :on-change="roleSelected" :options="roleOptions"></v-select>
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Department</label>
                                <v-select :on-change="departmentSelected" :options="departmentOptions"></v-select>
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">E-Mail Address</label>
                                <input type="email" name="email"
                                       @input="inputChange" v-bind:value="email" id="email"
                                       placeholder="E-Mail Address" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Gender</label>
                                <v-select :on-change="genderSelected" :options="genderOptions"></v-select>
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">First Name</label>
                                <input type="text" name="first_name"
                                       @input="inputChange" v-bind:value="first_name" id="first_name"
                                       placeholder="First Name" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Middle Name</label>
                                <input type="text" name="middle_name"
                                       @input="inputChange" v-bind:value="middle_name" id="middle_name"
                                       placeholder="Middle Name" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Last Name</label>
                                <input type="text" name="last_name"
                                       @input="inputChange" v-bind:value="last_name" id="last_name"
                                       placeholder="Last Name" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Birthdate</label>
                                <input type="date" name="birth_date"
                                       @input="inputChange" v-bind:value="birth_date" id="birth_date"
                                       placeholder="Birthdate" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Street</label>
                                <input type="text" name="street"
                                       @input="inputChange" v-bind:value="street" id="street"
                                       placeholder="Street" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Barangay</label>
                                <input type="text" name="barangay"
                                       @input="inputChange" v-bind:value="barangay" id="barangay"
                                       placeholder="Barangay" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">City</label>
                                <input type="text" name="city"
                                       @input="inputChange" v-bind:value="city" id="city"
                                       placeholder="City" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Province</label>
                                <input type="text" name="province"
                                       @input="inputChange" v-bind:value="province" id="province"
                                       placeholder="Province" class="form-control" />
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="updateUser">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getRoles()
            this.getDepartments()
            this.getGender()
        },
        data() {
            return {
                roles: [],
                departments: [],
                departmentOptions: [],
                roleOptions: [],
                genderOptions: [],
                email: '',
                first_name: '',
                last_name: '',
                middle_name: '',
                department_id: '',
                user_role_id: '',
                gender: '',
                birth_date: '',
                street: '',
                barangay: '',
                city: '',
                province: '',
                userId: ''
            }
        },
        methods: {
            populateData(data) {
                this.email = data.email
                this.first_name = data.first_name
                this.last_name = data.last_name
                this.middle_name = data.middle_name
                this.department_id = data.department_id
                this.user_role_id = data.user_role_id
                this.gender = data.gender
                this.birth_date = data.birthdate
                this.street = data.street
                this.barangay = data.barangay
                this.city = data.city
                this.province = data.province
                this.userId = data.id
            },
            resetForm() {
                this.email = ''
                this.first_name = ''
                this.last_name = ''
                this.middle_name = ''
                this.birth_date = ''
                this.street = ''
                this.barangay = ''
                this.city = ''
                this.province = ''
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            },
            roleSelected(val) {
                this.user_role_id = val.value
            },
            departmentSelected(val) {
                this.department_id = val.value
            },
            genderSelected(val) {
                this.gender = val.value
            },
            getRoles() {
                this.$http.get('/api/v1/roles').then(response => {
                    this.roles = response.data;
                for (let role of this.roles) {
                    this.roleOptions.push({label: `${role.name}`, value: role.id});
                }
            }, error => {
                    console.log(error)
                });
            },
            getGender() {
                this.genderOptions.push({label: "Male", value: "male"});
                this.genderOptions.push({label: "Female", value: "female"});
            },
            getDepartments() {
                this.$http.get('/api/v1/departments').then(response => {
                    this.departments = response.data;

                for (let department of this.departments) {
                    this.departmentOptions.push({label: `${department.name}`, value: department.id});
                }
            }, error => {
                    console.log(error)
                });
            },
            updateUser(e) {

                let data = {
                    email: this.email,
                    first_name: this.first_name,
                    last_name: this.last_name,
                    middle_name: this.middle_name,
                    department_id: this.department_id,
                    user_role_id: this.user_role_id,
                    gender: this.gender,
                    birth_date: this.birth_date,
                    street: this.street,
                    barangay: this.barangay,
                    city: this.city,
                    province: this.province
                }

                let url = `/api/v1/users/${this.userId}`;
                this.$http.put(url, data).then(response => {
                    console.log(response)

                    toastr.success('Successfully edited user', 'Success')
                    this.$events.fire('reload-table')
                    $('#editTypeModal').modal('hide')
                }, error => {
                    toastr.error('Failed in editing user', 'Error')
                    console.log(error)
                })
            }
        }
    }
</script>
