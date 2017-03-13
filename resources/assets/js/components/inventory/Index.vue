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
            <component :is="currentView" :openPage="openPage" :propData="inventoryData" :propJobOrderID="joID">
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
            this.$http.get('/api/v1/job-orders/department')
                .then(function (response) {
                    for (let jo of response.data) {
                        this.inventoryData.jobOrders.push(jo);
                    }
                })
                .catch(function (e) {
                    console.log('error department', e);
                });
            this.$http.get('/api/v1/users/5')
                .then(function (response) {
                    for (let user of response.data) {
                        this.inventoryData.users.push(user);
                    }
                })
                .catch(function (e) {
                    console.log('error users', e);
                });

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
                joID: null,
                inventoryData: {
                    jobOrders: [

                    ],
                    users: [

                    ],
                    products: [
                        {
                            id: 1,
                            job_order_id: 2,
                            product_code: 'PONDS-MEN',
                            name: 'Product 1',
                            quantity: 1000000,
                            expiration_date: '2017-02-27',
                        },
                        {
                            id: 2,
                            job_order_id: 2,
                            product_code: 'PONDS-WOMEN',
                            name: 'Product 2',
                            quantity: 2000000,
                            expiration_date: '2017-02-27',
                        },
                    ],
                    jobs: [
                        
                    ],
                    assignedPeople: [
                        {
                            inventory_job_id: 1,
                            user_id: 5
                        }
                    ],
                    workDetails: [
                        {
                            inventory_job_id: 1,
                            deliveries: [
                                {
                                    product_id: 1,
                                    data: [
                                        {
                                            date: '2016-12-22',
                                            delivered: 500000,
                                        },
                                        {
                                            date: '2016-12-23',
                                            delivered: 250000,
                                        },
                                        {
                                            date: '2016-12-24',
                                            delivered: 100000,
                                        },
                                    ]
                                },
                                {
                                    product_id: 2,
                                    data: [
                                        {
                                            date: '2016-12-22',
                                            delivered: 200000,
                                        },
                                    ]
                                }
                            ],
                            releases: [
                                {
                                    product_id: 1,
                                    data: [
                                        {
                                            date: '2016-12-23',
                                            productsOnHand: 100000,
                                            disposed: 50000,
                                            returned: 0,
                                            status: 'Approved',
                                        }, {
                                            date: '2016-12-24',
                                            productsOnHand: 150000,
                                            disposed: 0,
                                            returned: 0,
                                            status: 'Pending',
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
                    this.joID = event.target.getAttribute('joID');
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
            }
        },
        mounted: function () {
            // console.log(this.inventoryData);
        }
    }

</script>