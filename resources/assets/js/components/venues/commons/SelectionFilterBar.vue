<template>
    <div class="filter-bar">
        <form class="form-inline">
            <div class="row">
                <div class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Filter Category <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu location" role="menu">
                            <li>
                                <label for="Tie-Ups">
                                    <input type="checkbox" name="Tie-Ups" id="Tie-Ups" /> Tie-Ups
                                </label>
                            </li>
                            <li>
                                <label for="Stations">
                                    <input type="checkbox" name="Stations" id="Stations" /> Stations
                                </label>
                            </li>
                            <li>
                                <label for="Barangay">
                                    <input type="checkbox" name="Barangay" id="Barangay" /> Barangay
                                </label>
                            </li>
                            <li>
                                <label for="Malls">
                                    <input type="checkbox" name="Malls" id="Malls" /> Malls
                                </label>
                            </li>
                            <li>
                                <label for="Hospitals">
                                    <input type="checkbox" name="Hospitals" id="Hospitals" /> Hospitals
                                </label>
                            </li>
                            <li>
                                <label for="Offices">
                                    <input type="checkbox" name="Offices" id="Offices" /> Offices
                                </label>
                            </li>
                            <li>
                                <label for="School">
                                    <input type="checkbox" name="School" id="School" /> School
                                </label>
                            </li>

                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Filter Area <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu location" role="menu">
                            <li>
                                <label for="Quezon City">
                                    <input type="checkbox" name="Quezon City" id="Quezon City" /> Quezon City
                                </label>
                            </li>
                            <li>
                                <label for="Mandaluyong City">
                                    <input type="checkbox" name="Mandaluyong City" id="Mandaluyong City" /> Mandaluyong City
                                </label>
                            </li>
                            <li>
                                <label for="Caloocan City">
                                    <input type="checkbox" name="Caloocan City" id="Caloocan City" /> Caloocan City
                                </label>
                            </li>
                            <li>
                                <label for="San Juan City">
                                    <input type="checkbox" name="San Juan City" id="San Juan City" /> San Juan City
                                </label>
                            </li>
                            <li>
                                <label for="Pasig City">
                                    <input type="checkbox" name="Pasig City" id="Pasig City" /> Pasig City
                                </label>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Estimated Foot Traffic <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu location" role="menu">
                            <li>
                                <label for="None">
                                    <input type="checkbox" name="None" id="None" /> None
                                </label>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Actual Hits <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu location" role="menu">
                            <li>
                                <label for="None">
                                    <input type="checkbox" name="None" id="None" /> None
                                </label>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Actual Hits Male<span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu location" role="menu">
                            <li>
                                <label for="None">
                                    <input type="checkbox" name="None" id="None" /> None
                                </label>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Actual Hits Female<span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu location" role="menu">
                            <li>
                                <label for="None">
                                    <input type="checkbox" name="None" id="None" /> None
                                </label>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            LSM <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu location" role="menu">
                            <li>
                                <label for="lsm">LSM</label>
                                <input type="number" class id="lsm" name="lsm" value="" />
                            </li>
                        </ul>
                    </li>
                </div>

                <div class="form-group col-md-2">
                    <button class="btn btn-primary btn-block"
                            type="button">

                        Apply Filter
                    </button>
                </div>
            </div>

            <!--<div class="form-group">-->
                <!--<label>Search for:</label>-->
                <!--<input type="text" v-model="filterText" class="form-control" @keyup.enter="doFilter" placeholder="jo number, deadline, name">-->
                <!--<button class="btn btn-primary" @click.prevent="doFilter">Go</button>-->
                <!--<button class="btn" @click.prevent="resetFilter">Reset</button>-->
            <!--</div>-->
        </form>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                filterText: ''
            }
        },
        methods: {
            doFilter () {
                this.$events.fire('filter-set', this.filterText)
            },
            resetFilter () {
                this.filterText = ''
                this.$events.fire('filter-reset')
            }
        }
    }
</script>
<style>
    .filter-bar {
        padding: 10px;
    }
</style>