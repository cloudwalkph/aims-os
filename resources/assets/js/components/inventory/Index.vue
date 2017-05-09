<template>

    <div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">
                Inventory<small> Department</small>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item" v-for="(breadcrumb, index) in breadcrumbs">
                    <i class="fa" :class="breadcrumb.icon"></i>
                    <span v-if="breadcrumbs.length == index + 1">
                        {{breadcrumb.page}}
                    </span>
                    <span v-else-if="breadcrumb.page_id === 'work-in-progress'">
                        <a href="" pageID="work-in-progress" @click.prevent="openPage">
                            {{breadcrumb.page}}
                        </a>
                    </span>
                    <span v-else>
                        <a href="" pageID="home" @click.prevent="openPage">
                            {{breadcrumb.page}}
                        </a>
                    </span>
                </li>
            </ol>
        </div>

        <div class="col-lg-12">
            <component :is="currentView" :openPage="openPage" :propData="inventoryData" :propIJobId="iJobId">
                <!-- component changes when vm.currentView changes! -->
            </component>
        </div>

    </div>

</template>

<script>
    var Home = require('./Inventory.vue');

    var Calendar = require('../CalendarScheduler.vue');

    var InternalInventory = require('./InternalInventory.vue');
    var JOProductList = require('./Products.vue');

    var OnGoingProjectList = require('./OnGoingProjects.vue');

    var WorkInProgress = require('./WorkInProgress.vue');
    var WorkDetails = require('./WorkDetails.vue');

    var InventoryList = require('./InventoryList.vue');

    module.exports = {
        beforeMount: function () {
        },
        data: function () {
            return {
                currentView: Home,
                isActive: 'home',
                breadcrumbs: [
                    {
                        icon: 'fa-dashboard',
                        page: 'Inventory Department'
                    }
                ],
                iJobId: null,
                inventoryData: {
                    assignedJobs: [

                    ],
                    jobOrders: [
                        {
                            id: 0,
                            job_order_no: 'J0SAMPLE',
                            user_id: 0,
                            contract_no: 0,
                            do_contract_no: 0,
                            project_name: 'Sample Job Order',
                            project_types: null,
                            status: null,
                        }
                    ],
                    users: [
                        {
                            id: 0,
                            profile: {
                                first_name: 'First',
                                last_name: 'Last'
                            }
                        },
                        {
                            id: 100,
                            profile: {
                                first_name: 'Juan',
                                last_name: 'Dela Cruz'
                            }
                        }
                    ],
                    products: [
                        {
                            id: 100,
                            job_order_id: 0,
                            product_code: 'SAMPLE-1PROD',
                            name: 'palmolive',
                            quantity: 1000,
                            expiration_date: '2017-02-27',
                        },
                        {
                            id: 101,
                            job_order_id: 0,
                            product_code: 'SAMPLE-1PROD',
                            name: 'safeguard',
                            quantity: 2000,
                            expiration_date: '2017-02-27',
                        },
                    ],
                    inventoryJobs: [
                        {
                            id: 0,
                            remarks: 'sample description',
                            deadline: '2017-03-31',

                            job_order_id: 0,
                            job_order_no: 'J0SAMPLE',
                            project_name: 'Sample Job Order',

                            user_id: 0
                        }
                    ],
                    workDetail: 
                        {
                            deliveries: [
                                {
                                    product_id: 1,
                                    date: '2016-12-22',
                                    delivered: 100,
                                },
                                {
                                    product_id: 2,
                                    date: '2016-12-23',
                                    delivered: 200,
                                },
                                {
                                    product_id: 1,
                                    date: '2016-12-24',
                                    delivered: 100,
                                },
                            ],
                            releases: [
                                {
                                    product_id: 1,
                                    date: '2016-12-22',
                                    disposed: 90,
                                    status: 'Approved',
                                },
                                {
                                    product_id: 1,
                                    date: '2016-12-24',
                                    disposed: 100,
                                    status: 'Approved',
                                },
                                {
                                    product_id: 2,
                                    date: '2016-12-25',
                                    disposed: 150,
                                    status: 'Approved',
                                },
                            ]

                        }
                    
                }
            }
        },
        methods: {
            openPage: function (event) {
                var pageID = event.target.getAttribute('pageID');
                this.breadcrumbs = [{
                    icon: 'fa-dashboard',
                    page: 'Inventory Department'
                }];
                if (pageID == 'home') {
                    this.currentView = Home;
                }
                else if (pageID == 'calendar') {
                    this.currentView = Calendar;
                    this.breadcrumbs.push({
                        icon: 'fa-dashboard',
                        page: 'Calendar'
                    });
                }
                else if (pageID == 'jo-product-list') {
                    this.currentView = JOProductList;
                    this.breadcrumbs.push({
                        icon: 'fa-dashboard',
                        page: 'JO Product List'
                    });
                }
                else if (pageID == 'on-going-project-list') {
                    this.currentView = OnGoingProjectList;
                    this.breadcrumbs.push({
                        icon: 'fa-dashboard',
                        page: 'On Going Project List'
                    });
                }
                else if (pageID == 'work-in-progress') {
                    this.currentView = WorkInProgress;
                    this.breadcrumbs.push({
                        icon: 'fa-dashboard',
                        page: 'Work in Progress'
                    });
                }
                else if (pageID == 'internal-inventory-list') {
                    this.currentView = InventoryList;
                    this.breadcrumbs.push({
                        icon: 'fa-dashboard',
                        page: 'Inventory List'
                    });
                }
                else if (pageID == 'work-details') {
                    this.iJobId = event.target.getAttribute('iJobId');
                    this.currentView = WorkDetails;
                    this.breadcrumbs.push({
                        icon: 'fa-dashboard',
                        page: 'Work In Progress',
                        page_id: 'work-in-progress'
                    });
                    this.breadcrumbs.push({
                        icon: 'fa-dashboard',
                        page: 'Work Details',
                        active: true
                    });
                }
            },
            getAssignedJob: function () {
                this.$http.get('/api/v1/inventory/department')
                    .then(function (response) {
                        // this.inventoryData.assignedJobs = [];
                        for (let r of response.data) {
                            if (r) {
                                this.inventoryData.assignedJobs.push(r);
                            }
                        }
                    })
                    .catch(function (e) {
                        console.log('error jobs assigned', e);
                    });
            },
            getInventory: function () {
                this.$http.get('/api/v1/inventory')
                    .then(function (response) {
                        this.inventoryData.products = [];
                        for (product of response.data.data) {
                            this.inventoryData.products.push({
                                id: product.id,
                                job_order_id: product.job_order_id,
                                job_order_no: product.job_order_no,
                                project_name: product.project_name,
                                name: product.item_name,
                                product_code: product.product_code,
                                expiration_date: product.expiration_date,
                                quantity: product.expected_quantity,
                            })
                        }
                    })
                    .catch(function (e) {
                        console.log('error inventories', e);
                    });
            },
            getJobOrders: function () {
                this.$http.get('/api/v1/job-orders/department')
                    .then(function (response) {
                        this.inventoryData.jobOrders = [];
                        for (let r of response.data) {
                            if (r) {
                                this.inventoryData.jobOrders.push(r);
                            }
                        }
                    })
                    .catch(function (e) {
                        console.log('error jobs department', e);
                    });
            },
            getJob: function () {
                this.$http.get('/api/v1/inventory/job')
                    .then(function (response) {
                        this.inventoryData.inventoryJobs = [];
                        for (let r of response.data.data) {
                            this.inventoryData.inventoryJobs.push(r);
                        }
                    })
                    .catch(function (e) {
                        console.log('error inventory jobs', e);
                    });
            },
            getUsers: function () {
                this.$http.get('/api/v1/users/5')
                    .then(function (response) {
                        // this.inventoryData.users = [];
                        for (let r of response.data) {
                            this.inventoryData.users.push(r);
                        }
                    })
                    .catch(function (e) {
                        console.log('error users department', e);
                    });
            }
        },
        mounted: function () {
            this.getAssignedJob();
            this.getInventory();
            this.getJob();
            this.getJobOrders();
            this.getUsers();
        }
    }

</script>