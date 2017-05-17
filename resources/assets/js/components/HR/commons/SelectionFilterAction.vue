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
                    <select type="date" v-model="filterByAge" name="birthdate" id="birthdateAge" placeholder="Select..." class="form-control">
                    	<option value="">Filter Age</option>
                    	<option value="20">20 and below</option>
                    	<option value="25">25 and below</option>
                    	<option value="30">30 and below</option>
                    	<option value="35">35 and below</option>
                    	<option value="40">40 and below</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block"
                            type="button"
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