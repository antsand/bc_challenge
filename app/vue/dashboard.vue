<template>
	<div>
		<create-boat
			@data="data = $event"
		></create-boat>
		<boat-table
			:data="data"
			@data="data = $event"
		></boat-table>
	</div>	

</template>
<script>
import table_view from './table.vue'
import create_boat from './create.vue'

export default {
	data() {
		return {
			data: null,
		}
	},
	components: {
		'boat-table': table_view,
		'create-boat': create_boat
	},
	methods: {

	},
	watch: {
		data: {
			handler: function(newVal, oldVal) {
			},
			deep:true,
		}
	},
	mounted: function() {
		     var formData = new FormData();
		     this.$http.post('/status/read', formData)
                        .then(response => {                         
                          console.log(response.bodyText);
			  if (response.bodyText) {	 
			      this.data = JSON.parse(response.bodyText);
			  }	 
                         }, error => { 
                              console.log(error);                                
			}               
                     );
		} 
}

</script>
