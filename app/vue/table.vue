<template>
	<div>
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
						<p>Boat Name:<b>{{ boats.name }}</b></p>
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
	.table {
		text-align:center;
		td {
			vertical-align:middle;
		}
	}
	.icon {
		width:25px;
		height:25px;
		object-fit: cover;
		display: block;
		background-repeat: no-repeat;
		position:relative;
		margin-left:auto;
		margin-right:auto;
	}
	.check {
		background-image: url('https://www.antsand.ca/uploads/02d0edcfc1bd97173e2cafe04d026c4e/cf9f749cd936116f8b15ad8d1dbd79a2.svg');
	}
	.cross {
		background-image: url('https://www.antsand.ca/uploads/02d0edcfc1bd97173e2cafe04d026c4e/f71a0b94bb622a207d2d5aaa4d369c79.svg');
	}
	
	.pad15 {
		margin:15px 0px;
	}
	.align-left {
		text-align:left;
	}

</style>
