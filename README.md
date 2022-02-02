# bc_challenge
The link to the working website is at: https://bc_challenge.antsand.ca/

This application does a few things:
1. You can add a boat to the table and select a guide
2. You can change the status of the boat (docked, inbound, outbount, maintenance) in both mobile view and desktop view
3. You can delete a boat from the table
4. To add or swap a guide to the boat, you need to firts delete the boat and then add the boat with the updated guide

Future enhancements (not implemented):
1. Ability to swap/change or remove a guide from a boat without deleting the boat
2. Ability to assign multiple guides to a boat
3. Ability to add/update/delete boat types and fill boat information such as, boat type, last maintnance done, cost of boat, how old the boat is, when is the next maintenance due, etc 
4. Ability to add/update/delete guides and fill their profile information
5. When a user clicks on the boat they can see the detailed information of boat
6. When a user clicks on a guide they can see the user profile of the guide 

## This repository uses:

- Phalcon PHP as the backend framework
	> **_NOTE:_**  Phalcon Php is a C compiled framework mounted as a plugin to PHP. 
- Vue.js as the frontend framework
- SASS for styling logic and compiling to CSS  
- JSON to store API data 
- NGINX Server
- Bootstrap for CSS library

### How does it work?
#### Backend Logic:
The framework uses a Model View Controller  MVC architecture. The Models store the business logic and interact with the database, the controller handles the link and what to show for each link and the view renders the HTML page. 

An MVC structure helps in modularizing the code into different logic components. By making the code modular, it allows for easy maintainability. 
##### Backend Structure:
 The core logic of the backend is under the app folder. The folder structure is as follows:
 ```
	-> public
	-> app
			-> Controllers 
			-> Views
			-> Models
			-> Vue (frontend framework soruce file)
			-> sass
```
The controller name and actions correspond to the HTTP link.
E.g. if you want to read the API data directly:
Typing https://bc_challenge.antsand.ca/status/read
corresponds to the Status Controller and Read action.

##### API Data:
Files in the model's folder generally link directly to a database. Here we do not use a database. We store the data in files. The API's are stored under
```
	-> app
	-> public
		-> data
			-> data.json
			-> guides.json
			-> boats.json	
	-> cache (hidden - Executed during runtime)
```
The models are still used to retrieve the file, do computational logic, and store files.

The cache folder stores the PHP files. The template engine used is Volt. To convert .volt files to PHP, we need a cache folder. The cache folder is hidden on the servers.

#### Frontend Structure:
	The core Vue files are stored under:
	
		-> app
			-> Vue
				boats.js
				dashboard.vue
				create.vue
				table.vue

Though the backend takes care of all the logic and HTTP links, the frontend is rendered using Vue. 

The below image shows how Vue is rendered and how the frontend works.
![Workflow of the frontend](https://raw.githubusercontent.com/antsand/bc_challenge/master/public/img/bc_challenge_workflow.jpg)

#### Sass:
The sass code is placed under
```
		->sass.php
		-> app
			-> Sass
				_create.scss
				_table.scss
				main.scss
```
- Each of the scss file names correspond to the Vue components. 
- main.scss imports sass plugins and imports all the scss files. 
- To compile the file, we need to run sass.php which will compile the \*.scss files into css.
- The css file is generated and saved in public/css/main.css
				
				
## Unit Testing:
Currently we do end to end testing using cypress
To install cypress - npm install cypress --save-dev 
The test script is located at: fishfry_spec.js in the root folder. Once cypress is installed fishfry_spec.js needs to be copied over to the cyress testing folder.
This step can be implemented using CI/CD scripts.
	
In integration testing we test 6 cases:
Test 1 tries to delete all records and starts from a clean slate.
Test 2 clikcs on Add a boat and a guide, and see if it is added to the record
Test 3 tries to add duplicate boat and check for an error
Test 4 tries to add a duplicate guide and check for an error
Test 5 changes the status from docked to maintenance, refreshes the page and sees if they status has been updated.
Test 6 Opens the 'Add a boat' dialog and closes it to see if the popup functionality works. 
![End to end integration testing](https://raw.githubusercontent.com/antsand/bc_challenge/master/public/img/test_logs.jpg)



