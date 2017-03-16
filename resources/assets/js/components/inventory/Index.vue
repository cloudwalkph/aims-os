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
                    jobOrders: [
                        {
                            id: 0,
                            job_order_no: 'J0SAMPLE',
                            project_name: 'Sample Job Order',
                            user_id: 0
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
                            id: 1,
                            job_order_no: 'J0SAMPLE',
                            project_name: 'Sample Job Order',
                            product_code: 'SAMPLE-1PROD',
                            name: 'Sample Product 1',
                            quantity: 1000000,
                            expiration_date: '2017-02-27',
                        },
                        {
                            id: 2,
                            job_order_no: 'J0SAMPLE',
                            project_name: 'Sample Job Order',
                            product_code: 'SAMPLE-2PROD',
                            name: 'Sample Product 2',
                            quantity: 2000000,
                            expiration_date: '2017-02-27',
                        },
                    ],
                    inventoryJobs: [
                        {
                            id: 0,
                            description: 'sample description',
                            deadline: '2017-03-31',

                            job_order_id: 0,
                            job_order_no: 'J0SAMPLE',
                            project_name: 'Sample Job Order',

                            user_id: 0
                        }
                    ],
                    workDetails: [
                        {
                            inventory_job_id: 0,
                            items: [
                                {
                                    product_code: 'SAMPLE-1PROD',
                                    deliveries: [
                                        {
                                            date: '2016-12-22',
                                            delivered: 2000,
                                        }
                                    ],
                                    releases: [
                                        {
                                            date: '2016-12-22',
                                            disposed: 1000,
                                            returned: 300,
                                            status: 'Approved',
                                        }
                                    ]
                                }
                            ]
                        }
                    ]
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
                        page: 'Inventory List'
                    });
                    this.breadcrumbs.push({
                        icon: 'fa-dashboard',
                        page: 'Work Details',
                        active: true
                    });
                }
            },
            getInventory: function () {
                this.$http.get('/api/v1/inventory')
                    .then(function (response) {
                        // this.inventoryData.products = [];
                        for(product of response.data.data) {
                            this.inventoryData.products.push({
                                id: product.id,
                                job_order_no: product.job_order_no,
                                project_name: product.project_name,
                                name: product.name,
                                quantity: 1000000
                            })
                        }
                    })
                    .catch(function (e) {
                        console.log('error inventory', e);
                    });
            },
            getJob: function () {
                this.$http.get('/api/v1/inventory/job')
                    .then(function (response) {
                        // this.inventoryData.inventoryJobs = [];
                        for (let r of response.data.data) {
                            this.inventoryData.inventoryJobs.push(r);
                        }
                    })
                    .catch(function (e) {
                        console.log('error jobs', e);
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
                        console.log('error jobs', e);
                    });
            }
        },
        mounted: function () {
            this.getInventory();
            this.getJob();
            this.getUsers();
        }
    }

</script>