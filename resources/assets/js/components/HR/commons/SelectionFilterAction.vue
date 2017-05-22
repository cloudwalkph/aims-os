<template>
	<div class="filter-bar">
		<form class="form-inline">
            <div class="row">
                <div class="form-group">
                    <select type="date" v-model="filterByManpowerType" name="manpower_type_id" id="manpowerTypeId" placeholder="Select..." class="form-control">
                    	<option value="">Filter Manpower type</option>
                    	<option value="1">Setup</option>
                    	<option value="2">BA</option>
                    	<option value="3">Promodizer</option>
                    	<option value="4">Push Girl</option>
                    	<option value="5">Seller</option>
                    	<option value="6">PA</option>
                    	<option value="7">Repacker</option>
                    	<option value="8">TL</option>
                    	<option value="9">ATL</option>
                    	<option value="10">Project Coordinator</option>
                    </select>
                </div>
                <div class="form-group">
                    <select type="date" v-model="filterByAgency" name="agency_id" id="agencyName" placeholder="Select..." class="form-control">
                    	<option value="">Filter Agencies</option>
                    	<option value="1">Cloudwalk</option>
                    	<option value="2">Activations</option>
                    </select>
                </div>
                <div class="form-group">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Location <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu location" role="menu">
                            <li>
                                <input type="text" class="form-control search-location"
                                       placeholder="Enter a location" name="search_location">
                            </li>
                            <li class="nav-divider"></li>
                            <li>
                                <h4>TOP LOCATIONS</h4>
                            </li>
                            <li>
                                <label for="location_1">
                                    <input type="checkbox" name="location_1" id="location_1" /> Makati
                                </label>
                            </li>
                            <li>
                                <label for="location_2">
                                    <input type="checkbox" name="location_2" id="location_2" /> Pasig
                                </label>
                            </li>
                            <li>
                                <label for="location_3">
                                    <input type="checkbox" name="location_3" id="location_3" /> Quezon City
                                </label>
                            </li>
                            <li>
                                <label for="location_4">
                                    <input type="checkbox" name="location_4" id="location_4" /> Metro Manila
                                </label>
                            </li>
                            <li>
                                <label for="location_5">
                                    <input type="checkbox" name="location_5" id="location_5" /> Cavite
                                </label>
                            </li>

                        </ul>
                    </li>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block"
                            type="button" style="padding: 10px"
                            @click="doFilter">
                        Apply Filter
                    </button>
                </div>
            </div>
        </form>
	</div>
</template>

<script>
	export default {
		data: function() {
			return {
				filterByManpowerType: '',
				filterByAgency: '',
				filterByAge: ''
			}
	    },
	    methods: {
			doFilter () {
				let dataFiltered = {
					manpower_type_id : this.filterByManpowerType,
					agency_id : this.filterByAgency,
					birthdate : this.filterByAge
				}
				this.$events.fire('filter-selection-set', dataFiltered)
			},
			resetFilter () {
				this.filterByManpowerType = ''
				this.$events.fire('ilter-selection-reset');
			}
	    }
	}
</script>