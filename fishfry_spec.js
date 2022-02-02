/* 
 * This is an end to end integration
 * testing using cypress
 */
//var url = 'http://10.0.2.15:9902';
var url = 'https://bc_challenge.antsand.ca';

describe('Visit FishFry Website', function() {
	it('Test 1: delete all entries- Desktop view', function() {
		cy.visit(url)

		cy.get('.boats_active_list').each(function($el, index,value){
			cy.get('.delete').eq(0).click();
		});
	})
	it('Test 2: check if popup and add Boat', function() {
		cy.contains('Add a boat').click()
		cy.get('.select_boat').select('Taiana')
		cy.get('.select_guide').select('Bob')
		cy.get('.add_to_table').click()
		cy.wait(500)
	})
	it('Test 3: Try to add duplicate boats', function() {
		cy.contains('Add a boat').click()
		cy.get('.select_boat').select('Taiana')
		cy.get('.select_guide').select('Bob')
		cy.get('.add_to_table').click()
		cy.contains('Boat exists! Choose another boat.');
		cy.get('.close_table_popup').click()
		cy.wait(500)
	})
	it('Test 4: Try to add duplicate guides', function() {
		cy.contains('Add a boat').click()
		cy.get('.select_boat').select('Fish and Ships')
		cy.get('.select_guide').select('Bob')
		cy.get('.add_to_table').click()
		cy.contains('Guide Assigned! Choose another guide.');
		cy.get('.close_table_popup').click()
		cy.wait(500)
	})
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
	it('Test 6: close popup', function() {
		cy.contains('Add a boat').click()
		cy.get('.select_boat').select('Taiana')
		cy.get('.select_guide').select('Bob')
		cy.get('.close_table_popup').click()
	})
});
