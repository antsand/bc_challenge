<template>
	<div class="add_boat">
	    <button @click="open_form" class="btn-primary btn">Add a boat</button>
	    <div class="form" v-bind:class="{'display-block':display, 'display-none':!display }">
		<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Add Boat</h5>
			<button type="button" class="close" @click="close_form" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		      </div>
		      <div class="modal-body">
			<form>
			  <div class="red danger" v-if="error" v-html="error">
			  </div>
			  <div class="form-group">
			    <label for="recipient-name" class="col-form-label">Select boat to add: </label>
				
				<select class="form-control" v-if="boats" v-model="boat_selected">
					<option></option>
					<option v-for="boat_name in Object.keys(boats)" v-html="boat_name"></option>
				</select>
			  </div>
			  <div class="form-group">
			    <label for="message-text" class="col-form-label">Assign Guide</label>
				<select class="form-control" v-if="guides" v-model="guide_selected">
					<option></option>
					<option v-for="guide_name in Object.keys(guides)" v-html="guide_name"></option>
				</select>
			  </div>
			</form>
		      </div>
		      <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal" @click="close_form">Close</button>
			<button type="button" class="btn btn-primary" @click="add_boat">Add</button>
		      </div>
		    </div>
		  </div>
		</div>
	    </div> 
	</div>	
</template>
<script>
	export default {
		data() {
			return {
				display: false,
				boats: null,
				guides:null,	
				boat_selected: null,
				guide_selected: null,
				error: null,
			}
		},
		methods: {
			open_form:function() {
				this.display = true;
			},
			close_form: function() {
				this.display = false;
			},
			add_boat:function() {
			     var formData = new FormData(); 
				this.error = null;
			      if (!this.boat_selected || !this.guide_selected ){
				this.error = 'Please complete all fields';
				return;
			     } 	
			     formData.append('boat_selected', this.boat_selected);
			     formData.append('guide_selected', this.guide_selected);
			     this.$http.post('/status/create', formData)
				.then(response => {                         
				  console.log(response.bodyText);
				  if (response.bodyText) {	
					this.$emit('data', JSON.parse(response.bodyText));
					this.boat_selected = null;
					this.guide_selected = null;
					this.close_form();  	
				  }	 
				 }, error => {                                       
				     console.log(error);                             
				 }                          
			     ); 
			}
		},
		mounted: function() {
			/* fetch boats */
		     var formData = new FormData(); 	
		     this.$http.post('/boat/read', formData)
                        .then(response => {                         
                          console.log(response.bodyText);
			  if (response.bodyText) {	 
			      this.boats = JSON.parse(response.bodyText);
			  }	 
                         }, error => {                                       
                             console.log(error);                             
                         }                          
                     ); 
		     this.$http.post('/guide/read', formData)
                        .then(response => {                         
                          console.log(response.bodyText);
			  if (response.bodyText) {	 
			      this.guides = JSON.parse(response.bodyText);
			  }	 
                         }, error => {                                       
                             console.log(error);                             
                         }                          
                     ); 
		}		
	} 
</script>
<style lang="scss">
	.add_boat {
		margin-bottom:25px;
	}
 	.display-block {
		display:block;
	}
	.display-none {
		display:none;
	}
	.modal {
		display:block;
		opacity:1;
		.fade{
		.modal-dialog {
			transform:translate(-50%, 0);
		}
		}
		.fade:not(.show) {
			opacity:1;
		}
	}	

</style>
