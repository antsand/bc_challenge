<template>
	<div>
		<div class="sm-view" v-if="data_local">
				<div v-for="boats, key in data_local.boats" v-if="boats" class="boat_card">
					<div scope="row" class="index"> {{ key + 1 }}</div>
					<div class="align-left"> 
						<p>Boat Name: <b>{{ boats.name }}</b></p>
						<p>Guide Incharge: <b>{{ boats.guide }} </b></p>
						<div>
							<div>
								Status:
								<select v-model="boats.status" @change="update_status(key, boats.status)">
									<option value="docked">Docked</option>
									<option value ="inbound">Inbound</option>
									<option value="outbound">Outbound</option>
									<option value="maintenance">Maintenance</option>
								</select>
							</div>
							<div class="btn btn-danger pad15" @click="delete_status(key)">
								Delete	
							</div>
						</div>	

					</div>
				</div>
			
		</div>
		<table class="table">
			<thead>
			<tr>
				<th>
					#
				</th>
				<th>
					Boat
				</th>
				<th>
					Docked
				</th>
				<th>
					Inbound to Harbor
				</th>
				<th>
					Outbound to Sea
				</th>
				<th>
					Maintenance
				</th>
			</tr>	
			</thead>
			<tbody v-if="data_local">
				<tr v-for="boats, key in data_local.boats" v-if="boats">
					<th scope="row"> {{ key + 1 }}</th>
					<td class="align-left"> 
						<p>Boat Name: <b>{{ boats.name }}</b></p>
						<p>Guide Incharge: <b>{{ boats.guide }} </b></p>
						<div>
							<div>
								Status:
								<select v-model="boats.status" @change="update_status(key, boats.status)">
									<option value="docked">Docked</option>
									<option value ="inbound">Inbound</option>
									<option value="outbound">Outbound</option>
									<option value="maintenance">Maintenance</option>
								</select>
							</div>
							<div class="btn btn-danger pad15" @click="delete_status(key)">
								Delete	
							</div>
						</div>	

					</td>
					<td>
						<span v-if="boats.status == 'docked'" class="icon check" ></span>
					</td>
					<td>
						<span v-if="boats.status == 'inbound'" class="icon check"  ></span>
					</td>
					<td>
						<span v-if="boats.status == 'outbound'" class="icon check"  ></span>
					</td>
					<td>
						<span v-if="boats.status == 'maintenance'" class="icon check" ></span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	export default {
		name: "Boat_table",
		data()  {
			return {
				data_local: null,
			}
		},
		props: ['data'],
		watch: {
			data: {
				handler: function(newVal, oldVal) {
					this.data_local  = newVal;
				},
				deep:true,
			},
			data_local: {
				handler: function(newVal, oldVal) {
				},
				deep:true,
			},
		},
		components: {
		
		},
		methods: {
			update_status: function(boat_num, status_update) {
			     var formData = new FormData(); 	
			     formData.append('boat_num', boat_num); 
			     formData.append('status_update', status_update); 
			     this.$http.post('/status/update', formData)
				.then(response => {                         
				  console.log(response.bodyText);
				  if (response.bodyText) {	
				      console.log(response.bodyText); 	
				      JSON.parse(response.bodyText);
				      this.data_local = JSON.parse(response.bodyText);
				      this.$emit('data', this.data_local);
				  }	 
				 }, error => {                                       
				     console.log(error);                             
				 }                          
			     ); 
				
			},
			delete_status: function(boat_num) {
			     var formData = new FormData(); 	
			     formData.append('boat_num', boat_num); 
			     this.$http.post('/status/delete', formData)
				.then(response => {                         
				  console.log(response.bodyText);
				  if (response.bodyText) {	
				      console.log(response.bodyText); 	
				      JSON.parse(response.bodyText);
				      this.data_local = JSON.parse(response.bodyText);
				      this.$emit('data', this.data_local);
				  }	 
				 }, error => {                              
				     console.log(error);                     
				 }                          
			     ); 				
			},		
		},
		mounted: function(){
			this.data_local = this.data;
		}
	}
</script>
<style lang="scss">
</style>
