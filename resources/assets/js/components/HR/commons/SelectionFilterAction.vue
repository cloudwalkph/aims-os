<template>
	<div class="filter-bar">
		<form class="form-inline">
            <div class="row">
                <div class="form-group">
                    <select type="date" v-model="filterByManpowerType" name="manpower_type_id" id="manpowerTypeId" placeholder="Select..." class="form-control">
                    	<option value="">Filter Manpower type</option>
                    	<option v-for="man in manpowerNeeded" :value="man.manpower_type.id">{{man.manpower_type.name}}</option>
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
                	<select type="date" v-model="filterByAge" name="birthdate" id="birthdateAge" placeholder="Select..." class="form-control">
                    	<option value="">Filter Age</option>
                    	<option value="20">20 and below</option>
                     	<option value="25">25 and below</option>
                     	<option value="30">30 and below</option>
                     	<option value="35">35 and below</option>
                     	<option value="40">40 and below</option>
                    </select>
                    <!-- <li class="dropdown">
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
                    </li> -->
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
	    props: [
            'manpowerNeeded'
        ],
	    methods: {
			doFilter () {
				let dataFiltered = {
					manpower_type_id : this.filterByManpowerType,
					agency_id : this.filterByAgency,
					birthdate : this.filterByAge
				}
				if(this.filterByManpowerType)
				{
					this.$events.fire('filter-selection-set', dataFiltered)	
				}
				
			},
			resetFilter () {
				this.filterByManpowerType = ''
				this.$events.fire('ilter-selection-reset');
			}
	    }
	}
</script>