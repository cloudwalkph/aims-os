<template>
    <div class="col-md-12">

        <form method="POST">
            <div class="form-group">
                <label for="project_name">Project Name</label>
                <input type="text" class="form-control"
                       @input="changeProjectName"
                       v-bind:value="projectName"
                       id="project_name"
                       placeholder="Project Name"
                       required/>
            </div>

            <div class="form-group">
                    <div>
                        <label>Select Project Type</label>
                    </div>

                    <div v-for="(type, key) in projectTypes">
                        <div class="checkbox checkbox-primary col-md-2">
                            <input name="project_types" v-bind:value="type.name"
                                   @click="onChangeProjectType"
                                   class="checkbox"
                                   type="checkbox" v-bind:id="'checkbox-' + type.id" />

                            <label v-bind:for="'checkbox-' + type.id">{{ type.name }}</label>
                        </div>
                    </div>

            </div>

            <div class="clearfix"></div>

            <br>
            <hr/>


            <div class="form-group">
                <label>Select Client</label>
                <div class="input-group">
                    <!--<select name="client_id" id="client_id" class="form-control">-->
                        <!--<option v-repreat="client in clients" v-bind:value="client.id">-->
                            <!--{{ `${client.company} : ${client.contact_person}` }}</option>-->
                    <!--</select>-->

                    <v-select :on-change="clientSelected" :options="clientOptions"></v-select>

                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary btn-block col-md-2"
                                data-toggle="modal" data-target="#createClient">
                            <i class="fa fa-plus"></i> Create New Client
                        </button>
                    </span>
                </div>
            </div>

            <div class="clearfix"></div>
            <br/>

            <hr />

            <div v-if="selectedClient !== null">
                <div class="form-group">
                    <input type="email" readOnly="readOnly"
                           class="form-control" id="exampleInputEmail1"
                           placeholder="Client Name"
                           v-bind:value="selectedClient.company + ':' + selectedClient.contact_person "/>
                </div>

                <div class="clearfix"></div>

                <div class="form-group">
                    <div>
                        <label>Select Brand Name</label>
                    </div>

                    <div v-for="(brand, key) in JSON.parse(selectedClient.brands)">
                        <div class="checkbox checkbox-primary col-md-2">
                            <input type="checkbox"
                                   class="brand-checkbox"
                                   @click="onChangeBrand"
                                   v-bind:id="'brand-' + key"
                                   v-bind:value="brand.name"/>
                            <label v-bind:for="'brand-' + key">{{ brand.name }}</label>

                        </div>
                    </div>

                </div>

                <div class="clearfix"></div>

                <button type="button"
                        @click="addClientToTable"
                        class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Client
                </button>

                <hr/>

                <h3>Added Clients and Brands</h3>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Company</th>
                        <th>Contact Person</th>
                        <th>Brand</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody v-for="client in addedClients">
                        <tr>
                            <td>{{ client.company }}</td>
                            <td>{{ client.contact_person }}</td>
                            <td>{{ client.brands.map(elem => { return elem.name }).join(', ') }}</td>
                            <th>
                                <button class="btn btn-danger"
                                        @click="deleteClient(client, $event)"
                                        type="button">
                                    <i class="fa fa-trash"></i> &nbsp;
                                    Delete
                                </button>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
                <button type="button"
                        @click="createJobOrder"
                        class="btn btn-primary btn-lg btn-block">Create Job Order</button>
            </div>
        </form>
        <create-client-form-modal></create-client-form-modal>
    </div>
</template>

<script>
    import vSelect from 'vue-select'
    import CreateClientModal from '../clients/commons/form.vue'
    import Vue from 'vue'
    import VueEvents from 'vue-events'

    Vue.use(VueEvents)
    Vue.component('create-client-form-modal', CreateClientModal)
    Vue.component('v-select', vSelect)

    export default {
        data() {
            return {
                projectName: '',
                projectTypes: [],
                clients: [],
                clientOptions: [],
                selectedClient: null,
                selectedProjectTypes: [],
                selectedBrands: [],
                addedClients: []
            }
        },
        mounted() {
            this.getProjectTypes()
            this.getClients()
        },
        methods: {
            changeProjectName(e) {
                this.projectName = e.target.value
            },
            deleteClient(client, e) {
                console.log(client);
                let index = this.addedClients.findIndex((item) => {
                    return item.id === client.id
                });

                if (index >= 0) {
                    this.addedClients.splice(index, 1);
                }
            },
            addClientToTable(e) {
                // check if data already in table
                let index = this.addedClients.findIndex((item) => {
                    return item.id === this.selectedClient.id
                });

                if (index >= 0) {
                    return false;
                }

                let brands = [ ...this.selectedBrands ];
                let client = this.selectedClient;
                let data = Object.assign({}, client, { brands });

                this.addedClients.push(data);
            },
            onChangeProjectType(e) {
                if (e.target.checked) {
                    this.selectedProjectTypes.push({ name: e.target.value});
                } else {
                    let index = this.selectedProjectTypes.findIndex((item) => { return item.name === e.target.value});
                    this.selectedProjectTypes.splice(index, 1);
                }
            },
            onChangeBrand(e) {
                if (e.target.checked) {
                    this.selectedBrands.push({ name: e.target.value});
                } else {
                    let index = this.selectedBrands.findIndex((item) => { return item.name === e.target.value});
                    this.selectedBrands.splice(index, 1);
                }
            },
            clientSelected(val) {
                let index = this.clients.findIndex((item) => { return item.id === val.value });
                let selectedClient = Object.assign({}, this.selectedClient, this.clients[index]);

                this.selectedClient = Object.assign({}, this.selectedClient, selectedClient);
                this.selectedBrands = [];

                $('.brand-checkbox').prop('checked', false);
            },
            getProjectTypes() {
                this.$http.get('/api/v1/project-types').then(response => {
                    console.log(response)
                    this.projectTypes = response.data
                }, error => {
                    console.log(error)
                });
            },
            getClients() {
                this.$http.get('/api/v1/clients').then(response => {
                    this.clients = response.data.data;

                    // clear options
                    this.clientOptions = []

                    for (let client of this.clients) {
                        this.clientOptions.push({label: `${client.company} : ${client.contact_person}`, value: client.id});
                    }
                }, error => {
                    console.log(error)
                });
            },
            createJobOrder() {
                let data = {
                    project_name: this.projectName,
                    project_types: this.selectedProjectTypes,
                    clients: this.addedClients
                };

                this.$http.post('/api/v1/job-orders', data).then(response => {
                    let jo = response.data;

                    location.href = `/ae/jo/details/${jo.job_order_no}`;
                }, error => {
                    console.log(error)
                });
            }
        },
        events: {
            'reload-table' () {
                Vue.nextTick( () => this.getClients() )
            }
        }
    }
</script>