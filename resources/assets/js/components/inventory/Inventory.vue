<template>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" v-for="item in items">
                <div class="button-menu">
                    <div class="hero-widget well well-sm">
                        <div class="icon">
                            <i class="fa" v-bind:class="item.icon"></i>
                        </div>
                        <div class="text">
                            <label class="text-muted">{{item.label}}</label>
                        </div>
                        <div class="options">
                            <a href="#" :pageID="item.id" class="btn btn-primary btn-lg" @click.prevent="openPage">{{item.buttonLabel}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
    module.exports = {
        data: function() {
            return {
                items: [
                    {
                        id: 'calendar',
                        label: 'Calendar',
                        icon: 'fa-calendar',
                        buttonLabel: 'Schedules'
                    },
                    {
                        id: 'jo-product-list',
                        label: 'JO Product List',
                        icon: 'fa-shopping-basket',
                        buttonLabel: 'JO Product List'
                    },
                    {
                        id: 'on-going-project-list',
                        label: 'On-going projects list',
                        icon: 'fa-archive',
                        buttonLabel: 'View Projects'
                    },
                    {
                        id: 'work-in-progress',
                        label: 'Work in Progress',
                        icon: 'fa-tasks',
                        buttonLabel: 'Work in Progress'
                    },
                    {
                        id: 'internal-inventory-list',
                        label: 'Internal Inventory List',
                        icon: 'fa-th-list',
                        buttonLabel: 'Inventory List'
                    },
                ]
            }
        },
        props: ['openPage']
    }
</script>