/* 
 * This is an end to end integration
 * testing using cypress
 */
//var url = 'http://10.0.2.15:9902';
var url = 'https://bc_challenge.antsand.ca';

describe('Visit FishFry Website', function() {
	/*
	* The first test case delete all entries. We want to
	* test the application on a clean slate.
	*/
	it('Test 1: delete all entries- Desktop view', function() {
		cy.visit(url)

		cy.get('.boats_active_list').each(function($el, index,value){
			cy.get('.delete').eq(0).click();
		});
	})
	/*
	* The second test case adds one entry. By adding a 
	* new entry, we test if the application is able to 
	* interact with the server, add the data and represent
	* the data on the browser.
	*/
	it('Test 2: check if popup and add Boat', function() {
		cy.contains('Add a boat').click()
		cy.get('.select_boat').select('Taiana')
		cy.get('.select_guide').select('Bob')
		cy.get('.add_to_table').click()
		cy.wait(500)
	})
	/*
	 * Using the previous test, we try to test for 
	 * duplicate entry. If the same boat is added, 
	 * are we able to see an error.
	 */
	it('Test 3: Try to add duplicate boats', function() {
		cy.contains('Add a boat').click()
		cy.get('.select_boat').select('Taiana')
		cy.get('.select_guide').select('Bob')
		cy.get('.add_to_table').click()
		cy.contains('Boat exists! Choose another boat.');
		cy.get('.close_table_popup').click()
		cy.wait(500)
	})
	/* Similarily to the previous test case, we test to 
	 * see what happens when we assign the same guide to
	 * another boat. If we do so, we need to check for an
	 * error.
	 */
	it('Test 4: Try to add duplicate guides', function() {
		cy.contains('Add a boat').click()
		cy.get('.select_boat').select('Fish and Ships')
		cy.get('.select_guide').select('Bob')
		cy.get('.add_to_table').click()
		cy.contains('Guide Assigned! Choose another guide.');
		cy.get('.close_table_popup').click()
		cy.wait(500)
	})
	/*
	 * This test tries to change the status of the record we added
	 * in the previous test. After changing the status, we reload 
	 * the page and see if the information is stored. 
	 */
	it('Test 5: Change status from docked to maintenance', function() {
		cy.get('.boats_active_list').each(function($el, index,value){
			cy.get($el).find('select').select('Maintenance');
		});
		/* Reload the website and check if the 1st element is set to Maintenance */	
		cy.visit(url)
		cy.get('.boats_active_list').each(function($el, index,value){
			cy.get($el).find('select').find(':selected').contains('Maintenance');
		});
	})
	/* Here we try to open the popup and close the popup.
	 * We are testing the user interface.
	 */
	it('Test 6: close popup', function() {
		cy.contains('Add a boat').click()
		cy.get('.select_boat').select('Taiana')
		cy.get('.select_guide').select('Bob')
		cy.get('.close_table_popup').click()
	})
});
