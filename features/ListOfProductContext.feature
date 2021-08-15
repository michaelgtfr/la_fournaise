Feature:
  in order to check that the features that the page works
  As a user
  I want to have these scenarios

  Scenario: Display the list of product page
    When I am on "/listofproduct"
    Then I should see "Menu:"

    @javascript
    Scenario: Display the menu in the page
      Given I want see the menu
      And I am on "/listofproduct"
      When I go further down the page
      Then I should see "name product"
      And I should see "Plat du jour:"
      And I should not see "Nos plats:"

