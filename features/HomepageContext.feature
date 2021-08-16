Feature:
  in order to check that the features that the page works
  As a user
  I want to have these scenarios

  Scenario: Display the login page
    When I visit the web site
    Then I should see "Jeudi"

  @javascript
  Scenario: Display of the map and the marker
    Given I am on homepage
    Then I should see "leaflet"
    And a marker

  @javascript
  Scenario: Update the marker location in click of an other location
    Given I am on homepage
    When I click on the card
    Then I should see the location of the day on the map

