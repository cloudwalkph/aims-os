<template>
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Human Resources<small> Department</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> HR Department
                </li>
            </ol>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="button-menu">
                <div class="hero-widget well well-sm">
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <div class="text">
                        <label class="text-muted">Calendar</label>
                    </div>
                    <div class="options">
                        <a href="/hr/schedules" class="btn btn-primary btn-lg">Schedules</a> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="button-menu">
                <div class="hero-widget well well-sm">
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="text">
                        <label class="text-muted">Manpower Lists</label>
                    </div>
                    <div class="options">
                        <a href="/hr/manpower" class="btn btn-primary btn-lg">Add Manpower</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="button-menu">
                <div class="hero-widget well well-sm">
                    <div class="icon">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <div class="text">
                        <label class="text-muted">Manpower Pooling</label>
                    </div>
                    <div class="options">
                        <a href="/hr/manpower_pooling" class="btn btn-primary btn-lg">Add Manpower to JO</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="button-menu">
                <div class="hero-widget well well-sm">
                    <div class="icon">
                        <i class="fa fa-truck"></i>
                    </div>
                    <div class="text">
                        <label class="text-muted">Vehicle Request List</label>
                    </div>
                    <div class="options">
                        <a href="#" class="btn btn-primary btn-lg">Vehicle request</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="button-menu">
                <div class="hero-widget well well-sm">
                    <div class="icon">
                        <i class="fa fa-cutlery"></i>
                    </div>
                    <div class="text">
                        <label class="text-muted">Food Request List</label>
                    </div>
                    <div class="options">
                        <a href="#" class="btn btn-primary btn-lg">Food request</a>
                    </div>
                </div>
            </div>
        </div> -->

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/validate">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-clipboard"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Validate</label>
                            </div>
                            <div class="options">
                                <a href="/validate" class="btn btn-primary btn-lg">View Lists</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>