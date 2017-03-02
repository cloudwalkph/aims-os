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
            <component 
                :is="currentView"
                :openPage="openPage"
                :propData="InventoryData"
                :propJobOrderID="joID"
            >
                <!-- component changes when vm.currentView changes! -->
            </component>
        <div>

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
        data: function() {
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
                InventoryData: {
                    users: [
                        {
                            userID: 1,
                            label: 'Alleo'
                        },
                        {
                            userID: 2,
                            label: 'Kim'
                        },
                    ],
                    projects: [
                        {
                            projectID: 1,
                            projectName: 'Ponds Activations',
                        },
                        {
                            projectID: 2,
                            projectName: 'Ponds Activations 2',
                        },
                    ],
                    jobOrders: [
                        {
                            jobOrderNo: 1,
                            projectID: 1,
                            description: 'description',
                            deadline: '1/11/2017',
                            assignedPerson: 1,
                            traces: [
                                {
                                    productID: 1,
                                    productsOnHand: '1000000',
                                    deliveries: [
                                        {
                                            date: 'Thu Dec 22 2016',
                                            delivered: 100000,
                                            balance: 900000
                                        },{
                                            date: 'Fri Dec 23 2016',
                                            delivered: 100000,
                                            balance: 800000
                                        },{
                                            date: 'Sat Dec 24 2016',
                                            delivered: 100000,
                                            balance: 700000
                                        }
                                    ],
                                    releases: [
                                        {
                                            date: 'Fri Dec 23 2016',
                                            productsOnHand: '100000',
                                            disposed: 50000,
                                            returned: 0,
                                            status: 'Approved',
                                        },{
                                            date: 'Sat Dec 24 2016',
                                            productsOnHand: 150000,
                                            disposed: 0,
                                            returned: 0,
                                            status: 'Pending',
                                        }
                                    ]
                                },
                                {
                                    productID: 2,
                                    productsOnHand: '1000000',
                                    deliveries: [],
                                    releases: []
                                }
                            ]
                        },
                        {
                            jobOrderNo: 2,
                            projectID: 2,
                            description: 'description 2',
                            deadline: '1/11/2017',
                            assignedPerson: 2,
                            traces: [
                                {
                                    productID: 3,
                                    productsOnHand: '1000000',
                                    deliveries: [],
                                    releases: []
                                }
                            ]
                        }
                    ],
                    products: [
                        {
                            productID: 1,
                            jobOrderNo: 1,
                            itemName: 'Ponds Men'
                        },{
                            productID: 2,
                            jobOrderNo: 1,
                            itemName: 'Ponds Women'
                        },{
                            productID: 3,
                            jobOrderNo: 2,
                            itemName: 'Ponds 2 Women'
                        }
                    ]
                }
            }
        },
        methods: {
            openPage: function(event) {
                var pageID = event.target.getAttribute('pageID');
                this.breadcrumbs = [{
                    icon: 'fa-dashboard',
                    page: 'Inventory Department'
                }];
                if(pageID == 'home') {
                    this.currentView = Home;
                }
                else if(pageID == 'calendar') {
                    this.currentView = Calendar;
                    this.breadcrumbs.push({
                        icon: 'fa-dashboard',
                        page: 'Calendar'
                    });
                }
                else if(pageID == 'jo-product-list') {
                    this.currentView = JOProductList;
                    this.breadcrumbs.push({
                        icon: 'fa-dashboard',
                        page: 'JO Product List'
                    });
                }
                else if(pageID == 'on-going-project-list') {
                    this.currentView = OnGoingProjectList;
                    this.breadcrumbs.push({
                        icon: 'fa-dashboard',
                        page: 'On Going Project List'
                    });
                }
                else if(pageID == 'work-in-progress') {
                    this.currentView = WorkInProgress;
                    this.breadcrumbs.push({
                        icon: 'fa-dashboard',
                        page: 'Work in Progress'
                    });
                }
                else if(pageID == 'internal-inventory-list') {
                    this.currentView = InventoryList;
                    this.breadcrumbs.push({
                        icon: 'fa-dashboard',
                        page: 'Inventory List'
                    });
                }
                else if(pageID == 'work-details') {
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
        }
    }
</script>
