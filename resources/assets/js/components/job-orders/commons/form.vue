<template>
    <div class="modal fade" id="createClient" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Client Form</h4>
                </div>
                <div class="modal-body">
                    <form id="clientForm">
                        <div class="row">
                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Company Name</label>
                                <input type="text" name="company"
                                       @input="inputChange" v-bind:value="company" id="company"
                                       placeholder="Enter company name" class="form-control" />
                            </div>
                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Contact Person</label>
                                <input type="text" name="contact_person"
                                       @input="inputChange" v-bind:value="contact_person" id="contact_person"
                                       placeholder="Enter contact person" class="form-control" />
                            </div>
                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Contact Number</label>
                                <input type="text" name="contact_number"
                                       @input="inputChange" v-bind:value="contact_number" id="contact_number"
                                       placeholder="Enter contact number" class="form-control" />
                            </div>
                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Email Address</label>
                                <input type="email" name="email"
                                       @input="inputChange" v-bind:value="email" id="email"
                                       placeholder="Enter email address" class="form-control" />
                            </div>

                            <div class="col-md-12 col-xs-12">
                                <legend>Brands</legend>
                            </div>

                            <div v-for="(brand, key) in brands" class="col-md-12">
                                <div class="form-group text-input-container col-md-11">
                                    <input type="text" name="brands" @input="getBrand(key, $event)"
                                           v-bind:value="brand.name"
                                           placeholder="Enter brand name" class="form-control" />
                                </div>

                                <button type="button"
                                        v-if="isLastInput(key)"
                                        @click="addBrandInput(key, $event)"
                                        class="btn btn-primary col-md-1">
                                    <i class="fa fa-plus btn-icon"></i></button>

                                <button type="button"
                                        v-if="! isLastInput(key)"
                                        @click="removeBrandInput(key, $event)"
                                        class="btn btn-danger col-md-1">
                                    <i class="fa fa-trash btn-icon"></i></button>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="saveClient">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                company: '',
                contact_person: '',
                contact_number: '',
                email: '',
                brands: [{name: ''}]
            }
        },
        methods: {
            resetForm() {
                this.company = ''
                this.contact_person = ''
                this.contact_number = ''
                this.email = ''
                this.brands = [{name: ''}]
            },
            getBrand(key, e) {
                this.brands[key].name = e.target.value
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            },
            isLastInput(key) {
                if (this.brands.length === 1) {
                    return true;
                }

                return (key + 1) === this.brands.length
            },
            addBrandInput(key, e) {
                this.brands.push({name: ''})
            },
            removeBrandInput(key, e) {
                if (this.brands.length === 1) {
                    return;
                }

                this.brands.splice(key, 1)
            },
            saveClient(e) {

                let data = {
                    company: this.company,
                    contact_person: this.contact_person,
                    contact_number: this.contact_number,
                    email: this.email,
                    brands: this.brands
                }

                let url = `/api/v1/clients`;
                this.$http.post(url, data).then(response => {
                    console.log(response)

                    this.$events.fire('reload-table')
                    this.resetForm()
                    $('#createClient').modal('hide')
                }, error => {
                    console.log(error)
                })
            }
        }
    }
</script>
