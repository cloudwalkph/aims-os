<template>
    <div class="filter-bar">
        <form class="form-inline">
            <div class="row">
                <div class="form-group col-xs-12 col-sm-12 col-md-2">
                    <select name="category" id="category" class="venue-filter">
                        <option value="" disabled selected>Filter Category</option>
                        <option value="Tie-Ups">Tie-Ups</option>
                        <option value="Stations">Stations</option>
                        <option value="Barangay">Barangay</option>
                        <option value="Malls">Malls</option>
                        <option value="Hospitals">Hospitals</option>
                        <option value="Offices">Offices</option>
                        <option value="School">School</option>
                    </select>
                </div>

                <div class="form-group col-xs-12 col-sm-12 col-md-2">
                    <select name="area" id="area" class="venue-filter">
                        <option value="" disabled selected>Filter Area</option>
                        <option value="Quezon City">Quezon City</option>
                        <option value="Mandaluyong City">Mandaluyong City</option>
                        <option value="Caloocan City">Caloocan City</option>
                        <option value="San Juan City">San Juan City</option>
                        <option value="Pasig City">Pasig City</option>
                    </select>
                </div>

                <div class="form-group col-xs-12 col-sm-12 col-md-2">
                    <select name="eft" id="eft" class="venue-filter">
                        <option value="" disabled selected>Filter Estimated Foot Traffic</option>
                        <option value=""></option>
                    </select>
                </div>

                <div class="form-group col-xs-12 col-sm-12 col-md-2">
                    <select name="actual_hits" id="actual_hits" class="venue-filter">
                        <option value="" disabled selected>Filter Actual Hits</option>
                        <option value=""></option>
                    </select>
                </div>

                <div class="form-group col-xs-12 col-sm-12 col-md-2">
                    <select name="lsm" id="lsm" class="venue-filter">
                        <option value="" disabled selected>Filter LSM</option>
                        <option value=""></option>
                    </select>
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