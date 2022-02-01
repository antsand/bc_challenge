# bc_challenge

## This repository uses:

- Phalcon PHP as the backend framework
	> **_NOTE:_**  Phalcon Php is a C compiled framework mounted as a plugin to PHP. 
- Vue.js as the frontend framework

### How does it work?
#### Backend Structure:
 The core logic of the backend is under the app folder. The folder structure is as follows:
 ```
	-> public
	-> app
			-> Controllers 
			-> Views
			-> Models
			-> Vue (frontend framework soruce file)
```
The controller name and actions correspond to the HTTP link.
E.g. if you want to read the API data directly:
Typing https://bc_challenge.antsand.ca/status/read
corresponds to the Status Controller and Read action.

Files in the model's folder generally link directly to a database. Here we do not use a database. We store the data in files. The API's are stored under
```
	-> app
	-> public
		-> data
			-> data.json
			-> guides.json
			-> boats.json	
	-> cache
```
The models are still used to retrieve the file, do computational logic, and store files.

The cache folder stores the PHP files. The template engine used is Volt. To convert .volt files to PHP, we need a cache folder.

#### Frontend Structure:
	The core Vue files are stored under:
	
		-> app
		-> Vue
			boats.js
			dashboard.vue
			create.vue
			table.vue

Though the backend takes care of all the logic and HTTP links, the frontend is rendered using Vue. 
